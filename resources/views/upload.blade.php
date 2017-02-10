@extends('layouts.master')

@section('content')
	<div class="row align-justify">
		<div class="columns ">
			<ol>
				<li>Please add a prefix to your filenames to specify samples, controls and replicate numbers (see right) </li>
				<li>Drag and drop your sequencing data files (*.fastq.gz)</li>
			  <li>Click "Start"</li>  
			</ol>
		</div>
		<div class="columns shrink">
			<small>
				<strong>ToxinA_R1_</strong> 	&#60;rest of filename	&#62;.fastq.gz<br/>
				<strong>ToxinA_R2_</strong> 	&#60;rest of filename	&#62;.fastq.gz<br/>
				<strong>Control_R1_</strong>	&#60;rest of filename	&#62;.fastq.gz<br/>
				<strong>Control_R2_</strong>	&#60;rest of filename	&#62;.fastq.gz<br/>
				etc. "
			</small>
		</div>
	</div>
	<div id="drop-box" class="callout">
		<div class="row">
				<div class="columns medium-12">
					<div id="file-list">
					</div>
					<div id="drop-box-tips" class="center">
						<h4>Drag & drop files here</h4>
					</div>
				</div>
			</div>
	</div>
	<div class="row align-right">
		<div class="columns shrink"><a id="done-uploading-button" class="button">Configure Files</a></div>
	</div>
@stop
@section('customCSS')
@parent
	<link rel="stylesheet" type="text/css" href="/css/upload.css">
@stop

@section('customScripts')
@parent
<script>
	var runDirectory = "{{$dir}}";
	var runId = "{{ $id }}";
	var userDoneUploading = false;
	var client = {};
	var koTransPort = "{{ env('KOTRANS_PORT') }}";
	var appHost = "{{ env('APP_HOST') }}";
</script>
<script type="text/javascript" src="/js/kotrans/kotrans.client.js"></script>
<script type="text/javascript" src="/js/binary.min.js"></script>
<script type="text/javascript" src="/js/upload.js"></script>
<script>
	
	
	function doneUploadingClicked() {
		$('#done-uploading-button').addClass('disabled')
		if (sending==true) {
			userDoneUploading = true;
		}
		else{
				redirectToNext();
		}
	}
	function redirectToNext (argument) {
			 $.post(
			'/done-uploading/'+runId,
			function (data) {
				location.replace('/files/'+runId);
			}
		);
	}
	
	$(document).ready(function() {	
		if (window.location.hostname == '172.21.51.26') {
			client = kotrans.client.createClient({host: '172.21.51.26', port:koTransPort});
		}
		else {
			client = kotrans.client.createClient({host:appHost, port:koTransPort });
		}	


		//This is to prevent the browser from accessing the default attrerty of dragging and
		//dropping the file in the browser.
		$('#drop-box').on('dragenter', onDragEnterDisabled);
		$('#drop-box').on('dragleave', onDragLeaveDisabled);
		$('#drop-box').on('dragover', onDragEnterDisabled);

		//when the user drops file(s) into the designated area
		$('#drop-box').on('drop', dropBoxOnFileDrop);		

		$('#done-uploading-button').on('click', doneUploadingClicked);

		//////////////////////////////////////////
		// STORAGE (CLIENT TO SERVER) LOGIC  	//
		//////////////////////////////////////////
		client.on('open', onClientOpen);
		client.on('close', onClientClose);
	});
</script>
@stop

@section('customCSS')
@parent
<link rel="stylesheet" type="text/css" href="/css/upload.css">
@stop
