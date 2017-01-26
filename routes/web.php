<?php

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
$app->get('/test/', function ()  {
	\Log::info('Test Page accessed');
	$run = \App\Run::findOrFail(2);
	dispatch(new \App\Jobs\CompressRun($run));
	\Log::info('CompressRun dispatched');
});

$app->get('/upload/{id}', ['as'=>'upload', function ($id) {
	$run = \App\Run::findOrFail($id);
	if ($run->status == 'uploading') {
		return view('upload', ['id'=>$id, 'dir'=>$run->directory().'/workingDir/Data']);
	}
	else {
		return redirect("/run/$id");
	}
}]);

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

$app->get('/foundation', function () use ($app) {
	// return $app->version();
	return $app->make('view')->make('foundation');
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


$app->get('/run/{id}/image/{filename}', function ($id, $filename)
{

	try {
		$run = \App\Run::findOrFail($id);
		
		$path = $run->directory() . '/' . $filename;

		if(!File::exists($path)) abort(404);

		$file = File::get($path);
		$type = File::mimeType($path);

		$response = Response::make($file, 200);
		$response->header("Content-Type", $type);

		return $response;
	} 
	catch(ModelNotFoundException $e) {
		abort(404);
	}
	
});