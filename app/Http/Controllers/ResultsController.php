<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Run;

class ResultsController extends Controller
{
	/*************************************
	 *** Enrichment / Depletion
	 ************************************/
	public function getP_Values($hash) {
		return view('layouts.file_selector', ['withControl' => false, 'runHash'=>$hash, 'result'=>'p-values', 'withAvgPrefix'=>true ]);
	}
	public function getGeneRankings($hash) {
		return view('layouts.file_selector', ['withControl' => false, 'runHash'=>$hash, 'result'=>'gene_rankings', 'fullSize'=>true, 'withCombinedPrefix'=>true ]);
	}
	public function getSgrnaRankings($hash) {
		return view('layouts.file_selector', ['withControl' => false, 'runHash'=>$hash, 'result'=>'sgrna_rankings', 'withAvgPrefix'=>true ]);
	}
	public function getSgrnaEfficiency($hash) {
		return view('layouts.file_selector', ['withControl' => false, 'runHash'=>$hash, 'result'=>'sgrna_efficiency']);
	}
	public function getControl($hash) {
		return view('results.control_component', ['runHash'=>$hash]);
	}
	/*************************************
	 *** Statistics
	 ************************************/
	public function getAlignmentStatistics($hash) {
		return view('layouts.file_selector', ['withControl' => true, 'runHash'=>$hash, 'result'=>'alignment_statistics']);
	}
	public function getReadCountStatistics($hash) {
		return view('layouts.file_selector', ['withControl' => true, 'withAvgPrefix'=>true, 'runHash'=>$hash, 'result'=>'readcount_statistics']);
	}
	public function getCutadapt($hash) {
		return view('layouts.file_selector', ['withControl' => true, 'runHash'=>$hash, 'result'=>'cutadapt']);
	}
	public function getSequenceQuality($hash) {
		return view('layouts.file_selector', ['withControl' => true, 'runHash'=>$hash, 'result'=>'sequence_quality']);
	}
	public function getSequencingDepth($hash) {
		return view('results.sequencing_depth_component', ['runHash'=>$hash]);
	}
	/*************************************
	 *** Scatter Plots
	 ************************************/
	public function getReadCountScatterplots($hash) {
		$genes = 
			\DB::table('gene_rankings')
				->where('dir',$hash)->orderBy('gene')
				->distinct()->pluck('gene');
		$afterSelectorColumn = 
			"<div class=column>
				<select id=readcount_scatterplots_gene_selector>
				<option value=none hidden>Select A Gene</option>
				<option value=none>None</option>";

		foreach ($genes as $gene) {
			$afterSelectorColumn.="<option value=$gene>$gene</option>";
		}
		$afterSelectorColumn.="</select></div>";
		$afterSelectorColumn.=
			"<div class=column>
				<input type=checkbox id=readcount_scatterplots_nontargeting>
				<label for=readcount_scatterplots_nontargeting>Show non-targeting controls</label>
			</div>
			<div class=column>
				<input type=checkbox id=readcount_scatterplots_show_ids>
				<label for=readcount_scatterplots_show_ids>Show sgRNA IDs</label>
			</div>";
		$afterSelectorRow = 
		"<script>
			function getReadCountScatterPlot() {
				var gene = $('#readcount_scatterplots_gene_selector').val();
				var prefix = $('#readcount_scatterplots_selector').val();
				var showIds = ($('#readcount_scatterplots_show_ids')[0].checked) ? 'True' : 'none';
				var nonT = ($('#readcount_scatterplots_nontargeting')[0].checked) ? 'True' : 'none';
				console.log(gene);
				console.log(prefix);
				$('#'+prefix+'-readcount-scatterplot').addClass('loader');
				$.get('/results/readcount_scatterplots_gene_select/'+runHash+'/'+prefix+'/'+gene+'/'+showIds+'/'+nonT, function(data) {  
					$('#'+prefix+'-readcount-scatterplot').attr('src',data);
					$('#'+prefix+'-readcount-scatterplot').removeClass('loader');
				});
			}
			$(document).ready(function() {
				$('#readcount_scatterplots_gene_selector').change(getReadCountScatterPlot);
				$('#readcount_scatterplots_nontargeting').change(getReadCountScatterPlot);
				$('#readcount_scatterplots_show_ids').change(getReadCountScatterPlot);
				$('#readcount_scatterplots_selector').change(getReadCountScatterPlot);
			});
		</script>";
		return view('layouts.file_selector', ['withControl' => false, 'withAvgPrefix'=>true, 'runHash'=>$hash, 'result'=>'readcount_scatterplots', 'afterSelectorColumn'=>$afterSelectorColumn, 'afterSelectorRow'=>$afterSelectorRow]);
	}
	public function getReplicateCorrelation($hash) {
		return view('results.replicate_correlation_component', ['runHash'=>$hash]);
	}
	/*************************************
	 *** Heatmap
	 ************************************/
	public function getHeatmap($hash) {
		$file = \File::glob(storage_path("/runs/$hash/workingDir/Analysis/Heatmap/*.png"));
		$file = array_pop($file);
		$link = "/run-images?path=".urlencode("/$hash/workingDir/Analysis/Heatmap/".basename($file));
		return view('results.heatmap_component', ["link"=>$link]);
	}
	/*************************************
	 *** Output
	 ************************************/
	public function getOutputLog($hash) {
		return view('results.output_log', ['dir'=>$hash]);
	}


	public function getCandidateLists($hash) {
		return view('layouts.file_selector', ['withControl' => false, 'runHash'=>$hash, 'result'=>'candidate_lists']);
	}




	/*************************************
	 *** Extra
	 ************************************/

	// Generate new scatter plots with gene selection
	public function getNewScatterPlot($hash, $prefix, $gene='none', $showIds='none' ,$nonT='none') {
		$dir = storage_path("/runs/$hash/workingDir");
		$highlightedGene = 'Highlighted_Genes/';
		if ($gene == 'none') {
			$_gene = '';
			$_id = '';
			$showIds = 'none';
			if ($nonT == 'none') {
				return "/run-images?path=".urlencode("/$hash/workingDir/Analysis/ReadCount_Scatterplots/counts_$prefix.png");
			}
			else{
				$highlightedGene = '';
			}
		}
		else {
			$_gene = "_$gene";
			$_id = ($showIds == 'True') ? '_IDs' : '';
		}
		$_nonT = ($nonT == 'True') ? '_nonT' : '';
		$fileName =$highlightedGene."counts_".$prefix.$_gene.$_id.$_nonT.'.png';
		if(!\File::exists("$dir/Analysis/ReadCount_Scatterplots/$fileName")){
			$dockerImage = config('docker.image');
			$cmd = "docker run --rm -v \"$dir\":/workingdir \"$dockerImage\" PlotCounts.py \"$prefix\" \"$gene\" \"$showIds\" \"$nonT\"";
			\Log::debug($cmd);
			`$cmd`;
		}
		$imgPath = "/run-images?path=".urlencode("/$hash/workingDir/Analysis/ReadCount_Scatterplots/$fileName");
		return $imgPath;
	}

	public function getGeneRankingsQuery(Request $req, $hash,$prefix)
	{
		$columns = array_keys(\App\GeneRanking::$columns);
		return self::jqQuery($req, 'gene_rankings', $columns, $hash, $prefix);
	}

	public function getSGRNARankingsQuery(Request $req, $hash,$prefix)
	{
		$columns = array_keys(\App\SgrnaRanking::$columns);
		return self::jqQuery($req, 'sgrna_rankings', $columns, $hash, $prefix);
	}


	private function jqQuery($req, $table, $columns, $hash, $prefix){
		// Current page # of results 
		$page = $req->input('page');
		// Number of rows per table page
		$limit = $req->input('rows');
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel
		// If not provided, use 1st column 
		$sidx = $req->input('sidx') ?? 'gene';
		// sorting order - at first time sortorder
		$sord = $req->input('sord');

		// calculate the starting position of the rows 
		$start = $limit*$page -$limit;
		// if for some reasons start position is negative set it to 0 
		// typical case is that the user type 0 for the requested page 
		if($start <0) $start = 0; 
		

		$query = \DB::table($table)->select($columns)
			->where('dir',$hash)
			->where('file',$prefix)
		;
		// Number of rows for query
		$count = $query->count();

		// calculate the total pages for the query 
		if( $count > 0 && $limit > 0) { 
					  $total_pages = ceil($count/$limit); 
		} else { 
					  $total_pages = 0; 
		} 

		$query = $query
			->offset($start)
			->limit($limit)
			->orderBy($sidx, $sord)
		;


		// header("Content-type: text/xml;charset=utf-8");re
		$response  = (object)['page' => $page, 'total' => $total_pages, 'records' =>$count];
		$response->rows = $query->get();
		return json_encode($response);
	}
}
