<?php
use Illuminate\Support\Facades\File;

// $filePrefixes = File::directories($run->directory()."/workingDir/Alignments");
// foreach ($filePrefixes as $key => $value) {
// 	$filePrefixes[$key] = basename($value);
// }
?>
<img src='/run/{{ $run->id }}/images?path={{ urlencode("Analysis/Control/Control_MeanVariance.png") }}'>