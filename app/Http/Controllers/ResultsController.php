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
        return view('layouts.file_selector', ['withControl' => false, 'runHash'=>$hash, 'result'=>'p-values']);
    }
    public function getGeneRankings($hash) {
        return view('layouts.file_selector', ['withControl' => false, 'runHash'=>$hash, 'result'=>'gene_rankings']);
    }
    public function getSgrnaRankings($hash) {
        return view('layouts.file_selector', ['withControl' => false, 'runHash'=>$hash, 'result'=>'sgrna_rankings']);
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
        return view('layouts.file_selector', ['withControl' => true, 'runHash'=>$hash, 'result'=>'readcount_statistics']);
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
                <select id=readcount_scatterplots_gene_selector>";
        foreach ($genes as $gene) {
            $afterSelectorColumn.="<option value=$gene>$gene</option>";
        }
        $afterSelectorColumn.="</select></div>";
        $afterSelectorRow = 
        "<script>setTimeout(function() {
            $('#readcount_scatterplots_gene_selector').change(function() {
                gene = this.value;
                prefix = $('#readcount_scatterplots_selector').find(':selected').attr('data-prefix');
                console.log(gene);
                console.log(prefix);
                $('#'+prefix+'-readcount-scatterplot').addClass('loader');
                $.get('/results/readcount_scatterplots_gene_select/'+runHash+'/'+prefix+'/'+gene, function(data) {  
                    $('#'+prefix+'-readcount-scatterplot').attr('src',data);
                    $('#'+prefix+'-readcount-scatterplot').removeClass('loader');
                });
            })
        }, 0);</script>";
        return view('layouts.file_selector', ['withControl' => false, 'runHash'=>$hash, 'result'=>'readcount_scatterplots', 'afterSelectorColumn'=>$afterSelectorColumn, 'afterSelectorRow'=>$afterSelectorRow]);
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

    public function getNewScatterPlot($hash, $prefix, $gene) {
        $dir = storage_path("/runs/$hash/workingDir");
        if(!\File::exists("$dir/Analysis/ReadCount_Scatterplots/".$prefix.'_'.$gene.'_counts.png')){
            `docker run -v $dir:/workingdir oncogx/pinaplpy_docker:beta_v2.4.1 PlotCounts.py $prefix $gene`;
        }

        $imgPath = "/run-images?path=".urlencode("/$hash/workingDir/Analysis/ReadCount_Scatterplots/".$prefix.'_'.$gene.'_counts.png');
        return $imgPath;
    }
}
