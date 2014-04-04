
/**
 * Module dependencies.
 */

var express = require('express');
var faye = require('faye');
var routes = require('./routes');
var user = require('./routes/user');
var http = require('http');
var path = require('path');




var bayeux = new faye.NodeAdapter({
    	mount: '/faye',
    	timeout: 45
    });
var app = express();
var server = http.createServer(app);

bayeux.attach(server);


// all environments
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'jade');
app.use(express.favicon());
app.use(express.logger('dev'));
app.use(express.json());
app.use(express.urlencoded());
app.use(express.methodOverride());
app.use(app.router);
app.use(express.static(path.join(__dirname, 'public')));

// development only
if ('development' == app.get('env')) {
  app.use(express.errorHandler());
}

app.get('/', routes.index);
app.get('/scoreboard', routes.scoreboard);
app.get('/users', user.list);

server.listen(3000);
console.log("App launched on port 3000");
