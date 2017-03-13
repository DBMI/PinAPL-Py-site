<?php
use Illuminate\Support\Facades\File;
$filePath = storage_path("/runs/$hash/workingDir/configuration.yaml");
?>
@if (File::exists($filePath))
	<pre>{{  File::get($filePath) }}</pre>
@else
	An error has occored. No configuration file could be found
@endif
