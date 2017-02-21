<?php
use Illuminate\Support\Facades\File;

// $filePrefixes = File::directories($run->directory()."/workingDir/Alignments");
// foreach ($filePrefixes as $key => $value) {
// 	$filePrefixes[$key] = basename($value);
// }
?>
<object data="/run/{{ $run->id }}/images?path={{ urlencode("Analysis/Heatmap/Top100_variance_Heatmap.pdf") }}" type="application/pdf" width="100%" height="750">
	<iframe src="/run/{{ $run->id }}/images?path={{ urlencode("Analysis/Heatmap/Top100_variance_Heatmap.pdf") }}" width="100%" height="100%" style="border: none;">
	This browser does not support PDFs. Please download the PDF to view it: <a href="/run/{{ $run->id }}/images?path={{ urlencode("Analysis/Heatmap/Top100_variance_Heatmap.pdf") }}">Download PDF</a>
	</iframe>
</object>