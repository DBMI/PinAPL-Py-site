<?php 
use Illuminate\Support\Facades\File;
?>
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
			@include('results')
		@elseif($run->status == "queued")
			<div class="row align-center">
				<div class="column shrink">
					<h2>In Queue - {{ \App\Run::where("status", "queued")->count() }} runs ahead of you. </h2>
					<p>There are other runs ahead of you, your run is qurrently in queue. Please be patient. You will recieve an email when it has completed.</p>
				</div>
			</div>
		@else
				<div class="columns shrink">Run Status {{ $run->status }}</div>
				Output log: 
				@if (File::exists($dir."/workingDir/output.log"))
					<pre>{{ File::get($dir."/workingDir/output.log") }}</pre>
				@else 
					An error has occured
				@endif
		@endif
	</div>
	

@stop
@section('customCSS')
	@parent
	<link rel="stylesheet" type="text/css" href="/css/run.css">
@stop