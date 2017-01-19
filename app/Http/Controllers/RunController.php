<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
	public function postCreateRun(Request $request)
	{
		$email = $request->input('email');
		$name = $request->input('name');
		$status = 'upload';

		$run = Run::create( [
			'email'=>$email,
			'name'=>$name,
			'status'=> $status,
			'dir'=>time()
		]);

		makeDir( $run->directory() );

		return redirect()->route('upload', ['id'=>$run->id, 'dir'=>$dir]);
	}

	// Show upload page if run is in upload step. 
	public function getUpload($id)
	{
		# code...
	}

	// Prevent lock recipe from further uploads, start the run. 
	public function postStart($id)
	{
		# code...
	}

	// Return result page
	public function getResult($id)
	{
		# code...
	}

	public function getRuns()
	{
		return Run::all();
	}
	//
}
