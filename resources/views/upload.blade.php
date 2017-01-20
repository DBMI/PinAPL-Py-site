@extends('layouts.master')

@section('content')
	<div class="row align-justify">
		<div class="columns shrink">Drop Files Below</div>
		<div class="columns shrink"><a id="done-uploading-button" class="button">Done Uploading Files</a></div>
	</div>
	<div id="drop-box">
		<div class="row">
				<div class="columns medium-12">
					<div id="file-list">
					</div>
				</div>
			</div>
	</div>
@stop
@section('customCSS')
@parent
	<link rel="stylesheet" type="text/css" href="/css/upload.css">
@stop



<!-- Delete file/folder modal -->
<div id="delete-modal" class="reveal-modal tiny" data-reveal>
	<a class="close-reveal-modal">&#215;</a>
	<h3 >Delete these items?</h3>
	<div class="row fullWidth">
		<ul id="delete-modal-selected-files"></ul>
	</div>
	<div class="row">
		<div class="columns medium-6"><a id="delete-storage" class="button alert expand">Delete</a></div>
		<div class="columns medium-6"><a class="button secondary expand close-reveal-modal not-X">Cancel</a></div>
	</div>
</div>


<!-- Rename item modal -->
<div id="rename-modal" class="reveal-modal tiny" data-reveal>
	<a href="" class="close-reveal-modal">&#215;</a>
	<h3>Rename item</h3>
	<input id="rename-item" type="text" name="directory" placeholder="New Name" />
</div>

<!-- Error modal -->
<div id="error-modal" class="reveal-modal tiny" data-reveal>
	<a href="" class="close-reveal-modal">&#215;</a>
	<span id="error-modal-text"></span>
</div>

@section('customScripts')
@parent
<script>
	var runDirectory = "{{$dir}}";
	var runId = "{{ $id }}";
	var userDoneUploading = false;
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
		redirectToStartRun()
	}
}
function redirectToStartRun (argument) {
	$.post(
		'/run/start/'+runId,
		function (data) {
			location.replace('/run/'+runId);
		}
	);
}

$(document).ready(function() {

	console.log('document.ready fired');
	client = kotrans.client.createClient({ port:'9000' });

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
