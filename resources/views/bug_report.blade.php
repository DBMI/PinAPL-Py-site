@extends('layouts.master')
@section('content')
	@if (!empty($status))
	<div class="callout success">
		{{ $status }}
	</div>
	@endif
	<h1>Report a Bug</h1>
	<p>Please describe your bug here, in as much detail as possible, then press submit. All reports are anonymous.</p>
	<form action="/bug-report" method="post">
		{!! csrf_field() !!}
		<label>Url of the page where the error occurred</label>
		<input type="text" name="url">
		<label>Description of the error</label>
		<textarea name="description" id="" cols="30" rows="10"></textarea>
		<input type="submit" class="button" name="Submit">
	</form>
@endsection