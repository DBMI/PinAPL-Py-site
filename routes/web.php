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
Route::get('/contact', function () {
	return view('contact');
});

// The upload page for a run. If the run has a status of running, redirect to run page
Route::get('/upload/{id}', ['as'=>'upload', function ($id) {
	$run = \App\Run::findOrFail($id);
	if ($run->status == 'uploading') {
		return view('upload', ['id'=>$id, 'dir'=>$run->directory().'/workingDir/Data']);
	}
	else {
		return redirect("/run/$id");
	}
}]);

// Display the run results. Unless the run is still in the upload stage, then redirect to upload page
Route::get('/run/{id}', function ($id)  {
	// try {
		$run = \App\Run::findOrFail($id);
		$redirect = $run->redirectFromStatus('running');
		if ($redirect) {
			return $redirect;
		}
		else {
			return view('run', ['run'=>$run, 'dir'=>$run->directory()]);
		}
		
	// } 
	// catch(Exception $e) {
	// 	abort(404);
	// }
});

// Manage the uploaded files
Route::get('/files/{id}', function ($id)  {
	try {
		$run = \App\Run::findOrFail($id);
		$redirect = $run->redirectFromStatus('managing-files');
		if ($redirect) {
			return $redirect;
		}
		else {
			$files = Illuminate\Support\Facades\File::files($run->directory()."/workingDir/Data");
			return view('files', ['run'=>$run, 'files'=>$files]);
		}
		
	} 
	catch(Exception $e) {
		abort(404);
	}
});

// Create the configuration.yaml
Route::get('/parameters/{id}', function ($id)  {
	try {
		$run = \App\Run::findOrFail($id);
		$redirect = $run->redirectFromStatus('setting-parameters');
		if ($redirect) {
			return $redirect;
		}
		else {
			return view('parameters', ['run'=>$run]);
		}
		
	} 
	catch(Exception $e) {
		abort(404);
	}
});

// Return a download of the results archive for a finished run.
// If it does not exist or is not finished, 404
Route::get('/run/download/{id}', function ($id)  {
	try {
		$run = \App\Run::findOrFail($id);
		if ($run->status == "finished") {
			return download($run->directory()."/archive.zip", sanitizeFileName($run->name) .'_'. $run->dir . ".zip");
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
Route::get('/run/status/{id}', function ($id)  {
	try {
		$run = \App\Run::findOrFail($id);
		return $run->status;
	} 
	catch(Exception $e) {
		abort(404);
	}
});

Route::post('/createRun', [
	'as' => 'create', 'uses' => 'RunController@postCreate'
]);
Route::post('/run/start/{id}', [
	'as' => 'start', 'uses' => 'RunController@postStart'
]);
Route::post('/done-uploading/{id}', [
	'as' => 'start', 'uses' => 'RunController@postDoneUploading'
]);

Route::post('/configure-files/{id}', [
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


Route::get('/run/results/{id}', [
	'as' => 'results', 'uses' => 'RunController@getResults'
]);


// Return a download of the sample-data
Route::get('/sample-data', function ()  {
	try {
		return download(resource_path("exampleFiles/PinAPL-py_demo_data.zip"));
	} 
	catch(Exception $e) {
		abort(404);
	}
});



/**************************************************************************
 *** Results requests
**************************************************************************/
/*** Enrichment / Depletion *********/
Route::get('/results/p-values/{id}',           'ResultsController@getP_Values');
Route::get('/results/gene_rankings/{id}',  'ResultsController@getGeneRankings');
Route::get('/results/sgrna_rankings/{id}',  'ResultsController@getSgrnaRankings');
Route::get('/results/sgrna_efficiency/{id}',  'ResultsController@getSgrnaEfficiency');
Route::get('/results/control/{id}',           'ResultsController@getControl');

/*** Statistics *********************/
Route::get('/results/readcount_statistics/{id}',           'ResultsController@getReadCountStatistics');
Route::get('/results/alignment_statistics/{id}',           'ResultsController@getAlignmentStatistics');

/*** Scatter Plots ******************/
Route::get('/results/readcount_scatterplots/{id}',     'ResultsController@getReadCountScatterplots');
Route::get('/results/replicate_correlation/{id}',     'ResultsController@getReplicateCorrelation');

/*** Heatmap ************************/
Route::get('/results/heatmap/{id}',           'ResultsController@getHeatmap');

/*** Output *************************/
Route::get('/results/output_log/{id}',        'ResultsController@getOutputLog');

Route::get('/results/candidate_lists/{id}',   'ResultsController@getCandidateLists');
Route::get('/results/qc/{id}',                'ResultsController@getQc');


// TEST ROUTES



// Route::get('/test-excel', function ()
// {
// 	$rows=[
// 		["FILENAME"=>"File1","TREATMENT"=>"Control"],
// 		["FILENAME"=>"File2","TREATMENT"=>"Control"],
// 		["FILENAME"=>"File3","TREATMENT"=>"ToxinA"],
// 		["FILENAME"=>"File4","TREATMENT"=>"ToxinB"],
// 		["FILENAME"=>"File5","TREATMENT"=>"ToxinB"],
// 		["FILENAME"=>"File6","TREATMENT"=>"ToxinA"]
// 	];
// 	Excel::create('DataSheet', function($excel) use (&$rows){

// 	    $excel->sheet('Sheet1', function($sheet) use (&$rows){

//           $sheet->with($rows, null, 'A1', false, false);

//       });

// 	})->save('xlsx',storage_path('/runs/myrun/'));
// });

Route::get('/test', function ()
{
	$run = \App\Run::findOrFail(10);
	return view('layouts.file_selector', ['withControl'=>false, 'runDir'=>$run->directory(), 'result'=>'sgrna_efficiency', 'runHash'=>$run->dir]);
});


