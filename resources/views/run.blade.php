@extends('layouts.master')
@section('content')
	This is the run page for run: {{ $run->name }}
	<br>
	Run Status {{ $run->status }}
	<br>
	Output log: 
	<pre>
		{{ Illuminate\Support\Facades\File::get($dir."/workingDir/output.log") }}
	</pre>

@stop