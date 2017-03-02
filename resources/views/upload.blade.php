@extends('layouts.master')

@section('content')
	<div class="row align-justify">
		<div class="columns ">
			<ol>
				<li>Drag and drop your sequencing data files (*.fastq.gz)</li>
			  <li>Click "Enter Sample Information" when finished.</li>  
			</ol>
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
		<div class="columns shrink"><a id="done-uploading-button" class="button">Enter Sample Information</a></div>
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
	var koTransPort = "{{ config('kotrans.port') }}";
	var appHost = "{{ config('kotrans.host') }}";
	var token = "{{csrf_token()}}";
</script>
<script type="text/javascript" src="/js/kotrans/kotrans.client.js"></script>
<script type="text/javascript" src="/js/binary.min.js"></script>
<script type="text/javascript" src="/js/upload.js"></script>
<script>
	
	var uploadManager = new uploader('#drop-box',runDirectory, koTransPort, appHost, token);
	uploadManager.setDoneUploadingCallBack (function (){
			 $.post(
			'/done-uploading/'+runId,{_token : token},
			function (data) {
				location.replace('/files/'+runId);
			}
		);
	});
	function doneUploadingClicked() {
		$('#done-uploading-button').addClass('disabled')
		uploadManager.setDoneUploading();
		// if (sending==true) {
		// 	userDoneUploading = true;
		// }
		// else{
		// 		redirectToNext();
		// }
	}
	$('#done-uploading-button').on('click', doneUploadingClicked);
		$(document).ready(function() {	
		uploadManager.initilize();
	});
</script>
@stop

@section('customCSS')
@parent
<link rel="stylesheet" type="text/css" href="/css/upload.css">
@stop
