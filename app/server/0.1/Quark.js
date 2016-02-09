
/* Application Quark */
var express = require('express'),
	app = express(),
	bodyParser = require('body-parser'),
	methodOverride = require('method-override');

	app.use(bodyParser.urlencoded({extended : false}));
	app.use(bodyParser.json());
	app.use(methodOverride());

var http = require('http').Server(app);
var io = require('socket.io')(http);

/* Base de datos */
var database = require('quantum-chat/database'),
	ipDatabase = database;

/* Applicacion Quantum*/
var colors = require('colors');
var appConfig = require('quantum-chat/config');
process.title = 'Quark API: '+appConfig.propertiesApp.portQuark;

/* Express Router */
var router = express.Router();

ipDatabase.__construct({
	server : appConfig.propertiesApp.database.server,
	base : appConfig.propertiesApp.database.db,
	user : appConfig.propertiesApp.database.user,
	password : appConfig.propertiesApp.database.password,
	port : appConfig.propertiesApp.database.port,
	schema : {
		rewrite : false
	}
});

ipDatabase.startConnection(function(){

	http.listen(appConfig.propertiesApp.portQuark,function(){
		console.log(colors.magenta('Node Server API Rest QUARK corriendo en el puerto '+appConfig.propertiesApp.portQuark));

		/* Quark : Api para Sockets de la aplicación */
		var quark = {
			connections : {
				post : {
					url : require('quantum-chat/atom/connections/atom.post.js'),
					callback : socketsServer.createConnection
				}
			}
		}

		/* Metodos para Connections */
		router.get('/', function(req, res){
			res.sendFile(__dirname + '/dummie.client.html');
		});

		router.post('/connections',function(res, req){
			quark.connections.post.url(res, req, quark.connections.post.callback);
		});
	

		app.use(router);		
	});

});


var socketsServer = {
	createConnection : function(nameSpaceSocket){
		console.log('se creo : '+nameSpaceSocket);
		io.of('/'+nameSpaceSocket)
			.on('connection',function(socket){
				console.log(colors.inverse.yellow('Usuario conectado -> '+ socket.id));

				socket.on('disconnect',socketsServer.disconnect);
			});
	},
	disconnect : function(){
		console.log(colors.inverse.magenta('Usuario desconectado -> '+ socket.id));
	}
}

