<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Run;

class RunController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	// Create a run. 
	public function postCreate(Request $request)
	{
		$email = $request->input('email');
		$name = $request->input('name');

		$run = Run::create( [
			'email'=>$email,
			'name'=>$name,
			'status'=> 'uploading',
			'dir'=>time()
		]);

		$dir = $run->directory();
		makeDir( $dir, 0775 );
		makeDir( $dir."/workingDir", 0775 );
		makeDir( $dir."/workingDir/Data", 0775 );
		makeDir( $dir."/workingDir/Library", 0775 );

		File::copy(app()->basePath().'/storage/exampleFiles/configuration.yaml', "$dir/workingDir/configuration.yaml");
		
		\Illuminate\Support\Facades\Mail::to($run->email)->send(new \App\Mail\RunCreated($run));
		
		return redirect("/upload/$run->id");
	}

	// Prevent lock recipe from further uploads, start the run. 
	public function postStart(Request $req, $id)
	{
		ignore_user_abort(true);
		set_time_limit(0);

		$run = Run::findOrFail($id);
		$run->status='running';
		$run->save();
		$dir = $run->directory();
		File::put("$dir/status.log", 'Started');

		// Putting this in because dispatch is hanging
		// Buffer all upcoming output...
    // ob_start();

    // // Send your response.
    // echo redirect("/run/$id");

    // // Get the size of the output.
    // $size = ob_get_length();

    // // Disable compression (in case content length is compressed).
    // header("Content-Encoding: none");

    // // Set the content length of the response.
    // header("Content-Length: {$size}");

    // // Close the connection.
    // header("Connection: close");

    // // Flush all output.
    // ob_end_flush();
    // ob_flush();
    // flush();

    // Close current session (if it exists).
    // if(session_id()) session_write_close();


    $data = $req->all();
    $this->generateConfig($req, $run->directory());


    $runCmd = "bash ".app()->basePath()."/app/Scripts/startRun.sh $dir > $dir/runStatus.log 2>&1 &";
    File::put("$dir/runCmd.sh", $runCmd);
    exec($runCmd);

		dispatch(new \App\Jobs\MonitorRun($run));

		return redirect("/run/$id");
	}

	public function postDoneUploading($id)
	{
		$run = Run::findOrFail($id);
		$run->status='managing-files';
		$run->save();
		return redirect("/files/$id");
	}

	public function postConfigureFiles(Request $request, $id)
	{
		$validator = \Validator::make($request->all(), [
		    'group-*' => ['required', \Illuminate\Validation\Rule::in(['control','treatment'])]
		]);
		$run = Run::findOrFail($id);
		$dir = $run->directory()."/workingDir/Data";
		$files = File::files($dir);
		$numControl = $numTreatment = 0;
		foreach ($files as $file) {
			$basename = basename($file);
			$basename = preg_replace('/[\s.]/', '_', $basename);
			$group = $request->input("group-$basename");
			$index = 0;
			switch ($group) {
				case 'control':
					$prefix = "Control";
					$numControl++;
					$index = $numControl;
					break;
				case 'treatment':
					$prefix = "Treatment";
					$numTreatment++;
					$index = $numTreatment;
					break;
				default:
					$prefix="ERROR";
					break;
			}

			$rename = $request->input("rename-$basename");
			if (empty($rename)) {
				$rename = str_replace("_fastq_gz","",$basename);
			}
			$newName = $prefix."_R".$index."_".$rename.".fastq.gz";
			File::move($file, $dir.'/'.$newName);
		}
		$run->status = "setting-parameters";
		$run->save();
		return redirect("/parameters/$id");
	}

	public function generateConfig($req, $dir)
	{

		$values = [
			"ScreenType"      => 'enrichment',
			"seq_5_end"       => 'TCTTGTGGAAAGGACGAAACACCG',
			"seq_3_end"       => 'GTTTTAGAGCTAGAAATAGCAAGTT',
			"CtrlPrefix"      => 'Control_',
			"NonTargetPrefix" => 'NonTargeting',
			"sgRNAsPerGene"   => '6',
			"AlnOutput"       => 'Compress',
			"keepCutReads"    => 'False',
			"VarEst"          => 'model',
			"GeneMetric"      => 'aRRA',
			"scatter_annotate"=> 'True',
			"ClusterBy"       => 'variance',
			"TopN"            => '100',
			"CutErrorTol"     => '0.25',
			"R_min"           => ' 10',
			"L_bw"            => '11',
			"N_bw"            => '1',
			"i_bw"            => 'S,1,0.75',
			"Theta"           => '2',
			"N0"              => '1000000',
			"max_q"           => '95',
			"alpha"           => '0.01',
			"pcorr"           => 'fdr_bh',
			"Np_ES"           => '100',
			"Np_aRRA"         => '100',
			"Np_STARS"        => '10',
			"thr_STARS"       => '10',
		];
		foreach ($values as $key => $value) {
			if (!empty($req->input($key))) {
				$values[$key] = $req->input($key);
			}
		}
		\Log::debug("Values after reading input\n================================");
		\Log::debug(print_r($values,true));
		$config = "";
		// Project Parameters
		$config.= "# PROJECT PARAMETERS\n";
		$config.= "ScreenType: '".$values['ScreenType']."'\n";
		$config.= "LibFilename: 'library.tsv' \n";
		$config.= "seq_5_end: '".$values['seq_5_end']."'\n";
		$config.= "seq_3_end: '".$values['seq_3_end']."'\n";
		$config.= "CtrlPrefix: 'Control' \n";
		$config.= "NonTargetPrefix: '".$values['NonTargetPrefix']."'\n";
		$config.= "sgRNAsPerGene: ".$values['sgRNAsPerGene']."\n";


		// Analysis Options
		$config.= "\n# ANALYSIS OPTIONS\n";
		$config.= "AlnOutput: '".$values['AlnOutput']."'\n";
		$config.= "keepCutReads: ".$values['keepCutReads']."\n";
		$config.= "VarEst: '".$values['VarEst']."'\n";
		$config.= "GeneMetric: '".$values['GeneMetric']."'\n";
		$config.= "scatter_annotate: ".$values['scatter_annotate']."\n";
		$config.= "ClusterBy: '".$values['ClusterBy']."'\n";
		$config.= "TopN: ".$values['TopN']."\n";

		// Technical Parameters
		$config.= "\n# TECHNICAL PARAMETERS\n";
		$config.= "CutErrorTol: ".$values['CutErrorTol']."\n";
		$config.= "R_min: ".$values['R_min']."\n";
		$config.= "L_bw: ".$values['L_bw']."\n";
		$config.= "N_bw: ".$values['N_bw']."\n";
		$config.= "i_bw: '".$values['i_bw']."'\n";
		$config.= "Theta: ".$values['Theta']."\n";
		$config.= "N0: ".$values['N0']."\n";
		$config.= "max_q: ".$values['max_q']."\n";
		$config.= "alpha: ".$values['alpha']."\n";
		$config.= "pcorr: '".$values['pcorr']."'\n";
		$config.= "Np_ES: ".$values['Np_ES']."\n";
		$config.= "Np_aRRA: ".$values['Np_aRRA']."\n";
		$config.= "Np_STARS: ".$values['Np_STARS']."\n";
		$config.= "thr_STARS: ".$values['thr_STARS']."\n";
		
		// Rest
		$config.= 
			"\n# VISUALIZATION PARAMETERS \n".
			"delta_s: 0.01 \n".
			"delta_p: 1 \n".
			"dpi: 300 \n".
			"dotsize: 10 \n".
			"# DIRECTORIES \n".
			"WorkingDir: '/workingdir/' \n".
			"DataDir: '/workingdir/Data/' \n".
			"LibDir: '/workingdir/Library/' \n".
			"IndexDir: '/workingdir/Library/Bowtie2_Index/' \n".
			"ScriptsDir: '/opt/PinAPL-Py/Scripts/' \n".
			"AnalysisDir: '/workingdir/Analysis/' \n".
			"AlignDir: '/workingdir/Alignments/' \n".
			"QCDir: '/workingdir/Analysis/QC/' \n".
			"bw2Dir: '/usr/bin/' \n".
			"CutAdaptDir: '/root/.local/bin/'    \n".
			"STARSDir: '/opt/PinAPL-Py/Scripts/STARS_mod/' \n".
			"\n".
			"# SCRIPT FILENAMES \n".
			"script00: 'BuildLibraryIndex' \n".
			"script01: 'AlignReads' \n".
			"script02: 'AnalyzeCounts' \n".
			"script03: 'AnalyzeControl' \n".
			"script04: 'ListCandidateGuides' \n".
			"script05: 'ListCandidateGenes' \n".
			"script06: 'PlotSample' \n".
			"script07: 'PlotReplicates' \n".
			"script08: 'PlotHeatmap'";

			File::put("$dir/workingDir/configuration.yaml", $config);
			if ($req->hasFile('libFile')) {
				\Log::debug("Lib file provided. Moving.");
				$req->file('libFile')->move("$dir/workingDir/Library/", "library.tsv");
			}
			else {
				\Log::debug("No lib file provided. Copying default.\n =================");
				\Log::debug("Has file");
				\Log::debug(print_r((int)$req->hasFile('libFile'),true));
				\Log::debug("Is Valid");
				\Log::debug(print_r((int)$req->file('libFile')->isValid(),true));
				\Log::debug("File itself");
				\Log::debug(print_r($req->file('libFile'),true));
				\Log::debug("File error number");
				\Log::debug(print_r($req->file('libFile')->getError(),true));
				\Log::debug("File error message");
				\Log::debug(print_r($req->file('libFile')->getErrorMessage(),true));
				File::copy(app()->basePath().'/storage/exampleFiles/GeCKOv2_library.tsv', "$dir/workingDir/Library/library.tsv");
			}
	}

	public function getResults($id)
	{
		$run = Run::findOrFail($id);
		return view('results')->with('run',$run);
	}

	public function getRuns()
	{
		return Run::all();
	}
	//
}
