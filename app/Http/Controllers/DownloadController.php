<?php

namespace App\Http\Controllers;


class DownloadController
{
protected $filepath = "/var/www/pinapl-py/storage/runs/example-run/archive.zip";
protected $filename = "PinAPL-py_example_run.zip";

public function xsendfile()
{
	header("X-Sendfile: $this->filepath");
	header("Content-type: application/octet-stream");
	header('Content-Disposition: attachment; filename="' . $this->filename . '"');
	exit;
}
public function laravel_default()
{
	return response()->download($this->filepath, $this->filename);
}
public function x_zip_header()
{
	header("X-Sendfile: $this->filepath");
	header("Content-type: application/zip");
	header('Content-Disposition: attachment; filename="' . $this->filename . '"');
	exit;
}
public function laravel_zip_header()
{
	$headers = array(
	             'Content-Type: application/zip',
	           );

	return response()->download($this->filepath, $this->filename, $headers);
}
public function whywhywhy (){
	return "fc=";
}
}