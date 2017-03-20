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
public function readfileDefault()
{
	$file = "/var/www/pinapl-py/storage/runs/example-run/archive.zip";
	if (file_exists($file)) {
	    header('Content-Description: File Transfer');
	    header('Content-Type: application/octet-stream');
	    header('Content-Disposition: attachment; filename="'.basename($file).'"');
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize($file));
	    readfile($file);
	    exit;
	}
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

function send_download_package_file()
{
  $realpath = $this->filepath;
  if (file_exists($realpath)) {
    // Fetching File
    $mtime = ($mtime = filemtime($realpath)) ? $mtime : gmtime();
    $size = intval(sprintf("%u", filesize($realpath)));
    header("Content-type: application/force-download");
    header('Content-Type: application/octet-stream');
    if (strstr($_SERVER["HTTP_USER_AGENT"], "MSIE") != false) {
      header("Content-Disposition: attachment; filename=" . urlencode($this->filename) . '; modification-date="' . date('r', $mtime) . '";');
    } else {
      header("Content-Disposition: attachment; filename=\"" . $this->filename . '"; modification-date="' . date('r', $mtime) . '";');
    }
    if (in_array('mod_xsendfile', apache_get_modules())) {
      // Sending file via mod_xsendfile
      header("X-Sendfile: " . $this->filepath);
    } else {
      // Sending file directly via script
      if (intval($size + 1) > return_bytes(ini_get('memory_limit')) && intval($size * 1.5) <= 1073741824) { //Not higher than 1GB
        // Setting memory limit
        ini_set('memory_limit', intval($size * 1.5));
      }
      @apache_setenv('no-gzip', 1);
      @ini_set('zlib.output_compression', 0);
      header("Content-Length: " . $size);
      // Set the time limit based on an average D/L speed of 50kb/sec
      set_time_limit(min(7200, // No more than 120 minutes (this is really bad, but...)
      ($size > 0) ? intval($size / 51200) + 60 // 1 minute more than what it should take to D/L at 50kb/sec
       : 1 // Minimum of 1 second in case size is found to be 0
      ));
      $chunksize = 1 * (1024 * 1024); // how many megabytes to read at a time
      if ($size > $chunksize) {
        // Chunking file for download
        $handle = fopen($realpath, 'rb');
        $buffer = '';
        while (!feof($handle)) {
          $buffer = fread($handle, $chunksize);
          echo $buffer;
          ob_flush();
          flush();
        }
        fclose($handle);
      } else {
        // Streaming whole file for download
        readfile($realpath);
      }
    }
  } else {
  	return "File not Found";
  }
  return "Last error";
}
function send_download_package_file_noXsend()
{
  $realpath = $this->filepath;
  if (file_exists($realpath)) {
    // Fetching File
    $mtime = ($mtime = filemtime($realpath)) ? $mtime : gmtime();
    $size = intval(sprintf("%u", filesize($realpath)));
    header("Content-type: application/force-download");
    header('Content-Type: application/octet-stream');
    if (strstr($_SERVER["HTTP_USER_AGENT"], "MSIE") != false) {
      header("Content-Disposition: attachment; filename=" . urlencode($this->filename) . '; modification-date="' . date('r', $mtime) . '";');
    } else {
      header("Content-Disposition: attachment; filename=\"" . $this->filename . '"; modification-date="' . date('r', $mtime) . '";');
    }
    // Sending file directly via script
    if (intval($size + 1) > return_bytes(ini_get('memory_limit')) && intval($size * 1.5) <= 1073741824) { //Not higher than 1GB
      // Setting memory limit
      ini_set('memory_limit', intval($size * 1.5));
    }
    @apache_setenv('no-gzip', 1);
    @ini_set('zlib.output_compression', 0);
    header("Content-Length: " . $size);
    // Set the time limit based on an average D/L speed of 50kb/sec
    set_time_limit(min(7200, // No more than 120 minutes (this is really bad, but...)
    ($size > 0) ? intval($size / 51200) + 60 // 1 minute more than what it should take to D/L at 50kb/sec
     : 1 // Minimum of 1 second in case size is found to be 0
    ));
    $chunksize = 1 * (1024 * 1024); // how many megabytes to read at a time
    if ($size > $chunksize) {
      // Chunking file for download
      $handle = fopen($realpath, 'rb');
      $buffer = '';
      while (!feof($handle)) {
        $buffer = fread($handle, $chunksize);
        echo $buffer;
        ob_flush();
        flush();
      }
      fclose($handle);
    } else {
      // Streaming whole file for download
      readfile($realpath);
    }
  } else {
  	return "File not Found";
  }
  return "Last error";
}

public function readfile_chunked_array () { 
	$filename = $this->filename;
	$filepath = $this->filepath;
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($filepath));
  $chunk_array=array(); 
  $chunksize = 1*(1024*1024); // how many bytes per chunk 
  $buffer = ''; 
  $handle = fopen($filepath, 'rb'); 
  if ($handle === false) { 
   return "false"; 
  } 
  while (!feof($handle)) { 
    $lines[] = fgets($handle, $chunksize); 
  } 
   fclose($handle); 
   return $lines; 
} 
public function readfile_chunked_string () { 
	$filename = $this->filename;
	$filepath = $this->filepath;
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($filepath));
  $chunk_array=array(); 
  $chunksize = 1*(1024*1024); // how many bytes per chunk 
  $buffer = ''; 
  $handle = fopen($filepath, 'rb'); 
  if ($handle === false) { 
   return "false"; 
  } 
  while (!feof($handle)) { 
    $lines = fread($handle, $chunksize); 
  } 
   fclose($handle); 
   return $lines; 
} 

function obclean_flush_readfile() { // $file = include path 
	$file = $this->filepath;
  if(file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;
  }

}
function readfile_chunked_retbytes() {
		$filename = $this->filepath;
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.basename($filename).'"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filename));
		$retbytes=true;
    $chunksize = 1*(1024*1024); // how many bytes per chunk
    $buffer = '';
    $cnt =0;
    // $handle = fopen($filename, 'rb');
    $handle = fopen($filename, 'rb');
    if ($handle === false) {
        return false;
    }
    while (!feof($handle)) {
        $buffer = fread($handle, $chunksize);
        echo $buffer;
        if ($retbytes) {
            $cnt += strlen($buffer);
        }
    }
        $status = fclose($handle);
    if ($retbytes && $status) {
        return $cnt; // return num. bytes delivered like readfile() does.
    } 
    return $status;
}
function readfile_chunked_no_retbytes() {
		$filename = $this->filepath;
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.basename($filename).'"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filename));
		$retbytes=false;
    $chunksize = 1*(1024*1024); // how many bytes per chunk
    $buffer = '';
    $cnt =0;
    // $handle = fopen($filename, 'rb');
    $handle = fopen($filename, 'rb');
    if ($handle === false) {
        return false;
    }
    while (!feof($handle)) {
        $buffer = fread($handle, $chunksize);
        echo $buffer;
        if ($retbytes) {
            $cnt += strlen($buffer);
        }
    }
        $status = fclose($handle);
    if ($retbytes && $status) {
        return $cnt; // return num. bytes delivered like readfile() does.
    } 
    return $status;
}



}
