<?php 
use Illuminate\Support\Facades\File;
?>
@extends('layouts.master')
@section('content')
	<div id="status-dependent">
			@if($run->status == "queued")
				<?php $queueCount = \App\Run::where("status", "queued")->where('id','<=',$run->id)->count(); ?>
				<div class="row align-center">
					<div class="column shrink">
						<h2>In Queue - {{$queueCount}} run{{($queueCount>1)? 's':''}} ahead of you. </h2>
						<p>There are other runs ahead of you, your run is currently in queue. Please be patient. You will receive an email when it has completed.</p>
					</div>
				</div>
			@else
				<div class="row align-justify">
					<div class="columns shrink"><h2><img src="/img/logo.png" style="height: 2em;">Your Run "{{ $run->name }}" is in progress...</h2></div>
				</div>
				<span>Refresh this page periodically to follow the program execution</span><br>
				<span>If you did not provide an email address <b><i>please keep this page open!</i></b></span>
				@if (File::exists($run->directory()."/workingDir/output.log"))
					<pre>{{ File::get($run->directory()."/workingDir/output.log") }}</pre>
				@else 
					An error has occurred
				@endif
			@endif
	</div>
	

@stop