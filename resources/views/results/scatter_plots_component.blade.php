<?php
$file = \File::glob(storage_path("runs/$runHash/workingDir/Analysis/ReadCount_Scatterplots/$prefix*.png"));
$file = array_pop($file);
$link = "/run-images?path=".urlencode("/$runHash/workingDir/Analysis/ReadCount_Scatterplots/".basename($file));
?>
<img src='{{ $link }}'>