<?php

namespace App\Http\Controllers;

class ExampleController extends Controller
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
    public function postCreateRun()
    {
        # code...
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
    //
}
