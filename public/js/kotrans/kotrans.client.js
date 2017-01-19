 /**
 * kotrans.client.js
 * 
 * Client connection using BinaryJS
 * A reference to this js file AND client.config.js should be in your HTML/PHP
 * 
 * <script src="path/to/client.connection.js"></script>
 *
 * @author Sam Ko
 */

'use strict';

var kotrans = kotrans || {};

kotrans.client = (function () {
	
	//done signifies all file Chunks were transfered
	var Client2ServerFlag = {
		send: 'send',
		sendMul: 'sendMul',
		transferComplete: 'transferComplete',
		setup : 'setup',
		stream_id : 'stream_id',
		main_id : 'main_id',
		exists : 'exists'
	}
	
	//sent signifies that the file chunk was sent.
	var Server2ClientFlag = {
		sent: 'sent',
		updateClient: 'updateClient',
		commandComplete: 'commandComplete',
		error: 'error',
		setup : 'setup',
		existsResult : 'existsResult'
	}

	var file;
	var fileName;

	var mainClientID;
	//stores
	var fileChunks;
	var chunk_size = 4194304;

    var timeTook,
    	start;
   	var mainClient;
    var clients;
    var clientids;
    var chunkNumber;
    var totalChunks;
    var sentChunks;
    var allTransferred;
    var progress;
    var working;
	function createClient(options) {
		var i;
		var options = options || {};
		var host = options.host || 'localhost';
		var port = options.port || '9000';
		var streams = options.no_streams || 2;
		var path = options.path || '';
		mainClient = location.protocol === 'https:' ? new BinaryClient('wss://' + host + ':' + port + path) : new BinaryClient('ws://' + host + ':' + port + path);
		
		
		clients = [];
		clientids = 0;
		allTransferred = false;
		sentChunks = 0;
		working = false;
		// init
		mainClient.on('open', function() {
			mainClient.pid = clientids++;
			mainClient.send({}, {
				cmd : Client2ServerFlag.main_id
			});
		});

		mainClient.on('stream', function(stream, meta) {
			if(meta.cmd === Server2ClientFlag.commandComplete) {
				finish();
			} else if(meta.cmd === Client2ServerFlag.main_id) {
				mainClientID = meta.main_id;

				for(i = 0; i < streams; ++i) {
					clients.push(initClient(host, port, path));
				}
			} else if(meta.cmd === Server2ClientFlag.existsResult) {
				var tmp = file.name.split('.'); tmp[0] = tmp[0].concat(+meta.iteration === 0 ? '' : '(' + meta.iteration + ')');
				fileName = tmp.join('.');
				if(meta.exists) {
					mainClient.send({}, {
						cmd : Client2ServerFlag.exists,
						fileName : file.name,
						iteration : ++meta.iteration
					})
				} else {
					send();
				}
			}
		});

		mainClient.on('error', function(err) {
			throw err;
		});

		mainClient.on('close', function() {

		});

		return mainClient;
	}

	function initClient(host, port, path) {
		var client = location.protocol === 'https:' ? new BinaryClient('wss://' + host + ':' + port + path) : new BinaryClient('ws://' + host + ':' + port + path);
		client.on('open', function() {
			client.pid = clientids++;

			client.send('', {
				cmd : Client2ServerFlag.stream_id,
				main_id : mainClientID
			});
		});

		client.on('stream', function(stream, meta) {
			if(meta.cmd === Server2ClientFlag.sent) {
				
				allTransferred = (totalChunks === ++sentChunks);
				if(fileChunks.length === 0) {
					if(allTransferred) {
						client.send({}, {
							fileName : fileName,
							fileSize : file.size,
							cmd : Client2ServerFlag.transferComplete,
							main_id : mainClientID
						});
					} 
				} else {
					var chunk = fileChunks.shift();
					client.send(chunk, {
						chunkName : fileName + '_' + chunkNumber++,
						chunkSize : chunk.size,
						fileSize : file.size,
						fileName : fileName,
						cmd : Client2ServerFlag.send
					});
				}
			} else if(meta.cmd === Server2ClientFlag.commandComplete) {
				finish();
			} else if(meta.cmd === Server2ClientFlag.updateClient) {
				//WillsentChun be sent the file name and the % compete
				//lots of overhead if client that is sending is also giving updates.
			} else if(meta.cmd === Client2ServerFlag.main_id) {
			} else if(meta.cmd === Client2ServerFlag.stream_id) {

			}
		});

		client.on('close', function() {
			throw 'client ' + client.pid + ' closed unexpectedly.';
		});

		client.on('error', function(error) {
			throw error;
		});

		return client;
	}

	var callback;
	function sendFile(sendingFile, destinationDir, cbFun) {
		working = true;
		totalChunks = 0;
		sentChunks = 0;
		allTransferred = false;
		file = sendingFile;
		chunkNumber = 0;
		mainClient.send({}, { cmd : Client2ServerFlag.setup, 
							  fileSize : file.size / 1000000,
							  directory : destinationDir });
		callback = callback || cbFun;
		initFile();
	}	

	function initFile() {
		//console.log(file);
		fileChunks = [];
		var currentSize = chunk_size;
		var i = 0;

		while (i < file.size) {
			//console.log(i);
			//for the last chunk < chunk_size
			if (i + chunk_size > file.size) {
				fileChunks.push(file.slice(i));
				break;
			}
			fileChunks.push(file.slice(i, currentSize));
		
			i += chunk_size;
			currentSize += chunk_size;
		}
		totalChunks = fileChunks.length;
		checkExists();
	}

	function checkExists() {
		mainClient.send({}, {
			cmd : Client2ServerFlag.exists,
			fileName : file.name,
			iteration : 0
		});
	}

	var interval;
	function send() {
		interval = setInterval(function() {
			//console.log(!working || totalChunks === 0 ? 0 : sentChunks / totalChunks);
			mainClient.send({}, {
				cmd : Server2ClientFlag.updateClient,
				percent : !working || totalChunks === 0 ? 0 : sentChunks / totalChunks
			});
		}, 1000);
		clients.forEach(function(client) {
			if(fileChunks.length !== 0) {
				var chunk = fileChunks.shift();
				client.send(chunk, {
					chunkName : fileName + '_' + chunkNumber++,
					chunkSize : chunk.size,
					fileSize : file.size,
					fileName : fileName,
					cmd : Client2ServerFlag.send
				});
			}
		});
	}

	function finish() {
		working = false;
		clearInterval(interval);
		if(callback) {
			callback();
		}
	}

	function getProgress() {
		return !working || totalChunks === 0 ? 0 : sentChunks / totalChunks;
	}

	return {
		createClient: createClient,
		sendFile: sendFile,
		getProgress : getProgress
	}
})();
