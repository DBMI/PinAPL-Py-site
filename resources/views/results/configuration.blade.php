<?php
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Yaml\Yaml;

/*
$dir = storage_path("/runs/$hash/workingDir");
$data = Yaml::parseFile("$dir/Analysis/00_LogFile/configuration.yaml");
$line_number = $data["PrintHighlights"];
*/

$search      = "PrintHighlights";
$dir         = storage_path("/runs/$hash/workingDir");
$filePath = "$dir/configuration.yaml";
if (File::exists($filePath)){
	
	// Find cuttoff point to hide config output
	/*
	$lines       = file("$dir/configuration.yaml");
	$line_number = false;
	
	while (list($key, $line) = each($lines) and !$line_number) {
	   $line_number = (strpos($line, $search) !== FALSE) ? $key + 1 : $line_number;
	}
	*/

	$fileContents = File::get($filePath);
	$fileContents = explode(PHP_EOL, $fileContents);
	$line_number = count($fileContents); 
	$fileContents = array_slice($fileContents, 0, $line_number);
	$fileContents = implode(PHP_EOL, $fileContents);
}
?>
@if (File::exists($filePath))
	<div class="row align-center">
		<div class="column shrink">
			<pre>{{  $fileContents }}</pre>
		</div>
	</div>
@else
	An error has occored. No configuration file could be found
@endif
