<?php
use Illuminate\Support\Facades\File;

// $filePrefixes = File::directories($run->directory()."/workingDir/Alignments");
// foreach ($filePrefixes as $key => $value) {
// 	$filePrefixes[$key] = basename($value);
// }
?>
<pre>{{  File::get(storage_path("/runs/$hash/workingDir/output.log")) }}</pre>