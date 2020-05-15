@extends('layouts.master')
@section('content')
<img src="/img/StatusBar_1.png">
<div class="row align-middle">
	<div class="medium-3 align-center columns">
		<img id="welcome-logo" src="/img/logo_with_name.png">
	</div>
	<div class="medium-9 columns" id="welcome-text">
		<div class="row">
			<h4><b>P</b>latform-<b>in</b>dependent <b>A</b>nalysis of <b>P</b>oo<b>L</b>ed screens using <b>Py</b>thon</h4>
			<b>A comprehensive web application for quality control, read alignment and enrichment/depletion analysis of CRISPR/Cas9 screens.</b>
		</div>
		<div class="row">
			Please enter a name for your run below.<br>
			Please enter an email address if you would like to receive a notification email after completion (optional).
		</div>
		<div class="row collapse">
			<div class="small-12 columns">
				<div class="callout">
					<form action="/createRun" method="post" class="custom" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="row">
							<div class="medium-6 columns">
								<label for="name"><span class="has-tip tip-top whiteTxt" title="Please give this data a name">Name this Run</span></label>
								<input id="name" name="name" type="text"/>
							</div>
							<div class="medium-6 columns">
								<label for="email"><span class="has-tip tip-top whiteTxt" title="The e-mail address we should send your results to">E-mail Address (optional)</span></label>
								<input id="email" name="email" type="text"/>
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

<br>

<div class="row align-middle">
	<div class="medium-12 align-center columns">
	<p><b><span style="color:red">*** NEW VERSION (2/2020) ***<br>
		Check the Documentation for description of the new features</span></b></p>
	</div>
</div>

<footer>
	<div class="row footer align-center">
		<div class=" columns">
			If you like this site, please acknowledge PinAPL-Py in your publication: <br>
			Spahn PN, Bath T, Weiss RJ, Kim J, Esko JD, Lewis NE, Harismendy O : <b>PinAPL-Py: A comprehensive web-application for the analysis of CRISPR/Cas9 screens.</b>&nbsp; Sci Rep. 2017 Nov 20;7(1):15854. &nbsp;<a href="https://www.nature.com/articles/s41598-017-16193-9"> doi: 10.1038/s41598-017-16193-9.</a>
		</div>
	</div>
</footer>
@stop
@section('customCSS')
	<style type="text/css">
		#welcome-text{
			min-height: 340px;
			justify-content: space-between;
	    flex-direction: column;
	    display: flex;
	    padding-top: 1em;
	    padding-bottom: 1em;
		}
		#welcome-logo{
			height: 340px;
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
		.footer {
			/*position: absolute;
			  right: 0;
			  bottom: 0;
			  left: 0;
			  padding: 1rem;
			  background-color: #efefef;
			  text-align: center;*/
			margin-top: 2em;
		}
	</style>
@stop
