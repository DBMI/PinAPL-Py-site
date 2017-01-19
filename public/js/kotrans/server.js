var http = require('http');
var kotrans = require('kotrans');
var port = 9000;
var server = http.createServer();

kotrans.createServer({
	server : server,
	path : '/sendData',
	directory : '/var/www/',
}, function() {
	console.log('kotrans server set up successfully.');
});

server.listen(port, function() {
	console.log('server listening on port '+port);
});
