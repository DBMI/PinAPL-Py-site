<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Run;

use Illuminate\Support\Facades\DB;

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
			'dir' => time()
		]);
		$run->dir=$run->dir.'_'.$run->id;
		$run->save();

		$dir = $run->directory();
		makeDir( $dir, 0775 );
		makeDir( $dir."/workingDir", 0775 );
		makeDir( $dir."/workingDir/Data", 0775 );
		makeDir( $dir."/workingDir/Library", 0775 );

		\Illuminate\Support\Facades\Mail::to($run->email)->send(new \App\Mail\RunCreated($run));
		
		return redirect("/upload/$run->id");
	}

	// Prevent lock recipe from further uploads, start the run. 
	public function postStart(Request $req, $id)
	{
		try {
			DB::beginTransaction();

			$run = Run::findOrFail($id);

			$dir = $run->directory();
			File::put("$dir/status.log", 'Queued');


	    $data = $req->all();
	    $this->generateConfig($req, $run->directory());


	    $runCmd = "bash ".app()->basePath()."/app/Scripts/startRun.sh $dir > $dir/runStatus.log";
	    File::put("$dir/runCmd.sh", $runCmd);
	    $runsInQueue = Run::where('status','queued')->exists();
	    if (! $runsInQueue) {
				dispatch((new \App\Jobs\StartRun($run))->onQueue("start_run"));
		    $run->status='running';
	    }
	    else{
		    $run->status='queued';
	    }
	    $run->save();

	    DB::commit();
		} catch (Exception $e) {
			Log::error($e);
		}


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
		$runDir = $run->directory();
		$dataDir = $runDir."/workingDir/Data";
		$files = File::files($dataDir);
		$numControl = $numTreatment = 0;
		// For generating excel sheet
		$excelRows = [];
		// Map of files, group, index
		$treatmentMap = ['control'=>[], 'treatment'=>[]];
		$conditionCounts = [];
		foreach ($files as $file) {
			$basename = basename($file);
			$groupInputName = "group-".str_replace(".", "_", $basename);
			$renameInputName = "rename-".str_replace(".", "_", $basename);
			$group = $request->input($groupInputName);
			switch ($group) {
				case 'control':
					$prefix = "Control";
					break;
				case 'treatment':
					$prefix = $request->input($renameInputName,"Treatment");
					if (empty($prefix)) {
						$prefix = "Treatment";
					}
					break;
				default:
					$prefix="ERROR";
					break;
			}
			$conditionCounts[$prefix] = ($conditionCounts[$prefix] ?? 0) + 1;
			array_push($excelRows, ['FILENAME'=>$basename, 'TREATMENT' => $prefix]);
			$treatmentMap[$group][$basename] = (object)["condition"=>$prefix, "index"=>$conditionCounts[$prefix]];
		}
		File::put("$runDir/fileMap.json", json_encode($treatmentMap));

		\Excel::create('DataSheet', function($excel) use (&$excelRows){

		    $excel->sheet('Sheet1', function($sheet) use (&$excelRows){

	          $sheet->with($excelRows, null, 'A1', false, false);

	      });

		})->save('xlsx',"$runDir/workingDir/");

		$run->status = "setting-parameters";
		$run->save();
		return redirect("/parameters/$id");
	}

	public function generateConfig($req, $dir)
	{


		$config = "";
		$libFilename = $req->input("LibFilename");
		$customFile;
		$customFilename;
		if ($libFilename == 'custom') {
			$customFile = $req->file('custom-lib-file');
			$customFilename = $customFile->getClientOriginalName();
			\Log::debug("Custom File selected, name: ".$customFilename);
		}
		foreach (config('pinapl_config.parameter_groups') as $groupname => $parameters) {
			$config.= "# $groupname \n";
			if ($groupname == "Library Parameters") {
				if ($libFilename=='custom') {
					if ($req->hasFile('custom-lib-file')) {
						\Log::debug("Lib file provided. Moving.");
						$customFile->move("$dir/workingDir/Library/",$customFilename);
					}
					else {
						\Log::error("Custom Lib selected, but no file provided");
					}
				}
				else{
					$folderName = config('pinapl_config.libraries')[$libFilename];
					$libPath = resource_path("libraries/$folderName");
					$libParameters = File::get("$libPath/library_parameters.txt");
					$bowTieCopySuccessful = File::copyDirectory("$libPath/Bowtie2_Index", "$dir/workingDir/Library/Bowtie2_Index");
					File::copy("$libPath/$libFilename", "$dir/workingDir/Library/$libFilename");
					$config.= "\n$libParameters\n";
					continue;
				}
			}
			foreach ($parameters as $param_name => $param_properties) {
				if ($param_name == "LibFilename"&& $libFilename =="custom") {
					\Log::debug("In LibFilename ifblock");
					$value = $customFilename;
				}
				else {
					if (!empty($req->input($param_name))) {
						$value = $req->input($param_name);
					}
					else {
						$value = $param_properties['default'];
					}
				}
				if ($param_properties['in_quotes']) {
					$config .= "$param_name".":"." '$value' \n";
				}
				else {
					$config .= "$param_name".":"." $value \n";
				}
			}
			$config.="\n";
		}
		
		$config .= config('pinapl_config.directories');
		$config .= "\n";
		$config .= config('pinapl_config.script_filenames');

		File::put("$dir/workingDir/configuration.yaml", $config);
		File::put("$dir/workingDir/output.log", "");
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
