
/**
 * Module dependencies.
 */

var express = require('express');
var faye = require('faye');
var routes = require('./routes');
var user = require('./routes/user');
var http = require('http');
var path = require('path');

//db vars
var mongo = require('mongodb');
var monk = require('monk');
var db = monk('mongodb://jurgb:1308JuBa@oceanic.mongohq.com:10059/imdwall');

//faye server variabelen&
var bayeux = new faye.NodeAdapter({
    	mount: '/faye',
    	timeout: 45
    });
var app = express();
var server = http.createServer(app);

bayeux.attach(server);


// all environments
app.use(express.favicon());
app.use(express.static(__dirname, 'public'));
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'jade');
app.use(express.logger('dev'));
app.use(express.json());
app.use(express.urlencoded());
app.use(express.methodOverride());
app.use(app.router);


// development only
if ('development' == app.get('env')) {
  app.use(express.errorHandler());
}

//pages GET
app.get('/', routes.index);
app.get('/scoreboard', routes.scoreboard);
app.get('/users', user.list);

//pages POST


server.listen(3000);
console.log("App launched on port 3000");
