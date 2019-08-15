<?php
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
$filePath = storage_path("/runs/$hash/workingDir/Analysis/00_LogFile/configuration.yaml");
$fileContents = File::get($filePath);
$fileContents = explode(PHP_EOL, $fileContents);
$fileContents = array_slice($fileContents, 0, 54);
$fileContents = implode(PHP_EOL, $fileContents);
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
