@php
	$title = "Platform-independent Analysis of PooLed Screens using Python";
	$description = "A comprehensive web application for quality control, read alignment and enrichment/depletion analysis of CRISPR/Cas9 screens.<br>
	Please enter a valid e-mail address and a name for your analysis run below";
@endphp
@extends('layouts.master',["title"=>$title, "description"=>$description])
@section('content')
<div class="callout">
	<form action="/createRun" method="post" class="custom" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row">
			<div class="medium-6 columns">
				<label for="email"><span class="has-tip tip-top whiteTxt" title="The e-mail address we should send your results to">E-mail Address</span></label>
				<input id="email" name="email" type="text" required />
			</div>
			<div class="medium-6 columns">
				<label for="name"><span class="has-tip tip-top whiteTxt" title="Please give this data a name">Analysis Run Name</span></label>
				<input id="name" name="name" type="text" required />
			</div>
		</div>

		<div class="row align-right">
			<div class="shrink columns">
				<input type="submit" id="runSubmitButton" class="medium success button expand"/>
			</div>
		</div>
	</form>
</div>

<div class="row footer align-center">
	<div class="shrink columns">
		<p>&copy 2017 <a href="http://dbmi.ucsd.edu/" target="_blank">DBMI @ UCSD</a></p>
	</div>
</div>
@stop