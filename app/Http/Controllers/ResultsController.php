<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Run;

class ResultsController extends Controller
{
    public function getCandidateLists($id) {
    	$run = Run::findOrFail($id);
        return view('layouts.file_selector', ['withControl' => false, 'runHash'=>$run->dir, 'result'=>'candidate_lists']);
    }
    public function getControl($id) {
    	$run = Run::findOrFail($id);
    	return view('results.control', ['runHash'=>$run->dir]);
    }
    public function getHeatmap($id) {
    	$run = Run::findOrFail($id);
        $file = \File::glob($run->directory()."/workingDir/Analysis/Heatmap/*.png");
        $file = array_pop($file);
        $link = "/run-images?path=".urlencode("/$run->dir/workingDir/Analysis/Heatmap/".basename($file));
    	return view('results.heatmap', ["link"=>$link]);
    }
    public function getQc($id) {
    	$run = Run::findOrFail($id);
    	return view('results.qc', ['runHash'=>$run->dir]);
    }
    public function getScatterPlots($id) {
    	$run = Run::findOrFail($id);
        return view('layouts.file_selector', ['withControl' => false, 'runHash'=>$run->dir, 'result'=>'scatter_plots']);
    	// return view('results.scatter_plots', ['run'=>$run]);
    }
    public function getSgrnaEfficiency($id) {
    	$run = Run::findOrFail($id);
        return view('layouts.file_selector', ['withControl' => false, 'runHash'=>$run->dir, 'result'=>'sgrna_efficiency']);
    }
    public function getOutputLog($id) {
    	$run = Run::findOrFail($id);
    	return view('results.output_log', ['run'=>$run]);
    }
}
