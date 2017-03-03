<?php
$file = \File::glob(storage_path("runs/$runHash/workingDir/Analysis/Control/*.png"));
$file = array_pop($file);
?>
<img src='{{"/run-images?path=".urlencode("/$runHash/workingDir/Analysis/Control/".basename($file))}}'>