<?php
use Illuminate\Support\Facades\File;

// $filePrefixes = File::directories($run->directory()."/workingDir/Alignments");
// foreach ($filePrefixes as $key => $value) {
// 	$filePrefixes[$key] = basename($value);
// }
?>
<ul class="tabs" data-tabs id="result-sections-tabs">
	<li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Candidate Lists</a></li>
	<li class="tabs-title"><a href="#panel2">Control</a></li>
	<li class="tabs-title"><a href="#panel3">Heatmap</a></li>
	<li class="tabs-title"><a href="#panel4">QC</a></li>
	<li class="tabs-title"><a href="#panel5">Scatter Plots</a></li>
	<li class="tabs-title"><a href="#panel6">sgRNA Efficiency</a></li>
	<li class="tabs-title"><a href="#output-log-tab">Output Log</a></li>
</ul>
<div class="tabs-content" data-tabs-content="result-sections-tabs">
	<div class="tabs-panel is-active" id="panel1">
		 @foreach (File::allFiles($run->directory()."/workingDir/Analysis/Candidate_Lists") as $file)
			<label>{{ basename($file) }}</label>
			{!! svToHTML($file, "\t") !!}
		 @endforeach
	</div>
	<div class="tabs-panel" id="panel2">
			<img src='/run/{{ $run->id }}/images?path={{ urlencode("Analysis/Control/Control_MeanVariance.png") }}'>
	</div>
	<div class="tabs-panel" id="panel3">
		<object data="/run/{{ $run->id }}/images?path={{ urlencode("Analysis/Heatmap/Top100_variance_Heatmap.pdf") }}" type="application/pdf" width="100%" height="750">
			<iframe src="/run/{{ $run->id }}/images?path={{ urlencode("Analysis/Heatmap/Top100_variance_Heatmap.pdf") }}" width="100%" height="100%" style="border: none;">
			This browser does not support PDFs. Please download the PDF to view it: <a href="/run/{{ $run->id }}/images?path={{ urlencode("Analysis/Heatmap/Top100_variance_Heatmap.pdf") }}">Download PDF</a>
			</iframe>
		</object>
	</div>
	<div class="tabs-panel" id="panel4">
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
	</div>
	<div class="tabs-panel" id="panel5">
		@foreach (File::files($run->directory()."/workingDir/Analysis/ScatterPlots/") as $file)
			@php
				$file = str_replace($run->directory()."/workingDir/", '', $file);
			@endphp
			<label>{{ basename($file) }}</label>
			<img src='/run/{{ $run->id }}/images?path={{ urlencode($file) }}'>
		@endforeach
	</div>
	<div class="tabs-panel" id="panel6">
		@foreach (File::files($run->directory()."/workingDir/Analysis/sgRNA_Efficiency") as $file)
			@php
				$file = str_replace($run->directory()."/workingDir/", '', $file);
			@endphp
			<label>{{ basename($file) }}</label>
			<img src='/run/{{ $run->id }}/images?path={{ urlencode($file) }}'>
		@endforeach
	</div>
	<div class="tabs-panel" id="output-log-tab">
		<pre>{{  File::get($run->directory()."/workingDir/output.log") }}</pre>
	</div>
</div>
