<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Run;

class ResultsController extends Controller
{
    public function getCandidateLists($id) {
    	$run = Run::findOrFail($id);
    	return view('results.candidate_lists', ['run'=>$run]);
    }
    public function getControl($id) {
    	$run = Run::findOrFail($id);
    	return view('results.control', ['run'=>$run]);
    }
    public function getHeatmap($id) {
    	$run = Run::findOrFail($id);
    	return view('results.heatmap', ['run'=>$run]);
    }
    public function getQc($id) {
    	$run = Run::findOrFail($id);
    	return view('results.qc', ['run'=>$run]);
    }
    public function getScatterPlots($id) {
    	$run = Run::findOrFail($id);
    	return view('results.scatter_plots', ['run'=>$run]);
    }
    public function getSgrnaEfficiency($id) {
    	$run = Run::findOrFail($id);
    	return view('results.sgrna_efficiency', ['run'=>$run]);
    }
    public function getOutputLog($id) {
    	$run = Run::findOrFail($id);
    	return view('results.output_log', ['run'=>$run]);
    }
}
