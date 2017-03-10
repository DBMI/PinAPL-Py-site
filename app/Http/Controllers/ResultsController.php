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
        return view('layouts.file_selector', ['withControl' => false, 'runHash'=>$hash, 'result'=>'readcount_scatterplots']);
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
}
