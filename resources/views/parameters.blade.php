@extends('layouts.master')

@section('content')
<form action="/run/start/{{$run->id}}" method="post" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<fieldset>
	<legend>Project Parameters</legend>
	<div class="row align-bottom medium-unstack">
		<div class="column">
			<label> Screen Type
				<select name="ScreenType" title="Type of screen" required>
					<option value=""></option>
					<option value="enrichment">Enrichment</option>
					<option value="depletion">Depletion</option>
				</select>
			</label>
		</div>
		<div class="column">
			<label for="custom-library" >Upload Custom Library File</label>
			<input name="libFile" type="file" id="custom-library" required>
		</div>
		<div class="column">
			<label> Sequence 5'
				<input name="seq_5_end" placeholder="TCTTGTGGAAAGGACGAAACACCG" value="TCTTGTGGAAAGGACGAAACACCG" title="Sequence 5' of sgRNA in read" type="text">
			</label>
		</div>
		<div class="column">
			<label> Sequence 3'
				<input name="seq_3_end" placeholder="GTTTTAGAGCTAGAAATAGCAAGTT" value="GTTTTAGAGCTAGAAATAGCAAGTT" title="Sequence 3' of sgRNA in read" type="text">
			</label>
		</div>

		<div class="column">
			<label> Non-Target Prefix
				<input name="NonTargetPrefix" placeholder="NonTargeting" title="Prefix for non-targeting sgRNAs in library (keep at default if none present)" type="text">
			</label>
		</div>
		<div class="column">
			<label> sgRNAs per Gene
				<input name="sgRNAsPerGene" value="6" title="Number of sgRNAs targeting each gene (not taking non-targeting / microRNAs into account" type="number">
			</label>
		</div>
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
		<input type="submit" value="Submit" class="button">
	</div>
</div>
</form>
@stop
@section('customCSS')

@stop
@section('customScripts')
@stop