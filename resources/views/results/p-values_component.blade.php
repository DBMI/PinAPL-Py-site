<?php
$files = \File::glob(storage_path("runs/$runHash/workingDir/Analysis/p-values/$prefix/*.png"));
?>
@foreach ($files as $file)
<img src='{{"/run-images?path=".urlencode("/$runHash/workingDir/Analysis/p-values/$prefix/".basename($file))}}'>
@endforeach