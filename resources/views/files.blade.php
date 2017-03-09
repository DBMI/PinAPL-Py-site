@php
	$title = "Step 2: Define your samples";
	$description = "Indicate which of your files represent a <b>treatment</b> and which represent the <b>control</b>.<br>Give each <b>treatment</b> condition a <b>name</b>. Replicates of the same treatment condition need to have the same name!";
@endphp
@extends('layouts.master',["title"=>$title, "description"=>$description])
@section('content')
<div class="row">
	<div class="column medium-5"><strong>Filename</strong></div>
	<div class="column medium-2"><strong title="Select a group for each file">Sample Type</strong></div>
	<div class="column medium-5"><strong title="Rename the file to make it easier on yourself. Invalid characters will be replaced with underscores">Treatment Name</strong></div>
</div>
<form action="/configure-files/{{ $hash }}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
@foreach ($files as $file)
	<?php $file = basename($file); ?>
	<div class="row" id="{{ $file }}">
		<div class="column medium-5 file-name"><span title="{{ $file }}">{{ $file }}</span></div>
		<div class="column medium-2">
			<select name="group-{{$file}}" required>
				<option value="" hidden></option>
				<option value="control">Control</option>
				<option value="treatment">Treatment</option>
			</select>
		</div>
		<div class="column medium-5"><input type="text" name="rename-{{$file}}" placeholder="Treatment Name"></div>
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
	
</script>
@stop