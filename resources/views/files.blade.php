@php
	$title = "Define your samples";
	$description = "Please enter a name for the <b>condition</b> each file represents (e.g. ToxinA, TimePoint1, TimePoint2, etc.). <b><br>
	Replicates of the same condition need to have the same name.</b><br>
	Please check which files are control replicates.";
@endphp
@extends('layouts.master',["title"=>$title, "description"=>$description])
@section('before_title')
<div class="row collapse">
  <div class="columns small-12">
		<img src="/img/StatusBar_3.png">
	</div>
</div>
@stop
@section('content')
<form action="/configure-files/{{ $hash }}" method="POST">
<div class="row">
	<div class="column medium-5"><strong>Filename</strong></div>
	<div class="column medium-1"><strong title="Is this a control file?">Control</strong></div>
	<div class="column medium-5"><strong title="Rename the file to make it easier on yourself. Invalid characters will be replaced with underscores">Condition Name</strong></div>
</div>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
@foreach ($files as $file)
	<?php $file = basename($file); ?>
	<div class="row" id="{{ $file }}">
		<div class="column medium-5 file-name"><span title="{{ $file }}">{{ $file }}</span></div>
		<div class="column medium-1 text-center">
			<input type="checkbox" value="control" name="group-{{ $file }}" onclick="controlClick('{{ $file }}')">
		</div>
		<div class="column medium-5"><input type="text" name="rename-{{$file}}" placeholder="Condition Name"></div>
	</div>
@endforeach
<div class="row align-right">
	<div class="column shrink"><input type="submit" class="button success" value="Configure Run"></div>
</div>
</form>
@stop
@section('customCSS')
<style type="text/css">
	.file-name {
		overflow: hidden;
		text-overflow: ellipsis;
	}
</style>
@stop
@section('customScripts')
<script type="text/javascript">
	function controlClick(file) {
		checked = true;
		$('#rename-'+file).toggle(!checked)
	}
</script>
@stop