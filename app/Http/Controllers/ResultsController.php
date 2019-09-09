<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Run;

use Symfony\Component\Yaml\Yaml;

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
	//added for sgRNA density plots
	public function getSgrnaDensity($hash) {
		return view('layouts.file_selector', ['withControl' => false, 'runHash'=>$hash, 'result'=>'density_plots']);
	}
	//added for Gene tab p-val dist
	public function getGenePValue($hash) {
		return view('layouts.file_selector', ['withControl' => false, 'runHash'=>$hash, 'result'=>'gene_pvalue']);
	}
	//added for sgRNA p-val
	public function getSgrnaPvalue($hash) {
		return view('layouts.file_selector', ['withControl' => false, 'runHash'=>$hash, 'result'=>'pvalue_dist']);
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
	//new
	public function getReadcountDispersion($hash) {
		return view('results.readcount_dispersion_component', ['runHash'=>$hash]);
	}
	public function getReadcountDistribution($hash) {
		return view('layouts.file_selector', ['withControl' => true, 'runHash'=>$hash, 'result'=>'readcount_distribution']);
	}
	public function getReplicateCorrelation($hash) {
		return view('results.replicate_correlation_component', ['runHash'=>$hash, 'result'=>'replicate_correlation']);
	}
	/*************************************
	 *** Scatter Plots
	 ************************************/
	/* WIP 9/4/2019
	public function getScatterplots($hash, $id, $idSingular) {
		$genes = 
			\DB::table('gene_rankings')
				->where('dir',$hash)->orderBy('gene')
				->distinct()->pluck('gene');
		$afterSelectorColumn = 
			"<div class=column>
				<select id=$id+_gene_selector>
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
				$('#'+prefix+'-+$idSingular').addClass('loader');
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
	*/
	public function getReadCountScatterplots($hash) {
		$dir = storage_path("/runs/$hash/workingDir");
		$data = Yaml::parseFile("$dir/Analysis/00_LogFile/configuration.yaml");
		$nonT_bool = $data["ShowNonTargets"];
		$nonT_checked = $nonT_bool ? "checked" : "";
		$extraData = ['nonT'=>$nonT_bool];
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
				<input type=checkbox id=readcount_scatterplots_nontargeting $nonT_checked>
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
				var showIds = ($('#readcount_scatterplots_show_ids')[0].checked) ? 'True' : 'False';
				var nonT = ($('#readcount_scatterplots_nontargeting')[0].checked) ? 'True' : 'False';
				console.log(gene);
				console.log(prefix);
				console.log(showIds);
				console.log(nonT);
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
		return view('layouts.file_selector', ['withControl'=>false, 'withAvgPrefix'=>true, 'runHash'=>$hash, 'result'=>'readcount_scatterplots', 'afterSelectorColumn'=>$afterSelectorColumn, 'afterSelectorRow'=>$afterSelectorRow,'extraData'=>$extraData]);
	}
	//new
	public function getVolcanoPlots($hash) {
		$dir = storage_path("/runs/$hash/workingDir");
		$data = Yaml::parseFile("$dir/Analysis/00_LogFile/configuration.yaml");
		$nonT_bool = $data["ShowNonTargets"];
		$nonT_checked = $nonT_bool ? "checked" : "";
		$extraData = ['nonT'=>$nonT_bool];
		$genes = 
			\DB::table('gene_rankings')
				->where('dir',$hash)->orderBy('gene')
				->distinct()->pluck('gene');
		$afterSelectorColumn = 
			"<div class=column>
				<select id=volcano_plots_gene_selector>
				<option value=none hidden>Select A Gene</option>
				<option value=none>None</option>";

		foreach ($genes as $gene) {
			$afterSelectorColumn.="<option value=$gene>$gene</option>";
		}
		$afterSelectorColumn.="</select></div>";
		$afterSelectorColumn.=
			"<div class=column>
				<input type=checkbox id=volcano_plots_nontargeting $nonT_checked>
				<label for=volcano_plots_nontargeting>Show non-targeting controls</label>
			</div>
			<div class=column>
				<input type=checkbox id=volcano_plots_show_ids>
				<label for=volcano_plots_show_ids>Show sgRNA IDs</label>
			</div>";
		$afterSelectorRow = 
		"<script>
			function getVolcanoPlot() {
				var gene = $('#volcano_plots_gene_selector').val();
				var prefix = $('#volcano_plots_selector').val();
				var showIds = ($('#volcano_plots_show_ids')[0].checked) ? 'True' : 'False';
				var nonT = ($('#volcano_plots_nontargeting')[0].checked) ? 'True' : 'False';
				console.log(gene);
				console.log(prefix);
				$('#'+prefix+'-volcano-plot').addClass('loader');
				$.get('/results/volcano_plots_gene_select/'+runHash+'/'+prefix+'/'+gene+'/'+showIds+'/'+nonT, function(data) {  
					$('#'+prefix+'-volcano-plot').attr('src',data);
					$('#'+prefix+'-volcano-plot').removeClass('loader');
				});
			}
			$(document).ready(function() {
				$('#volcano_plots_gene_selector').change(getVolcanoPlot);
				$('#volcano_plots_nontargeting').change(getVolcanoPlot);
				$('#volcano_plots_show_ids').change(getVolcanoPlot);
				$('#volcano_plots_selector').change(getVolcanoPlot);
			});
		</script>";
		return view('layouts.file_selector', ['withControl' => false, 'withAvgPrefix'=>true, 'runHash'=>$hash, 'result'=>'volcano_plots', 'afterSelectorColumn'=>$afterSelectorColumn, 'afterSelectorRow'=>$afterSelectorRow,'extraData'=>$extraData]);
	}

	public function getZscorePlots($hash) {
		$dir = storage_path("/runs/$hash/workingDir");
		$data = Yaml::parseFile("$dir/Analysis/00_LogFile/configuration.yaml");
		$nonT_bool = $data["ShowNonTargets"];
		$nonT_checked = $nonT_bool ? "checked" : "";
		$extraData = ['nonT'=>$nonT_bool];
		$genes = 
			\DB::table('gene_rankings')
				->where('dir',$hash)->orderBy('gene')
				->distinct()->pluck('gene');
		$afterSelectorColumn = 
			"<div class=column>
				<select id=zscore_plots_gene_selector>
				<option value=none hidden>Select A Gene</option>
				<option value=none>None</option>";

		foreach ($genes as $gene) {
			$afterSelectorColumn.="<option value=$gene>$gene</option>";
		}
		$afterSelectorColumn.="</select></div>";
		$afterSelectorColumn.=
			"<div class=column>
				<input type=checkbox id=zscore_plots_nontargeting $nonT_checked>
				<label for=zscore_plots_nontargeting>Show non-targeting controls</label>
			</div>
			<div class=column>
				<input type=checkbox id=zscore_plots_show_ids>
				<label for=zscore_plots_show_ids>Show sgRNA IDs</label>
			</div>";
		$afterSelectorRow = 
		"<script>
			function getZscorePlot() {
				var gene = $('#zscore_plots_gene_selector').val();
				var prefix = $('#zscore_plots_selector').val();
				var showIds = ($('#zscore_plots_show_ids')[0].checked) ? 'True' : 'False';
				var nonT = ($('#zscore_plots_nontargeting')[0].checked) ? 'True' : 'False';
				console.log(gene);
				console.log(prefix);
				$('#'+prefix+'-zscore-plot').addClass('loader');
				$.get('/results/zscore_plots_gene_select/'+runHash+'/'+prefix+'/'+gene+'/'+showIds+'/'+nonT, function(data) {  
					$('#'+prefix+'-zscore-plot').attr('src',data);
					$('#'+prefix+'-zscore-plot').removeClass('loader');
				});
			}
			$(document).ready(function() {
				$('#zscore_plots_gene_selector').change(getZscorePlot);
				$('#zscore_plots_nontargeting').change(getZscorePlot);
				$('#zscore_plots_show_ids').change(getZscorePlot);
				$('#zscore_plots_selector').change(getZscorePlot);
			});
		</script>";
		return view('layouts.file_selector', ['withControl' => false, 'withAvgPrefix'=>true, 'runHash'=>$hash, 'result'=>'zscore_plots', 'afterSelectorColumn'=>$afterSelectorColumn, 'afterSelectorRow'=>$afterSelectorRow,'extraData'=>$extraData]);
	}

	public function getGenePlots($hash) {
		$genes = 
			\DB::table('gene_rankings')
				->where('dir',$hash)->orderBy('gene')
				->distinct()->pluck('gene');
		$afterSelectorColumn = 
			"<div class=column>
				<select id=gene_plots_gene_selector>
				<option value=none hidden>Select A Gene</option>
				<option value=none>None</option>";

		foreach ($genes as $gene) {
			$afterSelectorColumn.="<option value=$gene>$gene</option>";
		}
		$afterSelectorColumn.="</select></div>";
		$afterSelectorRow = 
		"<script>
			function getGenePlot() {
				var gene = $('#gene_plots_gene_selector').val();
				var prefix = $('#gene_plots_selector').val();
				console.log(gene);
				console.log(prefix);
				$('#'+prefix+'-gene-plot').addClass('loader');
				$.get('/results/gene_plots_gene_select/'+runHash+'/'+prefix+'/'+gene, function(data) {  
					$('#'+prefix+'-gene-plot').attr('src',data);
					$('#'+prefix+'-gene-plot').removeClass('loader');
				});
			}
			$(document).ready(function() {
				$('#gene_plots_gene_selector').change(getGenePlot);
				$('#gene_plots_selector').change(getGenePlot);
			});
		</script>";
		return view('layouts.file_selector', ['withControl' => false, 'withAvgPrefix'=>true, 'runHash'=>$hash, 'result'=>'gene_plots', 'afterSelectorColumn'=>$afterSelectorColumn, 'afterSelectorRow'=>$afterSelectorRow]);
	}
	/*************************************
	 *** Heatmap
	 ************************************/
	public function getHeatmap($hash) {
		$file = \File::glob(storage_path("/runs/$hash/workingDir/Analysis/02_sgRNA-Ranking_Results/Heatmap/*.png"));
		$file = array_pop($file);
		$link = "/run-images?path=".urlencode("/$hash/workingDir/Analysis/02_sgRNA-Ranking_Results/Heatmap/".basename($file));
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
	public function getNewScatterPlot($hash, $prefix, $gene='none', $showIds, $nonT) {
		$dir = storage_path("/runs/$hash/workingDir");
		$highlightedGene = $prefix.'_Highlighted_Genes/';
		if ($gene == 'none') {
			$_gene = '';
			$_id = '';
			$showIds = 'False';
			if ($nonT == 'False') {
				$_nonT = 'False';
				$fileName =$highlightedGene."counts_".$prefix."_scatterplot".$_gene.$_id.$_nonT.'.png';
				if(!\File::exists("$dir/Analysis/02_sgRNA-Ranking_Results/sgRNA_Scatterplots/$fileName")) {
					$dockerImage = config('docker.image');
					$cmd = "docker run --rm -v \"$dir\":/workingdir \"$dockerImage\" PlotCounts.py \"$prefix\" \"$gene\" \"$showIds\" \"$nonT\"";
					`$cmd`;
				}
				return "/run-images?path=".urlencode("/$hash/workingDir/Analysis/02_sgRNA-Ranking_Results/sgRNA_Scatterplots/counts_".$prefix."_scatterplot.png");
			}
			else {
				$highlightedGene = '';
			}
		}
		else {
			$_gene = "_$gene";
			$_id = ($showIds == 'True') ? '_IDs' : '';
		}
		$_nonT = ($nonT == 'True') ? '_nonT' : '';
		$fileName =$highlightedGene."counts_".$prefix."_scatterplot".$_gene.$_id.$_nonT.'.png';
		if(!\File::exists("$dir/Analysis/02_sgRNA-Ranking_Results/sgRNA_Scatterplots/$fileName")){
			$dockerImage = config('docker.image');
			$cmd = "docker run --rm -v \"$dir\":/workingdir \"$dockerImage\" PlotCounts.py \"$prefix\" \"$gene\" \"$showIds\" \"$nonT\"";
			`$cmd`;
		}
		$imgPath = "/run-images?path=".urlencode("/$hash/workingDir/Analysis/02_sgRNA-Ranking_Results/sgRNA_Scatterplots/$fileName");
		return $imgPath;
	}

	//new
	public function getNewVolcanoPlot($hash, $prefix, $gene='none', $showIds, $nonT) {
		$dir = storage_path("/runs/$hash/workingDir");
		$highlightedGene = $prefix.'_Highlighted_Genes/';
		if ($gene == 'none') {
			$_gene = '';
			$_id = '';
			$showIds = 'False';
			if ($nonT == 'False') {
				$_nonT = 'False';
				$fileName =$highlightedGene.$prefix."_sgRNA_volcano".$_gene.$_id.$_nonT.'.png';
				if(!\File::exists("$dir/Analysis/02_sgRNA-Ranking_Results/sgRNA_VolcanoPlots/$fileName")) {
					$dockerImage = config('docker.image');
					$cmd = "docker run --rm -v \"$dir\":/workingdir \"$dockerImage\" PlotFCvolcano.py \"$prefix\" \"$gene\" \"$showIds\" \"$nonT\"";
					`$cmd`;
				}
				return "/run-images?path=".urlencode("/$hash/workingDir/Analysis/02_sgRNA-Ranking_Results/sgRNA_VolcanoPlots/$prefix"."_sgRNA_volcano.png");
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
		$fileName =$highlightedGene.$prefix."_sgRNA_volcano".$_gene.$_id.$_nonT.'.png';
		if(!\File::exists("$dir/Analysis/02_sgRNA-Ranking_Results/sgRNA_VolcanoPlots/$fileName")){
			$dockerImage = config('docker.image');
			$cmd = "docker run --rm -v \"$dir\":/workingdir \"$dockerImage\" PlotFCvolcano.py \"$prefix\" \"$gene\" \"$showIds\" \"$nonT\"";
			`$cmd`;
		}
		$imgPath = "/run-images?path=".urlencode("/$hash/workingDir/Analysis/02_sgRNA-Ranking_Results/sgRNA_VolcanoPlots/$fileName");
		return $imgPath;
	}

	public function getNewZscorePlot($hash, $prefix, $gene='none', $showIds, $nonT) {
		$dir = storage_path("/runs/$hash/workingDir");
		$highlightedGene = $prefix.'_Highlighted_Genes/';
		if ($gene == 'none') {
			$_gene = '';
			$_id = '';
			$showIds = 'False';
			if ($nonT == 'False') {
				$_nonT = 'False';
				$fileName =$highlightedGene.$prefix."_sgRNA_zScores".$_gene.$_id.$_nonT.'.png';
				if(!\File::exists("$dir/Analysis/02_sgRNA-Ranking_Results/sgRNA_z-Scores/$fileName")){
					$dockerImage = config('docker.image');
					$cmd = "docker run --rm -v \"$dir\":/workingdir \"$dockerImage\" PlotFCz.py \"$prefix\" \"$gene\" \"$showIds\" \"$nonT\"";
					`$cmd`;
				}
				return "/run-images?path=".urlencode("/$hash/workingDir/Analysis/02_sgRNA-Ranking_Results/sgRNA_z-Scores/$prefix"."_sgRNA_zScores.png");
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
		$fileName =$highlightedGene.$prefix."_sgRNA_zScores".$_gene.$_id.$_nonT.'.png';
		if(!\File::exists("$dir/Analysis/02_sgRNA-Ranking_Results/sgRNA_z-Scores/$fileName")){
			$dockerImage = config('docker.image');
			$cmd = "docker run --rm -v \"$dir\":/workingdir \"$dockerImage\" PlotFCz.py \"$prefix\" \"$gene\" \"$showIds\" \"$nonT\"";
			`$cmd`;
		}
		$imgPath = "/run-images?path=".urlencode("/$hash/workingDir/Analysis/02_sgRNA-Ranking_Results/sgRNA_z-Scores/$fileName");
		return $imgPath;
	}

	public function getNewGenePlot($hash, $prefix, $gene='none') {
		$dir = storage_path("/runs/$hash/workingDir");
		$highlightedGene = $prefix.'_Highlighted_Genes/';
		if ($gene == 'none') {
			$_gene = '';
			$highlightedGene = '';
			$fileName =$highlightedGene.$prefix."_GeneScores".$_gene.'.png';
			if(!\File::exists("$dir/Analysis/03_GeneRanking_Results/GeneScore_Scatterplots/$fileName")){
				$dockerImage = config('docker.image');
				$cmd = "docker run --rm -v \"$dir\":/workingdir \"$dockerImage\" PlotGeneScores.py \"$prefix\" \"$gene\"";
				`$cmd`;
			}
			return "/run-images?path=".urlencode("/$hash/workingDir/Analysis/03_GeneRanking_Results/GeneScore_Scatterplots/$prefix"."_GeneScores.png");
		}
		else {
			$_gene = "_$gene";
		}
		$fileName =$highlightedGene.$prefix."_GeneScores".$_gene.'.png';
		if(!\File::exists("$dir/Analysis/03_GeneRanking_Results/GeneScore_Scatterplots/$fileName")){
			$dockerImage = config('docker.image');
			$cmd = "docker run --rm -v \"$dir\":/workingdir \"$dockerImage\" PlotGeneScores.py \"$prefix\" \"$gene\"";
			`$cmd`;
		}
		$imgPath = "/run-images?path=".urlencode("/$hash/workingDir/Analysis/03_GeneRanking_Results/GeneScore_Scatterplots/$fileName");
		return $imgPath;
	}

	public function getGeneRankingsQuery(Request $req, $hash,$prefix)
	{
		$columns = array_keys(\App\GeneRanking::$columns);
		return self::jqQuery($req, 'gene_rankings', $columns, $hash, $prefix);
	}

	public function getGeneCombinedRankingsQuery(Request $req, $hash,$prefix)
	{
		$columns = array_keys(\App\GeneCombinedRanking::$columns);
		return self::jqQuery($req, 'gene_combined_rankings', $columns, $hash, $prefix);
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
		$limit = $req->input('rows') ?? 10;
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
		if($start < 0) $start = 0; 
		

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

		// Seems like limit is being dropped and an offset 0 with out a limit causes an error. 
		if ($start > 0) {
			$query = $query->offset($start);
		}
		$query = $query
			->limit($limit)
			->orderBy($sidx, $sord)
		;


		// header("Content-type: text/xml;charset=utf-8");re
		$response  = (object)['page' => $page, 'total' => $total_pages, 'records' =>$count];
		$response->rows = $query->get();
		return json_encode($response);
	}
}
