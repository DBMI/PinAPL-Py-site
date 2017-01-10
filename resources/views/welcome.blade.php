@extends('layouts.master')
@section('content')
	<div class="row">
		<div class="medium-3 centered columns">
			<img src="/img/logo.png">
		</div>
		<div class="medium-9 columns">
			<h2>Drag-and-drop FASTQ files for microRNA-Seq Analysis </h2>
		</div>
	</div>
	<div class="row">
		<div class="small-12 columns">
			<div class="callout">
				<form action="/upload" method="post" class="custom" enctype="multipart/form-data">
					<div class="row">
						<div class="medium-6 columns">
							<label for="email"><span class="has-tip tip-top whiteTxt" title="The e-mail address we should send your results to">E-mail Address</span></label>
							<input id="email" name="email" type="text" required />
						</div>
						<div class="medium-6 columns">
							<label for="name"><span class="has-tip tip-top whiteTxt" title="Please give this data a name">Experiment Name</span></label>
							<input id="name" name="run_name" type="text"/>
						</div>
					</div>
					<div class="row">
						<div class="three columns offset-by-nine">
							<input type="submit" id="runSubmitButton" class="medium success button expand"/>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
		<div class="row">
				<div class="small-4 columns centered">
						<hr class="expand"/>
						<a class="medium radius button expand" href="results.php?id=demo_run_kd">Demo Run</a>
				</div>
		</div>

	<div class="row footer">
		<div class="small-3 columns centered">
			<p>&copy 2013 <a href="http://dbmi.ucsd.edu/" target="_blank">DBMI @ UCSD</a></p>
		</div>
	</div>
@stop