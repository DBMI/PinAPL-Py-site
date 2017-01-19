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
		$('#' + curFileBasename + ' .progress > span').css('width', fileProgress);
		$('#' + curFileBasename + ' .progress > span > p').text(fileProgress);
	}, 1000)
}

function stopProgress() {
	clearInterval(progressInterval);
}

function fileComplete(){
	$('#' + curFileBasename + ' .progress > span > p').text('Done');
	$('#' + curFileBasename + ' .progress > span').css('width', '100%');
	$('#' + curFileBasename + ' .progress').addClass('success');
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





function fromHostUploadClick (destination) {
	var form = $('#fromHostForm');
	var path = $("[name='path']", form).val();
	var url = $("[name='url']", form).val();
	var method = $("[name='method']", form).val();
	var port = $("[name='port']", form).val();
	var uname = $("[name='uname']", form).val();
	var pass = $("[name='pass']", form).val();


	basename = nameFromPath((path)?path:url);
	fileId = 
		drawUploadingFile({
			name: basename,
			size: "n/a"
		});


	$('#'+fileId + ' > .progress > span').css('width', '100%');
	$('#'+fileId + ' > .progress > span > i').text("Uploading in background");

	var data = 
	{
		destination: destination,
		path : path,
		url : url,
		method : method,
		port : port,
		uname : uname,
		pass : pass,
		_token : token
	}
	$.post(
		'/storage/upload-from-host',
		data,
		function (data) {
			if (data.trim()!="ok") {
				console.log(data);
				$('#'+fileId + ' > .progress > span > i').text('Error!');
				$('#'+fileId + ' > .progress').addClass('alert');
				$('#'+fileId + ' > .progress').attr('title', $data);
				$('#'+fileId ).addClass('error');
			} else{
				drawFile("#main-directory" ,basename, fileId, 'n/a', '/'+basename);
			};
		}
	);
}

function sraUploadClick(){
	var form = $('#sraUploadForm');
	var name = $("[name='name']", form).val();
	var limit = $("[name='limit']", form).val();

	$.post("/storage/sra-upload", {name:name, limit:limit, _token:token}, location.reload)
}

function nameFromPath (path) {
	return path.substring(path.lastIndexOf('/') + 1);
}

//TB is the max
function calculateSize(size) {
	if (typeof size == 'string') {
		return size;
	}
	else if(size < 1024) {
		return size + ' B';
	} else if(size < 1048576) {
		return (size / 1024).toFixed(2) + ' kB';
	} else if(size < 1073741824) {
		return (size / 1048576).toFixed(2) + ' MB';
	} else if(size < 1099511627776) {
		return (size / 1073741824).toFixed(2) + ' GB';
	} else {
		return (size / 1099511627776).toFixed(2) + ' TB';
	}
}

function drawUploadingFile(file) {
	var basename = file.name;
	var fileSize = calculateSize(file.size);

	// regex to get rid of weird characters in filenames. DOES NOT ALTER FILE
	// ONLY FOR ID PURPOSES
	basename = basename.replace(/[!"#$%&'()*+,.\/:;<=>?@[\\\]^`{|}~\s]/g, "_");

	$('#file-list').append('\
		<div id="' + basename + '" class="row files">\
		<div class="large-2 columns uploadFileName">' + file.name + '</div>\
		<div class="large-2 columns"><span>' + fileSize + '</span></div>\
		<div class="large-8 columns">\
		<div class="progress">\
		<span class="progress-meter" style="width:0%">\
		<p class="progress-meter-text">Ready</p>\
		</span>\
		</div>\
		</div>\
		</div>');

	return basename;
}

function onCompressClick () {
	var toCompress = [];
	$('#stored-files li.selected').each(function () {
		toCompress.push($(this).attr('relative-path'));
	});

	var name = $("#compress-name").val();
	var format = $("#compress-format").val();

	$.post(
		'/storage/compress-files', 
		{ basePath : basePath,
			files: toCompress,
			name : name,
			format : format,
			_token : token
		},
		function (data) {
			location.reload();
		}
	);
}

function onExtractClick () {
	var path = basePath + $('#stored-files li.selected').attr('relative-path');
	$.post(
		'/storage/extract-archive',
		{ _token : token,
			archive : path
		},
		function (data) {
			location.reload();
		}
	);
}


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
		$("#"+id+" span.progress-meter").width(data);
		$("#"+id+" i").text(data);
		if (data!=="100%") {
			setTimeout(function () {getTransferProgress(id,file);}, 5000);
		} else{
			$("#"+id+" .progress").addClass('success');
			setTimeout(function () {$("#"+id+" div.progressColumn").empty()}, 5000);
		};
	});
}