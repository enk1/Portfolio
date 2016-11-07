//Static server on node.js
//To run server ~node start.js

var StaticServer = require('static-server');

//New server object with path to files and port
var server = new StaticServer({
    rootPath: './public/',
    port: 3000
});

//Function starting server
server.start(function(){
    console.log('Server running on ' +server.port);
});