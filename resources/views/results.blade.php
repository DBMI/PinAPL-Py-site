<?php
$sections = [
	"enrichment_depletion"  => "Enrichment/Depletion",
	"statistics"            => "Statistics",
	"scatter_plots"         => "Scatter Plots",
	"heatmap"               => "Heatmap",
	"run_info"            	=> "Run Info"
];
?>
@extends('layouts.master')
@section('content')
	<div class="row align-justify collapse">
		<div class="columns shrink"><h4>{{ $runName }}</h4></div>
		<div class="columns shrink"><a id="download-archive" class="button success bold" href="/run/download/{{ $hash }}" download>Download Results Archive</a></div>
	</div>
	<div class="row collapse">
		<div class="column" id="results-tabs-holder">
			@include('layouts.results_section_tabs', ['sections' => $sections, "selfName"=>"results"])
		</div>
	</div>
@stop


@section('customScripts')
<script type="text/javascript" src="/js/run.js"></script>
<script type="text/javascript">
	var runHash = '{{ $hash}}';
</script>
@parent
@stop

@section('customCSS')
	@parent
	<link rel="stylesheet" type="text/css" href="/css/results.css">
@stop
