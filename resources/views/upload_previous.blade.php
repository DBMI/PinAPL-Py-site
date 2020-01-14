@php
	$title = "Upload a previous run";
	$description = "You can use this page to upload the results archive of a previous run. This will allow you to view it using the websites interface, as well as using it's functionality dig into the results a little deeper."
@endphp
@extends('layouts.master',["title"=>$title, "description"=>$description])


@section('content')
	<form action="upload-previous" method="POST" enctype="multipart/form-data">
		<div class="row">
			<div class="column medium-6">
				<label for="run-name">Run Name</label>
				<input type="text" name="name" required="true">
			</div>
			<div class="column medium-6">
				<label for="email">Email</label>
				<input type="text" name="email">
			</div>
		</div>
		<div class="row">
			<div class="column medium-6">		
				<label for="archive">Upload archive file</label>
				<input type="file" name="archive" required="true">
			</div>
			<div class="columns">
				<input style="float: right" class="medium success button expand" type="submit">
			</div>
		</div>
	</form>
@stop