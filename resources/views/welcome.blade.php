@extends('layouts.master')
@section('content')
<div class="row">
	<div class="medium-3 align-center columns">
		<img src="/img/logo.png">
	</div>
	<div class="medium-9 columns">
		<h4>Platform-independent Analysis of PooLed screens using Python</h4>
		<span>
			Fully automated online analysis workflow of CRISPR/Cas9 screens, done in 2 easy steps: 
			<ol>
				<li>Upload your sequencing data</li>
				<li>Upload your library file</li>
			</ol>
		</span>
		<span>
			Output includes:
			<ul>
				<li>Analysis of enrichment/depletion of single sgRNAs</li>
				<li>Ranking of enriched/depleted genes</li>
				<li>Correlation analysis between replicates</li>
				<li>Cluster analysis among different samples</li>
				<li>Various statistics on alignment quality, library representation and read counts</li>

			</ul>
		</span>
		<small>A downloadable version of PinAPL-Py together with a full documentation is available at <a href="https://github.com/LewisLabUCSD">https://github.com/LewisLabUCSD</a></small>
	</div>
</div>
<div class="row">
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
<div class="row  align-center align-middle">
	<div class="shrink columns">
		To see an exemplary output from a test dataset, click here
	</div>
	<div class="shrink columns">
		<a class="button trim" href="/run/1">View Example Output</a>
	</div>
</div>

<div class="row footer align-center">
	<div class="shrink columns">
		<p>&copy 2017 <a href="http://dbmi.ucsd.edu/" target="_blank">DBMI @ UCSD</a></p>
	</div>
</div>
@stop