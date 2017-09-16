@php
	$title = "Configure your analysis run";
	$description = "Please choose your <b>screen type</b> and the <b>library</b> used in your screen.<br>
	If you wish to edit the default parameter settings, click <b>“Advanced Options”</b>";
@endphp
@extends('layouts.master',["title"=>$title, "description"=>$description])
@section('before_title')
<div class="row collapse">
  <div class="columns small-12">
		<img src="/img/StatusBar_4.png">
	</div>
</div>
@stop
@section('content')
<form action="/run/start/{{$hash}}" method="post" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<fieldset>
	<legend>Project Parameters</legend>
	<div class="row align-bottom medium-unstack">
	@foreach (config('pinapl_config.parameter_groups.Required') as $paramName => $parameter)
		@include('layouts.input',["name" => $paramName, "parameter"=>$parameter, "required"=>true])
	@endforeach
	</div>
</fieldset>
<fieldset id="custom-library-fields" style="display: none;" disabled="true">
	<legend>Custom Library Parameters</legend>
	<div class="row">
		<div class="column medium-3">
			<label for="custom-lib-file">Custom Library File</label>
			<input type="file" id="custom-lib-file" name="custom-lib-file" required="true" accept=".csv, .tsv">
		</div>
		@foreach (config('pinapl_config.parameter_groups.Library Parameters') as $paramName => $parameter)
			@include('layouts.input',["name" => $paramName, "parameter"=>$parameter, "required"=>true])
		@endforeach
	</div>
</fieldset>
<div class="row">
	<div class="columns">
		<ul class="accordion" data-accordion data-allow-all-closed="true">
			<li class="accordion-item" data-accordion-item>
				<a class="accordion-title" href="#">Advanced Options</a>
				<div id="advanced-options-panel" class="accordion-content" data-tab-content>
					@include('advanced_options')
				</div>
			</li>
		</ul>
	</div>
</div>
<div class="row align-right">
	<div class="column shrink">
		<input type="submit" value="Start Run" class="button success">
	</div>
</div>
</form>
@stop
@section('customCSS')

@stop
@section('customScripts')
<script type="text/javascript">
$("#LibFilename-input").change(function function_name(argument) {
	if (this.value == "custom") {
		$("#custom-library-fields").attr('disabled',false)
		$("#custom-library-fields").slideDown();
	}
	else {
		$("#custom-library-fields").slideUp();
		$("#custom-library-fields").attr('disabled',true)
	}
});
$('#sgRNALength-input').change(function(){
   $('#AS_min-input').val(this.value * 2);
});
</script>
@stop