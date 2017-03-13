<?php
use Illuminate\Support\Facades\File;
$filePath = storage_path("/runs/$hash/workingDir/output.log");
?>
@if (File::exists($filePath))
	<pre>{{  File::get($filePath) }}</pre>
@else
	An error has occored. No output log could be found
@endif
