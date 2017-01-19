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
$app->get('/test/{id}', function ($id)  {
    return view('test',['name'=>'test name', 'id'=>$id]);
});
$app->get('/upload/{id}', ['as'=>'upload', function ($id) {
    $run = \App\Run::findOrFail($id);
    return view('upload', ['id'=>$run->id, 'dir'=>$run->directory()]);
}]);

$app->get('/foundation', function () use ($app) {
    // return $app->version();
    return $app->make('view')->make('foundation');
});

$app->post('/createRun', [
    'as' => 'create', 'uses' => 'RunController@postCreateRun'
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

