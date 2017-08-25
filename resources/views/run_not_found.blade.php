@extends('layouts.master')
@section('content')
<div class="row align-middle" style="margin-top: 5%;">
	<div class="medium-2 align-center columns">
		<img id="welcome-logo" src="/img/logo_with_name.png">
	</div>
	<div class="medium-9 columns">
		<h2>This run does not exist</h2>
		<p>We delete successful runs after 5 days in order to clear up space on our servers. You can always download the results with the "Download Results Archive" button on the top left of a run if you want to keep the results.</p>
		<p>We also delete runs that we consider to be abandoned after 2 days. An abandoned run is one that has not <b>queued, running, or finished</b>. If you are having trouble, please contact us via our <a href="https://groups.google.com/forum/#!forum/pinapl-py" target="_blank">google group</a></p>
	</div>
@stop