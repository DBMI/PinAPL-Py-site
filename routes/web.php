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

$app->get('/', function () use ($app) {
	// return $app->version();
	return $app->make('view')->make('welcome');
});

// The upload page for a run. If the run has a status of running, redirect to run page
$app->get('/upload/{id}', ['as'=>'upload', function ($id) {
	$run = \App\Run::findOrFail($id);
	if ($run->status == 'uploading') {
		return view('upload', ['id'=>$id, 'dir'=>$run->directory().'/workingDir/Data']);
	}
	else {
		return redirect("/run/$id");
	}
}]);

// Display the run results. Unless the run is still in the upload stage, then redirect to upload page
$app->get('/run/{id}', function ($id)  {
	try {
		$run = \App\Run::findOrFail($id);
		switch ($run->status) {
			case 'uploading':
				return redirect("/upload/$id");
				break;
			
			default:
				return view('run', ['run'=>$run, 'dir'=>$run->directory()]);
				break;
		}
		
	} 
	catch(Exception $e) {
		abort(404);
	}
});

// Return a download of the results archive for a finished run.
// If it does not exist or is not finished, 404
$app->get('/run/download/{id}', function ($id)  {
	try {
		$run = \App\Run::findOrFail($id);
		if ($run->status == "finished") {
			return download($run->directory()."/archive.tgz");
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
$app->get('/run/status/{id}', function ($id)  {
	try {
		$run = \App\Run::findOrFail($id);
		return $run->status;
	} 
	catch(Exception $e) {
		abort(404);
	}
});

$app->post('/createRun', [
	'as' => 'create', 'uses' => 'RunController@postCreate'
]);
$app->post('/run/start/{id}', [
	'as' => 'start', 'uses' => 'RunController@postStart'
]);

$app->get('getRuns', [
	'as' => 'runs', 'uses' => 'RunController@getRuns'
]);

$app->get('uploadProgress', [
	'as' => 'uploadProgress', 'uses' => 'FileController@getUploadProgress'
]);
$app->post('renameFile', [
	'as' => 'renameFile', 'uses' => 'FileController@postRenameFile'
]);
$app->post('deleteData', [
	'as' => 'deleteData', 'uses' => 'FileController@postDeleteData'
]);

// Return an image stored in a run directory. 
$app->get('/run/{id}/images', function (\Illuminate\Http\Request $request, $id)
{

	try {
		$run = \App\Run::findOrFail($id);
		
		$path = $run->directory() . '/workingDir/' . $request->input('path');
		

		if(!\Illuminate\Support\Facades\File::exists($path)) abort(404);

		$file = Illuminate\Support\Facades\File::get($path);
		$type = Illuminate\Support\Facades\File::mimeType($path);

		$response = new Response($file, 200);
		$response->header("Content-Type", $type);

		return $response;
		// return $path;
	} 
	catch(ModelNotFoundException $e) {
		abort(404);
	}
	
});


$app->get('/run/results/{id}', [
	'as' => 'results', 'uses' => 'RunController@getResults'
]);