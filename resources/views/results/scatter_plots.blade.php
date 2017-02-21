<?php
use Illuminate\Support\Facades\File;

// $filePrefixes = File::directories($run->directory()."/workingDir/Alignments");
// foreach ($filePrefixes as $key => $value) {
// 	$filePrefixes[$key] = basename($value);
// }
?>
@foreach (File::files($run->directory()."/workingDir/Analysis/ScatterPlots/") as $file)
	@php
		$file = str_replace($run->directory()."/workingDir/", '', $file);
	@endphp
	<label>{{ basename($file) }}</label>
	<img src='/run/{{ $run->id }}/images?path={{ urlencode($file) }}'>
@endforeach