<?php
$sections = [
	"enrichment_depletion"  => "Enrichment/Depletion",
	"statistics"            => "Statistics",
	"scatter_plots"         => "Scatter Plots",
	"heatmap"               => "Heatmap",
	"output_log"            => "Output Log"
];
?>
@extends('layouts.master')
@section('content')
	<div class="row align-justify">
		<div class="columns shrink"><h4>{{ $runName }}</h4></div>
		<div class="columns shrink"><a id="download-archive" class="button success bold" href="/run/download/{{ $hash }}">Download Results Archive</a></div>
	</div>
	@include('layouts.results_section_tabs', ['sections' => $sections])
@stop


@section('customScripts')
<script type="text/javascript" src="/js/run.js"></script>
<script type="text/javascript">
	var runHash = '{{ $hash}}';
</script>
@parent
@stop
