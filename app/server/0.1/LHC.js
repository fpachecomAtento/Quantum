// Large Hadron Collider

/* Web */
var express = require('express'),
	app = express(),
	bodyParser = require('body-parser'),
	methodOverride = require('method-override');

	app.use(bodyParser.urlencoded({extended : false}));
	app.use(bodyParser.json());
	app.use(methodOverride());

/* Base de datos */
var database = require('quantum-chat/database'),
	ipDatabase = database;

/* Applicacion Quantum*/
var colors = require('colors');
var appConfig = require('quantum-chat/config');

	
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

	app.listen(appConfig.propertiesApp.port,function(){
		console.log(colors.magenta('Node Server API Rest corriendo en el puerto '+appConfig.propertiesApp.port));

		/* Atlas : Api para CRUD de la aplicación */
		var atlas = {
			version : {
				get : require('quantum-chat/atlas/version/atlas.get.js'),
				post : require('quantum-chat/atlas/version/atlas.post.js'),
				delete : require('quantum-chat/atlas/version/atlas.delete.js'),
				put : require('quantum-chat/atlas/version/atlas.put.js')
			},
			user : {
				get : require('quantum-chat/atlas/user/atlas.get.js'),
				post : require('quantum-chat/atlas/user/atlas.post.js'),
				delete : require('quantum-chat/atlas/user/atlas.delete.js'),
				put : require('quantum-chat/atlas/user/atlas.put.js')
			},
			apps : {
				get : require('quantum-chat/atlas/apps/atlas.get.js'),
				post : require('quantum-chat/atlas/apps/atlas.post.js'),
				delete : require('quantum-chat/atlas/apps/atlas.delete.js'),
				put : require('quantum-chat/atlas/apps/atlas.put.js')
			},
			companys : {
				get : require('quantum-chat/atlas/companys/atlas.get.js'),
				post : require('quantum-chat/atlas/companys/atlas.post.js'),
				delete : require('quantum-chat/atlas/companys/atlas.delete.js'),
				put : require('quantum-chat/atlas/companys/atlas.put.js')
			},
			queues : {
				get : require('quantum-chat/atlas/queues/atlas.get.js'),
				post : require('quantum-chat/atlas/queues/atlas.post.js'),
				delete : require('quantum-chat/atlas/queues/atlas.delete.js'),
				put : require('quantum-chat/atlas/queues/atlas.put.js')
			}
		};

		/* totem : Api para construir las apps de cliente*/
		var totem = {
			construct : {
				client : {
					get : require ('quantum-chat/totem/construct.client/totem.construct.client.get.js')
				}
			}
		}


		/*** METODOS Atlas API Version ***/
		router.post('/version',atlas.version.post);

		router.get('/version/:id',atlas.version.get)
			  .delete('/version/:id',atlas.version.delete)
			  .put('/version/:id',atlas.version.put);

		/*** METODOS Atlas API User ***/
		router.post('/user',atlas.user.post);

		router.get('/user/:id',atlas.user.get)
			  .delete('/user/:id',atlas.user.delete)
			  .put('/user/:id',atlas.user.put);

		/*** METODOS Atlas API Apps ***/
		router.post('/app',atlas.apps.post);

		router.get('/app/:id',atlas.apps.get)
			  .delete('/app/:id',atlas.apps.delete)
			  .put('/app/:id',atlas.apps.put);

		/*** METODOS Atlas API Companys ***/
		router.post('/company',atlas.companys.post);

		router.get('/company/:id',atlas.companys.get)
			  .delete('/company/:id',atlas.companys.delete)
			  .put('/company/:id',atlas.companys.put);

		/*** METODOS Atlas API Queues ***/
		router.post('/queue',atlas.queues.post);

		router.get('/queue/:id',atlas.queues.get)
			  .delete('/queue/:id',atlas.queues.delete)
			  .put('/queue/:id',atlas.queues.put);


		/*** METODOS Totem API Construct ***/
		router.get('/construct/client/:token',totem.construct.client.get);
	

		app.use(router);
	});
});






