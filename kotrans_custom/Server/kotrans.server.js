/**
 * server.connection.js
 * 
 * Server connection using node.js. To utilize this file, user must invoke the 
 * require() nodejs method.
 *
 * require('path/to/server.connection.js');
 * 
 * @author  Sam Ko
 */

'use strict';

var kotrans = kotrans || {};

kotrans.server = (function () {
    var fs = require('fs');
    var os = require('os');
    var cluster = require('cluster');
    var exec = require('child_process').exec;
    var child_process = require('child_process');
    var http = require( 'http' );
    var path = require('path');
    var BinaryServer = require('binaryjs').BinaryServer;
    var async = require('async');
    //done signifies all files were transfered
    var Client2ServerFlag = {
        send : 'send',
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

    var socketServer;
    var processors;
    var worker;

    var uploadedBytes;
    var fileSize;

    var file;
    var percentComplete;

    var allowedDirectory;

    var mainClientList;
    var child_list;

    function createServer(options, callback) {
        mainClientList = {};
        child_list = {};

        var options = options || {};
        var server = options.server;
        var route = options.route;
        //code for multiple threads means faster concatenation
        processors = os.cpus().length;
        allowedDirectory = options.directory || __dirname + '/../../../uploads';

        socketServer = new BinaryServer({ server: server, path : route });

        socketServer.on('connection', onSocketConnection);

        socketServer.on('error', function(err) {
            console.log(err);
        })
        if(callback instanceof Function) {
            callback();
        }

        
    }

    //wait for new user connection
    var execQueue;
    var initialized = false;
    function onSocketConnection(client) {
        console.log("Client connected with ID " + client.id);
        //work on the incoming stream from browsers
        client.on('stream', function (stream, meta) {
            if (meta.cmd === Client2ServerFlag.send) {
                file = fs.createWriteStream(path.join(socketServer.clients[client.main_id].allowedDirectory, meta.chunkName));
                file.on('error', function(err) { 
                    console.log(err);
                    process.exit();
                });
                stream.pipe(file);    
            } else if(meta.cmd === Client2ServerFlag.transferComplete) {
                //entire file has finished transferring, combining pieces together
                child_list[meta.main_id].send({
                    cmd : 'finish'
                });
            } else if(meta.cmd === Client2ServerFlag.setup) {
                //only master client will be able to enter this.
                var child;
                uploadedBytes = 0;
                fileSize = meta.fileSize;
                client.allowedDirectory = meta.directory || allowedDirectory;
                if(child_list[client.id]) {
                    console.log('killing child, which it shouldnt be doing');
                    child_list[client.id].kill();
                }
                child = child_process.fork('./worker', {
                    cwd : __dirname
                });

                child.on('message', function(message) {
                    if(message === 'working') {
                        setTimeout(function() {
                            child.send({
                                cmd : 'finish'
                            });
                        }, 50);
                    } else if(message === 'finished') {
                        client.send({}, { cmd : Server2ClientFlag.commandComplete });
                        child_list[client.id].kill();
                        delete(child_list[client.id]);
                    } else if(message === 'exiting') {
                        child_list[client.id].kill();
                        delete(child_list[client.id]);
                    }
                });

                child.send({
                    cmd : 'setup'
                });

                child.send({
                    cmd : 'directory',
                    directory : client.allowedDirectory
                });

                child_list[client.id] = child;

            } else if(meta.cmd === Client2ServerFlag.main_id) {
                //let the server know which streams comes from which client.
                mainClientList[client.id] = {
                    streams : []
                }

                client.send({}, {
                    cmd : Client2ServerFlag.main_id,
                    main_id : client.id
                });
            } else if(meta.cmd === Client2ServerFlag.stream_id) {

                try {
                    // I think this error might actually be occuring if the streams arrive out of order, there for the main id index doesn't exist yet
                    // To solve this, check existence first, if it doesn't exist create it. 
                    mainClientList[meta.main_id].streams.push(client.id); // Error occurs here. "Cannot read property 'streams' of undefined"
                    client.main_id = meta.main_id;
                } catch(err) {
                    console.log('Error creating new client stream. Logging Error and attempting to move on ');
                    console.log('Main id : '+meta.main_id+"; Stream id : "+client.id);

                    console.log("Memory free: "+os.freemem(+" / "+os.totalmem() + " bytes"));
                    console.log(err);
                }
            } else if(meta.cmd === Client2ServerFlag.exists) {
                var tmp = meta.fileName.split('.'); tmp[0] = tmp[0].concat(+meta.iteration === 0 ? '' : '(' + meta.iteration + ')');
                var fileName = tmp.join('.');
                console.log('filename being sent ' + fileName);
                fs.exists(path.join(socketServer.clients[client.id].allowedDirectory, fileName), function(exists) {
                    // console.log(exists);
                    client.send({}, {
                        cmd : Server2ClientFlag.existsResult,
                        exists : exists,
                        iteration : meta.iteration
                    });
                });
            }

            // Sends data back to the client with a percentage complete with file name
            stream.on('data', function (data) {
                
            });

            stream.on('close', function() {
                if(mainClientList[client.id]) {
                    console.log('main client ' + client.id + ' disconnected');
                    // child_list[client.id].send({
                    //     cmd: 'kill'
                    // });
                    console.log('Before delete:');
                    console.log(mainClientList);
                    delete(mainClientList[client.id]);
                    console.log("Still connected:");
                    console.log(mainClientList);
                }

            })
            // Send a message to the client that the fileChunk was successfully transferred.
            stream.on('end', function () {
                if(meta.cmd === Client2ServerFlag.send) {
                    child_list[client.main_id].send({
                        cmd : 'file',
                        name : meta.chunkName
                    });
                    client.send({}, { chunkName: meta.chunkName, cmd: Server2ClientFlag.sent });
                }
            });
        });
    }

    module.exports = {
        createServer: function(options, callback) {
            createServer(options, callback);
        }
    }
})();