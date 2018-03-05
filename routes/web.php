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
	$bytes = disk_free_space(storage_path()); 
	if ($bytes < 30*1024*1024*1024) {
	// if ($bytes < 30*1024*1024*1024) {
		return view('no_space');
	}
	else{
		return view('welcome');
	}
});


/**************************************************************************
 *** TopBar
**************************************************************************/

Route::get('/contact', function () {
	return view('contact');
});

// Return a download of the sample-data

Route::get('/example-data', function ()
{
		$path = resource_path('exampleFiles/PinAPL-py_demo_data.zip');
		$filename = 'PinAPL-py_demo_data.zip';
		header("X-Sendfile: $path");
		header("Content-type: application/octet-stream");
		header('Content-Disposition: attachment; filename="' . $filename . '"');
		exit;
});

Route::get('/documentation', function ()  {
	return view('documentation');
});

//Return example output results page
Route::get('/example-results', function ()
{
	return view('results',['runName'=>"Example Run", 'hash'=>"example-run"]);
});


// The upload page for a run. If the run has a status of running, redirect to run page
Route::get('/upload/{hash}', ['as'=>'upload', function ($hash) {
	$run = \App\Run::where('dir',$hash)->firstOrFail();
	if ($run->status == 'uploading') {
		File::cleanDirectory($run->directory().'/workingDir/Data');
		$noEmail = empty($run->email);
		return view('upload', ['hash'=>$hash, 'dir'=>$run->directory().'/workingDir/Data','noEmail'=>$noEmail]);
	}
	else {
		return redirect("/run/$hash");
	}
}]);

// Display the run results. Unless the run is still in the upload stage, then redirect to upload page
Route::get('/run/{hash}', function ($hash)  {
	try {
		$run = \App\Run::where('dir',$hash)->first();
		if(empty($run)){
			return view('run_not_found');
		}
		$status = $run->status;
		$redirect = $run->redirectFromStatus('running');
		if ($redirect) {
			return $redirect;
		}
		else if ($run->status == "finished") {
			return view('results',['runName'=>$run->name, 'hash'=>$hash]);
		}
		// else if ($status == 'running' || $status = 'error' || $status = 'queued') {
		else {
			return view('run', ['run'=>$run, 'hash'=>$hash]);
		}
	} 
	catch(Exception $e) {
		\Log::error("Error accessing run page; Run: "+$hash);
		if(!empty($run)){
			\Log::error('Run status: '.$run->status);
		}
		else {
			\Log::error('Run does not exist');
		}
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
		\Log::error("Exception thrown on /parameters/$hash");
		\Log::error($e);
		abort(404);
	}
});

// Return a download of the results archive for a finished run.
// If it does not exist or is not finished, 404
Route::get('/run/download/{hash}', function ($hash)  {
	try {
		$path = storage_path("/runs/$hash/archive.zip");
		$runName = $hash;
		$filename = sanitizeFileName("PinAPL-py_example_run.zip");
		if ($hash != "example-run") {
			$run = \App\Run::where('dir',$hash)->firstOrFail();
			$filename = sanitizeFileName($runName) .'_'. $hash . ".zip";
		}
		if (\File::exists($path)) {
			//header("Pragma: public");
			//header("Expires: 0");
			//header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			//header("Cache-Control: public");
			//header("Content-Description: File Transfer");
			//header("Content-type: application/octet-stream");
			//header("Content-Disposition: attachment; filename=\"".$filename."\"");
			//header("Content-Transfer-Encoding: binary");
			//header("Content-Length: ".filesize($path));
			header("X-Sendfile: $path");
			header("Content-type: application/octet-stream");
			header('Content-Disposition: attachment; filename="' . $filename . '"');
			exit;
			//return readfile($path);
			//return download($path, $filename);
			// return $filename;
		}
		else {
			abort(404);
		}
	} 
	catch(Exception $e) {
		\Log::error("Exception thrown on /run/download/$hash");
		\Log::error($e);
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
		\Log::error("Exception thrown on /run/status/$hash");
		\Log::error($e);
		abort(404);
	}
});

// The upload page for a run. If the run has a status of running, redirect to run page
Route::get('/rerun/{hash}', [function ($hash) {
	return view('rerun', ['hash'=>$hash]);
}]);

Route::post('/createRun', [
	'as' => 'create', 'uses' => 'RunController@postCreate'
]);
Route::post('/run/start/{hash}', [
	'as' => 'start', 'uses' => 'RunController@postStart'
]);
Route::post('/done-uploading/{hash}', [ 'uses' => 'RunController@postDoneUploading']);

Route::post('/configure-files/{hash}', [ 'uses' => 'RunController@postConfigureFiles']);

Route::post('/rerun/{hash}', [
	'as' => 'rerun', 'uses' => 'RunController@postRestart'
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
					$filename = basename($path);	

		if(!\Illuminate\Support\Facades\File::exists($path)) abort(404);
		$handler = new \Symfony\Component\HttpFoundation\File\File($path);

		$lifetime = 31556926; // One year in seconds

		/**
		* Prepare some header variables
		*/
		$file_time = $handler->getMTime(); // Get the last modified time for the file (Unix timestamp)

		$header_content_type = $handler->getMimeType();
		$header_content_length = $handler->getSize();
		$header_etag = md5($file_time . $path);
		$header_last_modified = gmdate('r', $file_time);
		$header_expires = gmdate('r', $file_time + $lifetime);

		$headers = array(
				'Content-Disposition' => 'inline; filename="' . $filename . '"',
				'Last-Modified' => $header_last_modified,
				'Cache-Control' => 'must-revalidate',
				'Expires' => $header_expires,
				'Pragma' => 'public',
				'Etag' => $header_etag
		);

		/**
		* Is the resource cached?
		*/
		$h1 = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $header_last_modified;
		$h2 = isset($_SERVER['HTTP_IF_NONE_MATCH']) && str_replace('"', '', stripslashes($_SERVER['HTTP_IF_NONE_MATCH'])) == $header_etag;

		if ($h1 || $h2) {
				return \Illuminate\Support\Facades\Response::make('', 304, $headers); // File (image) is cached by the browser, so we don't have to send it again
		}

		$headers = array_merge($headers, array(
				'Content-Type' => $header_content_type,
				'Content-Length' => $header_content_length
		));

		return \Illuminate\Support\Facades\Response::make(file_get_contents($path), 200, $headers);

	} 
	catch(ModelNotFoundException $e) {
		abort(404);
	}
	
});

Route::get('/check-kotrans', function () {
	$kotransRunning=false;
	$pidsToCheck = \File::glob(storage_path('.forever/*.pid'));
	foreach ($pidsToCheck as $pidFile) {
		$pid = \File::get($pidFile);
		$running = posix_getpgid($pid);
		if ($running) {
			$kotransRunning=true;
			// Allow to continue to remove any errant pid files
		}
		else { //Pid is not running and this file was left behind in an error
			\File::delete($pidFile);
		}
	}
	// Return based on status of kotrans
	if ($kotransRunning) { // KoTrans is probably running, 
		return "running";
	}
	else { // Kotrans is not running, attempt to restart
		$result = shell_exec(' '.base_path('setup/startKoTrans.sh')." 2>&1");
		return "restarted";
	}
});

/**************************************************************************
 *** Results requests
**************************************************************************/
/*** Enrichment / Depletion *********/
Route::get('/results/p-values/{hash}',           'ResultsController@getP_Values');
Route::get('/results/gene_rankings/{hash}',  'ResultsController@getGeneRankings');
Route::get('/results/gene_rankings_query/{hash}/{prefix}',  'ResultsController@getGeneRankingsQuery');
Route::get('/results/sgrna_rankings_query/{hash}/{prefix}',  'ResultsController@getSGRNARankingsQuery');
Route::get('/results/sgrna_rankings/{hash}',  'ResultsController@getSgrnaRankings');
Route::get('/results/sgrna_efficiency/{hash}',  'ResultsController@getSgrnaEfficiency');
Route::get('/results/control/{hash}',           'ResultsController@getControl');

/*** Statistics *********************/
Route::get('/results/readcount_statistics/{hash}',           'ResultsController@getReadCountStatistics');
Route::get('/results/alignment_statistics/{hash}',           'ResultsController@getAlignmentStatistics');
Route::get('/results/cutadapt/{hash}',        						   'ResultsController@getCutadapt');
Route::get('/results/sequence_quality/{hash}',        			 'ResultsController@getSequenceQuality');
Route::get('/results/sequencing_depth/{hash}',        			 'ResultsController@getSequencingDepth');

/*** Scatter Plots ******************/
Route::get('/results/readcount_scatterplots/{hash}',     'ResultsController@getReadCountScatterplots');
Route::get('/results/replicate_correlation/{hash}',     'ResultsController@getReplicateCorrelation');

/*** Heatmap ************************/
Route::get('/results/heatmap/{hash}',           'ResultsController@getHeatmap');

/*** Output *************************/
Route::get('/results/output_log/{hash}',        'ResultsController@getOutputLog');

Route::get('/results/candidate_lists/{hash}', 'ResultsController@getCandidateLists');
Route::get('/results/qc/{hash}', 'ResultsController@getQc');
Route::get('/results/readcount_scatterplots_gene_select/{hash}/{prefix}/{gene}/{showIds}/{nonT}', 'ResultsController@getNewScatterPlot');


// Bug reports
Route::get('/bug-report', function () {
	return view('bug_report');
}); 
// Bug reports
Route::post('/bug-report', function (\Illuminate\Http\Request $req) {
	$url = $req->input('url');
	$description = $req->input('description');
	$email = $req->input('email');
	\Illuminate\Support\Facades\Mail::to('pinapl-py@ucsd.edu')->queue(new \App\Mail\BugReport($description,$url, $email));
	$status = "Your bug report has been submitted. Thank you!";
	return view('bug_report',['status'=>$status]);
}); 




Route::get('/download_test', function ()
{
	return view('download_test');
});

Route::get('/no_space', function ()
{
	return view('no_space');
});

Route::get('/testList', function () {
	$result = shell_exec("export HOME=".storage_path('logs')."; forever --plain list 2>&1 ");
	echo  "<pre>$result</pre>";
});

foreach (get_class_methods('App\Http\Controllers\DownloadController') as $method) {
		Route::get("/download_test/$method", "DownloadController@$method");
}