@extends('layouts.master')
@section('content')
<div class="row align-middle" style="margin-top: 10em">
	<div class="medium-3 align-center columns">
		<img id="welcome-logo" src="/img/logo_color.png">
	</div>
	<div class="medium-9 columns">
		<div class="row">
			<h4>Platform-independent Analysis of PooLed screens using Python</h4>
			<b>A comprehensive web application for quality control, read alignment and enrichment/depletion analysis of CRISPR/Cas9 screens.</b>
		</div>
		<div class="row align-middle">
			<div class="column small-2">
				<i class="fi-alert"></i>
			</div>
			<div class="column small-10">
				<p><b>The server is out of storage space</b></p>
				<span>More space should be available soon. Please come back later.</span>
			</div>
		</div>
		</span>
	</div>
</div>


<div class="row footer align-center">
	<div class="shrink columns">
		<p>&copy 2017 <a href="http://dbmi.ucsd.edu/" target="_blank">DBMI @ UCSD</a></p>
	</div>
</div>
@stop
@section('customCSS')
	<link rel="stylesheet" type="text/css" href="/foundation-icons.css">
	<style type="text/css">
		i.fi-alert {
			font-size: 6rem;
			color: #ffae00;

		}
		#welcome-CSS {
			height: 210px;
		}
		#welcome-text{
			height: 210px;
			justify-content: space-between;
	    flex-direction: column;
	    display: flex;
	    padding-top: 1em;
	    padding-bottom: 1em;
		}
	</style>
@stop