<?php
$files = \File::glob(storage_path("runs/$runHash/workingDir/Analysis/Alignment_Statistics/$prefix/*.png"));
?>
@foreach ($files as $file)
	<img src='{{ "/run-images?path=".urlencode("/$runHash/workingDir/Analysis/Alignment_Statistics/$prefix/".basename($file)) }}'>
@endforeach