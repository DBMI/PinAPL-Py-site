<?php
$sections = [
	"candidate_lists"  => "Candidate Lists",
	"control"          => "Control",
	"heatmap"          => "Heatmap",
	"qc"               => "QC",
	"scatter_plots"    => "Scatter Plots",
	"sgrna_efficiency" => "sgRNA Efficiency",
	"output_log"       => "Output Log"
];
$defaultSelectedTab = reset($sections);
?>
<ul class="tabs" data-tabs id="result-sections-tabs">
	@foreach ($sections as $key=>$value)
		@if ($value === $defaultSelectedTab)
			<li class="tabs-title is-active"><a href="#{{ $key }}_tab" aria-selected="true">{{ $value }}</a></li>
		@else
			<li class="tabs-title"><a href="#{{ $key }}_tab">{{ $value }}</a></li>
		@endif
	@endforeach
</ul>
<div class="tabs-content" data-tabs-content="result-sections-tabs">
	@foreach ($sections as $key=>$value)
		@if ($value === $defaultSelectedTab)
		<div class="tabs-panel is-active" id="{{ $key }}_tab">
			<div class="loader align-center"></div>
		</div>
		@else
		<div class="tabs-panel" id="{{ $key }}_tab">
			<div class="loader align-center"></div>
		</div>
		@endif

	@endforeach
</div>


@section('customScripts')
@parent
	<script type="text/javascript" src="/js/run.js"></script>
	<script type="text/javascript">
		var runStatus = '{{ $run->status }}';
		var runId = '{{ $run->id }}';
	</script>
	<script type="text/javascript">
	@if( $run->status == "finished")
		@foreach ($sections as $key=>$value)
				$.get('/results/{{ $key }}/'+runId, function(data) {	
					$('#{{ $key }}_tab').html(data);
					$(document).foundation();
				});
		@endforeach
	@endif
	</script>
@stop
