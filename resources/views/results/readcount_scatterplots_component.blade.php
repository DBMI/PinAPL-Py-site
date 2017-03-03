<?php
$files = \File::glob(storage_path("runs/$runHash/workingDir/Analysis/ReadCount_Scatterplots/$prefix*.png"));
?>
@foreach ($files as $file)
<img src='{{"/run-images?path=".urlencode("/$runHash/workingDir/Analysis/ReadCount_Scatterplots/".basename($file))}}'>
@endforeach