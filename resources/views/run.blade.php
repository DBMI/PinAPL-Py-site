@extends('layouts.master')
@section('content')
	This is the run page for run: {{ $run->name }}
	<br>
	<div class="row align-justify">
		<div class="columns shrink">Run Status {{ $run->status }}</div>
		@if ($run->status=="finished")
			<div class="columns shrink"><a id="download-archive" class="button" download="PinAPL-py_Archive.tgz" href="/run/download/{{ $run->id }}">Download Results Archive</a></div>
		@endif
	</div>
	<br>
	Output log: 
	<pre>
		{{ Illuminate\Support\Facades\File::get($dir."/workingDir/output.log") }}
	</pre>

@stop