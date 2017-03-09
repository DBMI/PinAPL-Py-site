<?php
use Illuminate\Http\Response;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/



Route::get('/', function () {
	return view('welcome');
});


/**************************************************************************
 *** TopBar
**************************************************************************/

Route::get('/contact', function () {
	return view('contact');
});

// Return a download of the sample-data
Route::get('/documentation', function ()  {
	return view('documentation');
});


// The upload page for a run. If the run has a status of running, redirect to run page
Route::get('/upload/{hash}', ['as'=>'upload', function ($hash) {
	$run = \App\Run::where('dir',$hash)->firstOrFail();
	if ($run->status == 'uploading') {
		return view('upload', ['hash'=>$hash, 'dir'=>$run->directory().'/workingDir/Data']);
	}
	else {
		return redirect("/run/$hash");
	}
}]);

// Display the run results. Unless the run is still in the upload stage, then redirect to upload page
Route::get('/run/{hash}', function ($hash)  {
	try {
		$run = \App\Run::where('dir',$hash)->firstOrFail();
		$redirect = $run->redirectFromStatus('running');
		if ($redirect) {
			return $redirect;
		}
		else {
			return view('run', ['run'=>$run, 'hash'=>$hash]);
		}
		
	} 
	catch(Exception $e) {
		\Log::error("Error accessing run page");
		\Log::error($e);
		abort(404);
	}
});

// Manage the uploaded files
Route::get('/files/{hash}', function ($hash)  {
	try {
		$run = \App\Run::where('dir',$hash)->firstOrFail();
		$redirect = $run->redirectFromStatus('managing-files');
		if ($redirect) {
			return $redirect;
		}
		else {
			$files = Illuminate\Support\Facades\File::files($run->directory()."/workingDir/Data");
			return view('files', ['files'=>$files, 'hash'=>$hash]);
		}
		
	} 
	catch(Exception $e) {
		abort(404);
	}
});

// Create the configuration.yaml
Route::get('/parameters/{hash}', function ($hash)  {
	try {
		$run = \App\Run::where('dir',$hash)->firstOrFail();
		$redirect = $run->redirectFromStatus('setting-parameters');
		if ($redirect) {
			return $redirect;
		}
		else {
			return view('parameters', ['hash'=>$hash]);
		}
		
	} 
	catch(Exception $e) {
		abort(404);
	}
});

// Return a download of the results archive for a finished run.
// If it does not exist or is not finished, 404
Route::get('/run/download/{hash}', function ($hash)  {
	try {
		$run = \App\Run::where('dir',$hash)->firstOrFail();
		if ($run->status == "finished") {
			return download($run->directory()."/archive.zip", sanitizeFileName($run->name) .'_'. $hash . ".zip");
		}
		else {
			abort(404);
		}
	} 
	catch(Exception $e) {
		abort(404);
	}
});

// Return the status of a run or a 404 if it does not exist
Route::get('/run/status/{hash}', function ($hash)  {
	try {
		$run = \App\Run::where('dir',$hash)->firstOrFail();
		return $run->status;
	} 
	catch(Exception $e) {
		abort(404);
	}
});

Route::post('/createRun', [
	'as' => 'create', 'uses' => 'RunController@postCreate'
]);
Route::post('/run/start/{hash}', [
	'as' => 'start', 'uses' => 'RunController@postStart'
]);
Route::post('/done-uploading/{hash}', [
	'as' => 'start', 'uses' => 'RunController@postDoneUploading'
]);

Route::post('/configure-files/{hash}', [
	'as' => 'start', 'uses' => 'RunController@postConfigureFiles'
]);

Route::get('/getRuns', [
	'as' => 'runs', 'uses' => 'RunController@getRuns'
]);

Route::get('/uploadProgress', [
	'as' => 'uploadProgress', 'uses' => 'FileController@getUploadProgress'
]);
Route::post('/renameFile', [
	'as' => 'renameFile', 'uses' => 'FileController@postRenameFile'
]);
Route::post('/deleteData', [
	'as' => 'deleteData', 'uses' => 'FileController@postDeleteData'
]);

// Return an image stored in a run directory. 
Route::get('/run-images', function (\Illuminate\Http\Request $request)
{

	try {
		
		$path = storage_path().'/runs/'.$request->input('path');
		

		if(!\Illuminate\Support\Facades\File::exists($path)) abort(404);

		$file = Illuminate\Support\Facades\File::get($path);
		$type = Illuminate\Support\Facades\File::mimeType($path);

		$response = new Response($file, 200);
		$response->header("Content-Type", $type);

		return $response;
	} 
	catch(ModelNotFoundException $e) {
		abort(404);
	}
	
});


/**************************************************************************
 *** Results requests
**************************************************************************/
/*** Enrichment / Depletion *********/
Route::get('/results/p-values/{hash}',           'ResultsController@getP_Values');
Route::get('/results/gene_rankings/{hash}',  'ResultsController@getGeneRankings');
Route::get('/results/sgrna_rankings/{hash}',  'ResultsController@getSgrnaRankings');
Route::get('/results/sgrna_efficiency/{hash}',  'ResultsController@getSgrnaEfficiency');
Route::get('/results/control/{hash}',           'ResultsController@getControl');

/*** Statistics *********************/
Route::get('/results/readcount_statistics/{hash}',           'ResultsController@getReadCountStatistics');
Route::get('/results/alignment_statistics/{hash}',           'ResultsController@getAlignmentStatistics');
Route::get('/results/cutadapt/{hash}',        						   'ResultsController@getCutadapt');

/*** Scatter Plots ******************/
Route::get('/results/readcount_scatterplots/{hash}',     'ResultsController@getReadCountScatterplots');
Route::get('/results/replicate_correlation/{hash}',     'ResultsController@getReplicateCorrelation');

/*** Heatmap ************************/
Route::get('/results/heatmap/{hash}',           'ResultsController@getHeatmap');

/*** Output *************************/
Route::get('/results/output_log/{hash}',        'ResultsController@getOutputLog');

Route::get('/results/candidate_lists/{hash}',   'ResultsController@getCandidateLists');
Route::get('/results/qc/{hash}',                'ResultsController@getQc');
