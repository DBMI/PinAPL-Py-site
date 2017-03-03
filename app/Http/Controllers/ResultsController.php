<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Run;

class ResultsController extends Controller
{
    /*************************************
     *** Enrichment / Depletion
     ************************************/
    public function getP_Values($id) {
        $run = Run::findOrFail($id);
        return view('layouts.file_selector', ['withControl' => false, 'runHash'=>$run->dir, 'result'=>'p-values']);
    }
    public function getGeneRankings($id) {
        $run = Run::findOrFail($id);
        return view('layouts.file_selector', ['withControl' => false, 'runHash'=>$run->dir, 'result'=>'gene_rankings']);
    }
    public function getSgrnaRankings($id) {
        $run = Run::findOrFail($id);
        return view('layouts.file_selector', ['withControl' => false, 'runHash'=>$run->dir, 'result'=>'sgrna_rankings']);
    }
    public function getSgrnaEfficiency($id) {
        $run = Run::findOrFail($id);
        return view('layouts.file_selector', ['withControl' => false, 'runHash'=>$run->dir, 'result'=>'sgrna_efficiency']);
    }
    public function getControl($id) {
        $run = Run::findOrFail($id);
        return view('results.control_component', ['runHash'=>$run->dir]);
    }
    /*************************************
     *** Statistics
     ************************************/
    public function getAlignmentStatistics($id) {
        $run = Run::findOrFail($id);
        return view('layouts.file_selector', ['withControl' => true, 'runHash'=>$run->dir, 'result'=>'alignment_statistics']);
    }
    public function getReadCountStatistics($id) {
        $run = Run::findOrFail($id);
        return view('layouts.file_selector', ['withControl' => true, 'runHash'=>$run->dir, 'result'=>'readcount_statistics']);
    }
    /*************************************
     *** Scatter Plots
     ************************************/
    public function getReadCountScatterplots($id) {
        $run = Run::findOrFail($id);
        return view('layouts.file_selector', ['withControl' => false, 'runHash'=>$run->dir, 'result'=>'readcount_scatterplots']);
    }
    public function getReplicateCorrelation($id) {
        $run = Run::findOrFail($id);
        return view('results.replicate_correlation_component', ['runHash'=>$run->dir]);
    }
    /*************************************
     *** Heatmap
     ************************************/
    public function getHeatmap($id) {
        $run = Run::findOrFail($id);
        $file = \File::glob($run->directory()."/workingDir/Analysis/Heatmap/*.png");
        $file = array_pop($file);
        $link = "/run-images?path=".urlencode("/$run->dir/workingDir/Analysis/Heatmap/".basename($file));
        return view('results.heatmap_component', ["link"=>$link]);
    }
    /*************************************
     *** Output
     ************************************/
    public function getOutputLog($id) {
        $run = Run::findOrFail($id);
        return view('results.output_log', ['run'=>$run]);
    }


    public function getCandidateLists($id) {
        $run = Run::findOrFail($id);
        return view('layouts.file_selector', ['withControl' => false, 'runHash'=>$run->dir, 'result'=>'candidate_lists']);
    }
}
