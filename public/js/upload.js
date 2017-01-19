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
		<div class="progress large-8 columns">\
		<span  class="meter" style="width:0%">\
		<i>Ready</i>\
		</span>\
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