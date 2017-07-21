class uploader {
	constructor (dropBoxId, directory, koTransPort, host, token) {
		this.dropId = dropBoxId;
		this.directory = directory;
		this.koTransPort = koTransPort;
		this.no_streams = 8;
		this.chunk_size = 500000;
		this.host = host;
		this.token = token;
		this.fileQueue = [];
		this.curFileBasename = '';
		this.curFile;
		this.client = {};
		this.sending = false;
		this.doneUploading = false;
		this.progressInterval;
		this.doneUploadingCallBack = function () {
			console.log("User is done uploading, and files are uploaded");
		};
	}

	/* Getters *****************/
	
	/* Setters *****************/
	setDoneUploadingCallBack(value) {
		this.doneUploadingCallBack = value;
	}

	setDoneUploading() {
		this.doneUploading = true;
		if (this.sending == false) {
			this.doneUploadingCallBack()
		}
	}


	initilize(){
		if (window.location.hostname == '172.21.51.26') {
			this.client = kotrans.client.createClient({host: '172.21.51.26', port:this.koTransPort, streams:this.no_streams, chunk_size:this.chunk_size});
		}
		else {
			this.client = kotrans.client.createClient({host:this.host, port:this.koTransPort , no_streams:this.no_streams, chunk_size:this.chunk_size});
		}	


		//This is to prevent the browser from accessing the default attrerty of dragging and
		//dropping the file in the browser.
		$('#drop-box').on('dragenter', this.onDragEnterDisabled);
		$('#drop-box').on('dragleave', this.onDragLeaveDisabled);
		$('#drop-box').on('dragover', this.onDragEnterDisabled);

		//when the user drops file(s) into the designated area
		$('#drop-box').on('drop', this.dropBoxOnFileDrop.bind(this));		


		//////////////////////////////////////////
		// STORAGE (CLIENT TO SERVER) LOGIC  	//
		//////////////////////////////////////////
		this.client.on('open', this.onClientOpen);
		this.client.on('close', this.onClientClose);
	}

	// Hover Functionality for drag and drop
	onDragEnterDisabled(e) {
		e.originalEvent.stopPropagation();
		e.originalEvent.preventDefault();

		if(!$('#drop-box').hasClass('hover fade')) {
			$('#drop-box').addClass('hover fade');
		}
	}

	// Hover Functionality for drag and drop
	onDragLeaveDisabled(e) {
		e.originalEvent.stopPropagation();
		e.originalEvent.preventDefault();

		if($('#drop-box').hasClass('hover fade')) {
			$('#drop-box').removeClass('hover fade');
		}
	}

	onClientOpen() {
		this.fileQueue = [];
	}

	// Information retreived from the server gets placed here.
	startProgress() {
		this.progressInterval = setInterval(function() {
			var fileProgress = (kotrans.client.getProgress() * 100).toFixed(2) + '%';
			$('#' + this.curFileBasename + ' .progress > span').css('width', fileProgress);
			$('#' + this.curFileBasename + ' .progress > span > p').text(fileProgress);
		}.bind(this), 100);
	}

	stopProgress() {
		clearInterval(this.progressInterval);
	}

	fileComplete(){
		$('#' + this.curFileBasename + ' .progress > span > p').text('Done');
		$('#' + this.curFileBasename + ' .progress > span').css('width', '100%');
		$('#' + this.curFileBasename + ' .progress').addClass('success');
		$('#' + this.curFileBasename).addClass('success');
		var basename = this.curFile.name;
		var id = basename.replace(/[^a-zA-Z0-9]/g, '_');
		var relPath = '/'+basename;
		var size = this.calculateSize(this.curFile.size);

		this.sending = false;
		if(this.fileQueue.length == 0 && ! this.sending) {
			if (this.doneUploading == true) {
				this.doneUploadingCallBack()
			}
		}
		else {
			this.sendFile();
		}
	}

	onClientClose() {
	$('#drop-box').append('<div id="upload-error"><h2>Cannot connect to the Server, Please try again later</h2></div>');
	}

	//when file is dropped onto drop-box
	dropBoxOnFileDrop(e) {
		if(this.client) {
			e.originalEvent.stopPropagation();
			e.originalEvent.preventDefault();

			// This has to be here for some reason. I think it was because...
			// I'm too lazy to make another functino.
			if($('#drop-box').hasClass('hover fade')) {
				$('#drop-box').removeClass('hover fade');
			}
			
			//grab the file
			for(var i = 0; i < e.originalEvent.dataTransfer.files.length; i++) {
				this.drawUploadingFile(e.originalEvent.dataTransfer.files[i]);
				this.fileQueue.push(e.originalEvent.dataTransfer.files[i]);
			}
			this.sendFile();
		} else {
			e.originalEvent.stopPropagation();
			e.originalEvent.preventDefault();
			alert('You cannot drop files at this time.');
		}
	}

	sendFile() {
		this.sending = true;
		this.curFile = this.fileQueue.shift();
		this.curFileBasename = this.curFile.name.replace(/[!"#$%&'()*+,.\/:;<=>?@[\\\]^`{|}~\s]/g, "_");
		this.startProgress();
		kotrans.client.sendFile(this.curFile, this.directory, function () {
			this.stopProgress();
			this.fileComplete();
		}.bind(this));
	}

	//TB is the max
	calculateSize(size) {
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

	drawUploadingFile(file) {
		var basename = file.name;
		var fileSize = this.calculateSize(file.size);

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


}


