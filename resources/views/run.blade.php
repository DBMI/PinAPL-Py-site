@extends('layouts.master')
@section('content')
	<div class="row align-justify">
		<div class="columns shrink"><h4>{{ $run->name }}</h4></div>
		@if ($run->status == "finished")
			<div class="columns shrink"><a id="download-archive" class="button success bold" href="/run/download/{{ $run->id }}">Download Results Archive</a></div>
		@endif
	</div>
	<div id="status-dependent">
		@if ($run->status == "finished")
				<div class="loader align-center"></div>
		@else
				<div class="columns shrink">Run Status {{ $run->status }}</div>
				Output log: 
				<pre>{{ Illuminate\Support\Facades\File::get($dir."/workingDir/output.log") }}</pre>
		@endif
	</div>
	

@stop
@section('customScripts')
@parent
	<script type="text/javascript" src="/js/run.js"></script>
	<script type="text/javascript">
		var runStatus = '{{ $run->status }}';
		var runId = '{{ $run->id }}';
	</script>
	<script type="text/javascript">
		if (runStatus == "finished") {
			$.get('/run/results/'+runId, function(data) {	
				$('#status-dependent').html(data);
				$(document).foundation();
			});
		}
	</script>
@stop
@section('customCSS')
	@parent
	<link rel="stylesheet" type="text/css" href="/css/run.css">
@stop