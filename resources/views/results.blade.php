<?php
$sections = [
	"enrichment_depletion"  => "Enrichment/Depletion",
	"statistics"            => "Statistics",
	"scatter_plots"         => "Scatter Plots",
	"heatmap"               => "Heatmap",
	"output_log"            => "Output Log"
];
?>
@extends('layouts.results_section_tabs', ['sections' => $sections])


@section('customScripts')
<script type="text/javascript" src="/js/run.js"></script>
<script type="text/javascript">
	var runHash = '{{ $hash}}';
</script>
@parent
@stop
