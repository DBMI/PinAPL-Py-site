<?php
use Illuminate\Support\Facades\File;

// $filePrefixes = File::directories($run->directory()."/workingDir/Alignments");
// foreach ($filePrefixes as $key => $value) {
// 	$filePrefixes[$key] = basename($value);
// }
?>
@foreach (File::allFiles($run->directory()."/workingDir/Analysis/QC") as $file)
	<?php 
		$ext = pathinfo($file, PATHINFO_EXTENSION);
		$file = str_replace($run->directory()."/workingDir/", '', $file);
	 ?>
	@if ($ext == "png")
		<label>{{ basename($file) }}</label>
		<img src='/run/{{ $run->id }}/images?path={{ urlencode($file) }}'>
	@endif
@endforeach