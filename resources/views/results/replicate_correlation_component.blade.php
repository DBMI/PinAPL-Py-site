<?php
$files = \File::glob(storage_path("runs/$runHash/workingDir/Analysis/Replicate_Correlation/*.png"));
?>
@foreach ($files as $file)
<img src='{{"/run-images?path=".urlencode("/$runHash/workingDir/Analysis/Replicate_Correlation/".basename($file))}}'>
@endforeach