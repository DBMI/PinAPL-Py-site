@extends('layouts.master')
@section('content')
	<form action="/rerun/{{ $hash }}" method="post" class="custom" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<label> Name
			<input type="text" name="name">
		</label>
		<input type="submit" class="medium success button expand"/>
	</form>
@stop