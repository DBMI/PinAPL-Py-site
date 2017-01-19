
sending files to <?php echo($dir) ?>
@extends('layouts.master')

@section('content')
	<form id="fromHostForm">
		<fieldset>
			<legend>Upload from remote host</legend>
			<div class="row">
				<div class="columns medium-6">
					<label for="url">
						Address
					</label>
					<div class="row collapse"><div class="columns small-2">
						<select name="method"  class="prefix">
							<option value="http">http://</option>
							<option value="ftp">ftp://</option>
							{{-- <option value="sftp">sftp://</option> --}}
							<option value="scp">scp</option>
						</select>
					</div>
					<div class="columns small-10">
						<input type="text" name="url" id="url" placeholder="url">
					</div></div>
				</div>
				<div class="columns medium-6">
					<label > Path to file
						<input type="text" name="path" placeholder="Path to file">
					</label>
				</div>
			</div>
			<div class="row">
				<div class="columns medium-3">
					<label>
						Port
						<input type="text" name="port" placeholder="Port" >
					</label>
				</div>
				<div class="columns medium-3">
					<label>
						Username
						<input type="text" name="uname" placeholder="Username" >
					</label>
				</div>
				<div class="columns medium-3">
					<label>
						Password
						<input type="password" name="pass" placeholder="Password" >
					</label>
				</div>
				<div class="columns medium-3">
					<a id="fromHostUpload" class="button expand">Upload</a>
				</div>
			</div>
		</fieldset>
	</form>
	<form id="sraUploadForm" accept-charset="utf-8">
		<fieldset>
			<legend>SRA/dbGap</legend>
			<div class="row">
				<div class="columns medium-5">
					<input type="text" name="name" placeholder="Accession">
				</div>
				<div class="columns medium-2">
					<input type="number" name="limit" placeholder="Maximum spot id">
				</div>
				<div class="columns medium-5">
					<a class="button" id="sraUploadButton">Retrieve</a>
				</div>
			</div>
		</fieldset>
	</form>
	<fieldset id="drop-box">
		<legend>Drop Files here</legend>
		<div class="row">
				<div class="columns medium-12">
					<div id="file-list">
					</div>
				</div>
			</div>
	</fieldset>
@stop
@section('customCSS')
@parent
	<link rel="stylesheet" type="text/css" href="/css/upload.css">
@stop

<script>
	function drawFile(parent ,basename, id, size, relPath) {
		var file = '\
		<li id="'+id+'" relative-path="'+relPath+'" name="'+basename+'" class="file">\
			<div class="row">\
				<div class="columns medium-3">\
					<img class="file" src="/img/svgs/fi-page.svg" >\
					'+basename+'\
				</div>\
				<div class="columns medium-2 end">Size: '+size+'</div>\
			</div>\
		</li>';
		$(parent).append(file);
		$('#'+id).click(selectItem);
	}

	function getTransferProgress (id, file) {
		console.log('getting progress for '+file);
		$.get("{{route('uploadProgress')}}/"+file, function(data){
			// Remove extra whitespace
			data=data.trim();
			$("#"+id+" span.meter").width(data);
			$("#"+id+" i").text(data);
			if (data!=="100%") {
				setTimeout(function () {getTransferProgress(id,file);}, 5000);
			} else{
				$("#"+id+" .progress").addClass('success');
				setTimeout(function () {$("#"+id+" div.progressColumn").empty()}, 5000);
			};
		});
	}
</script>


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
<script>var runDirectory = "{{$dir}}";</script>
<script type="text/javascript" src="/js/kotrans/kotrans.client.js"></script>
<script type="text/javascript" src="/js/binary.min.js"></script>
<script type="text/javascript" src="/js/upload.js"></script>
<script>
var fileQueue;

var curFileBasename = '';
var curFile;
var client
var lastSelected;
var sending = false;


// Solution supporting arbitrary number of handlers
function isFirstLi(event){
	var check = event.target;
	while (!$(check).is('li')){
		check = check.parentElement;
	}
	return (check == event.currentTarget)
}

// Used like so:
function selectItem(event){
	if ($(this).is('li')) {
		if (!isFirstLi(event) || $(event.target).is('a.tabHeading')) return;
		var lastSelected = this.index;
		if (event.shiftKey) {
			document.getSelection().removeAllRanges();
			// TODO add in logic for shift click
		}
		else {
			$(this).toggleClass('selected');
			if (!event.ctrlKey && !event.metaKey) {
				$('.accordion li').not(this).removeClass('selected');
			};
		}
	}
}



//Add the onclick functionality for files and folders
$('.accordion > li').click(selectItem)

$('#delete-storage').on('click', onDeleteStorageClick);
$('#fromHostUpload').on('click', function (){fromHostUploadClick(basePath)});
$('#sraUploadButton').on('click', sraUploadClick);
$('#extract-archive').on('click', onExtractClick);
$("#rename-item").keyup(function (e) {
	if (e.keyCode == 13) {
		var newName = $('#rename-item').val();
		var relPath = $('#stored-files li.selected').attr('relative-path');
		$.post(
			"{{route('renameFile')}}",
			{ file : relPath,
				newName : newName
			},
			function (status) {
				location.reload();
			}
			);
	}
});

//On reveal of delete-modal, show selected files;
$(document).on('open.fndtn.reveal', '#delete-modal', function () {
	var modal = $(this);
	var selectedList = $('#delete-modal-selected-files');
	selectedList.empty();
	console.log('delete-modal opened');
	var selected = $('#stored-files li.selected');
	$.each(selected, function (index, value) {
		var icon = "";
		if ($(value).hasClass('folder')) {
			icon = '<img class="folder" src="/img/svgs/fi-folder.svg" >';
		}
		else if ($(value).hasClass('file')) {
			icon = '<img class="file" src="/img/svgs/fi-page.svg" >';
		}
		selectedList.append('<li>'+icon + $(value).attr('name')+'</li>');
	});
});

$('#reveal-rename').click( function () {
	if($('#stored-files li.selected').length == 1){
		$('#rename-item').val($('#stored-files li.selected').attr('name'))
		$('#rename-modal').foundation('reveal', 'open');
	}
	else if ($('#stored-files li.selected').length > 1) {
		$('#error-modal-text').text('Please select only one item.');
		$('#error-modal').foundation('reveal', 'open');
	}
	else {
		$('#error-modal-text').text('Please select an item to rename.');
		$('#error-modal').foundation('reveal', 'open');
	}
});

// You cannot post to a laravel URL action in a separate JS file, which is why this is here. Might think of workaround
function onDeleteStorageClick() {
	var files = [];
	$('#stored-files li.file.selected').each(function () {
		files.push($(this).attr('relative-path'));
	});
	var folders = [];
	$('#stored-files li.folder.selected').each(function () {
		folders.push($(this).attr('relative-path'));
	});

	// $.post parameters are as follows:
	// URL
	// Data
	// Callback function upon success
	$.post(
		'{{ route("deleteData") }}', 
		{ files: files,
			folders: folders,
		},
		function(){
			$('#stored-files li.selected').remove();
			$('#delete-modal').foundation('reveal', 'close');
		}
		);
}



$(document).on('close.fndtn.reveal', '#upload-modal', function () {
	$('.files.success').remove();
});
//On reveal of move-modal, show selected files;
$(document).on('open.fndtn.reveal', '#move-modal', function () {
	var modal = $(this);
	var folders = $('#stored-files > ul.accordion').clone()
	$('#mainDir').empty().append("Main Directory").append(folders);
	$('#mainDir .file').remove();
	$('#mainDir li').each(function () {
		var relPath = this.getAttribute('relative-path');
		var name = this.getAttribute('name');
		while(this.attributes.length > 0){
			this.removeAttribute(this.attributes[0].name);
		}
		this.setAttribute('relative-path', relPath);
		this.setAttribute('name', name);
		$(this).prepend(name);
	});
	$('#possible-destinations :not(li)').each(function () {
		while(this.attributes.length > 0){
			this.removeAttribute(this.attributes[0].name);
		}
	});
	$('#possible-destinations div').children().unwrap();
	$('#possible-destinations img, #possible-destinations a').remove();
	$('#possible-destinations *')
	.filter(function() {
		return $.trim($(this).text()) === '' && $(this).children().length == 0
	})
	.remove();

	$('#possible-destinations li').click(selectDestination)

});

function selectDestination () {
	if ($(this).is('li')) {
		if (!isFirstLi(event) || $(event.target).is('a.tabHeading')) return;
		else {
			$(this).toggleClass('selected');
			$('#possible-destinations li').not(this).removeClass('selected');
		}
	}
}

// Hover Functionality for drag and drop
function onDragEnterDisabled(e) {
	e.originalEvent.stopPropagation();
	e.originalEvent.preventDefault();

	if(!$('#drop-box').hasClass('hover fade')) {
		$('#drop-box').addClass('hover fade');
	}
}

// Hover Functionality for drag and drop
function onDragLeaveDisabled(e) {
	e.originalEvent.stopPropagation();
	e.originalEvent.preventDefault();

	if($('#drop-box').hasClass('hover fade')) {
		$('#drop-box').removeClass('hover fade');
	}
}

function onClientOpen() {
	fileQueue = [];
}

var progressInterval;
// Information retreived from the server gets placed here.
function startProgress() {
	progressInterval = setInterval(function() {
		var fileProgress = (kotrans.client.getProgress() * 100).toFixed(2) + '%';
		$('#' + curFileBasename + ' > .progress > span').css('width', fileProgress);
		$('#' + curFileBasename + ' > .progress > span > i').text(fileProgress);
	}, 1000)
}

function stopProgress() {
	clearInterval(progressInterval);
}

function fileComplete(){
	$('#' + curFileBasename + ' > .progress > span > i').text('Done');
	$('#' + curFileBasename + ' > .progress > span').css('width', '100%');
	$('#' + curFileBasename + ' > .progress').addClass('success');
	$('#' + curFileBasename).addClass('success');
	var basename = curFile.name;
	var id = basename.replace(/[^a-zA-Z0-9]/g, '_');
	var relPath = '/'+basename;
	var size = calculateSize(curFile.size);
	drawFile("#main-directory" ,basename, id, size, relPath);

	sending = false;
	onSendClick();
}

function onClientClose() {
$('#drop-box').append('<div id="upload-error"><h2>Cannot connect to the Server, Please try again later</h2></div>');
}

//when file is dropped onto drop-box
function dropBoxOnFileDrop(e) {
	if(client) {
		e.originalEvent.stopPropagation();
		e.originalEvent.preventDefault();

		// This has to be here for some reason. I think it was because...
		// I'm too lazy to make another functino.
		if($('#drop-box').hasClass('hover fade')) {
			$('#drop-box').removeClass('hover fade');
		}
		
		//grab the file
		for(var i = 0; i < e.originalEvent.dataTransfer.files.length; i++) {
			fileQueue.push(e.originalEvent.dataTransfer.files[i]);
			drawUploadingFile(e.originalEvent.dataTransfer.files[i]);
		}
		onSendClick();
	} else {
		e.originalEvent.stopPropagation();
		e.originalEvent.preventDefault();
		alert('You cannot drop files at this time.');
	}
}

function onSendClick() {
	if(fileQueue.length == 0 || !fileQueue || sending) {
	} else {
		sending = true;
		curFile = fileQueue.shift();
		curFileBasename = curFile.name.replace(/[!"#$%&'()*+,.\/:;<=>?@[\\\]^`{|}~\s]/g, "_");
		startProgress();
		kotrans.client.sendFile(curFile, runDirectory, function () {
			stopProgress();
			fileComplete();
		});
	}	
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
