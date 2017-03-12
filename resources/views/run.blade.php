<?php 
use Illuminate\Support\Facades\File;
?>
@extends('layouts.master')
@section('content')
	<div class="row align-justify">
		<div class="columns shrink"><h4>{{ $run->name }}</h4></div>
	</div>
	<div id="status-dependent">
			<span><b>Please refresh this page periodically to follow the program's progress!</b></span>
			@if($run->status == "queued")
				<?php $queueCount = \App\Run::where("status", "queued")->where('id','<=',$run->id)->count(); ?>
				<div class="row align-center">
					<div class="column shrink">
						<h2>In Queue - {{$queueCount}} run{{($queueCount>1)? 's':''}} ahead of you. </h2>
						<p>There are other runs ahead of you, your run is qurrently in queue. Please be patient. You will recieve an email when it has completed.</p>
					</div>
				</div>
			@else
				<div class="columns shrink">Run Status {{ $run->status }}</div>
				Output log: 
				@if (File::exists($run->directory()."/workingDir/output.log"))
					<pre>{{ File::get($run->directory()."/workingDir/output.log") }}</pre>
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