@extends('layouts.master')
@section('content')
<div class="row align-middle">
	<div class="medium-3 align-center columns">
		<img id="welcome-logo" src="/img/logo_color.png">
	</div>
	<div class="medium-9 columns" id="welcome-text">
		<div class="row">
			<h4>Platform-independent Analysis of PooLed screens using Python</h4>
			<b>A comprehensive web application for quality control, read alignment and enrichment/depletion analysis of CRISPR/Cas9 screens.</b>
		</div>
		<div class="row">
			Please enter a valid e-mail address and a name for your analysis run below
		</div>
		<div class="row collapse">
			<div class="small-12 columns">
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
								<input id="name" name="name" type="text"/>
							</div>
						</div>

						<div class="row align-right">
							<div class="shrink columns">
								<input type="submit" id="runSubmitButton" class="medium success button expand"/>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<img id="how-to-img" src="/img/howTo.png" >

<div class="row footer align-center">
	<div class="shrink columns">
		<p>&copy 2017 <a href="http://dbmi.ucsd.edu/" target="_blank">DBMI @ UCSD</a></p>
	</div>
</div>
@stop
@section('customCSS')
	<style type="text/css">
		#welcome-text{
			height: 326px;
			justify-content: space-between;
	    flex-direction: column;
	    display: flex;
	    padding-top: 1em;
	    padding-bottom: 1em;
		}
		#how-to-img {
			margin-left: 2em;
		}
		.row {
			max-width: 82.5rem;
		}
		.callout input[type='submit'] {
			margin-bottom: 0;
		}
		.callout {
			margin-bottom: 0;
		}
	</style>
@stop