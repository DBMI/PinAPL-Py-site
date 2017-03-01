<?php
use Illuminate\Support\Facades\File;

// $filePrefixes = File::directories($run->directory()."/workingDir/Alignments");
// foreach ($filePrefixes as $key => $value) {
// 	$filePrefixes[$key] = basename($value);
// }
?>
@foreach (File::allFiles(storage_path("runs/$runHash/workingDir/Analysis/QC")) as $file)
	<?php 
		$ext = pathinfo($file, PATHINFO_EXTENSION);
		$file = str_replace(storage_path("runs"), '', $file);
	 ?>
	@if ($ext == "png")
		<img src='/run-images?path={{ urlencode("/$file") }}'>
	@endif
@endforeach