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
var database = require('Quantum/database.js'),
	ipDatabase = database;

/* Applicacion */
var colors = require('colors');
var appConfig = require('Quantum/config.js').appConfig;

	
/* Express Router */
var router = express.Router();


ipDatabase.__construct({
	server : '172.18.53.240',
	base : 'Quantum_test',
	schema : {
		rewrite : false
	}
});

ipDatabase.startConnection(function(){

	app.listen(appConfig.port,function(){
		console.log(colors.magenta('Node Server API Rest corriendo en el puerto '+appConfig.port));
		var atlas = {
			version : {
				get : require('Quantum/atlas/version/atlas.get.js'),
				post : require('Quantum/atlas/version/atlas.post.js'),
				delete : require('Quantum/atlas/version/atlas.delete.js'),
				put : require('Quantum/atlas/version/atlas.put.js')
			},
			user : {
				get : require('Quantum/atlas/user/atlas.get.js'),
				post : require('Quantum/atlas/user/atlas.post.js'),
				delete : require('Quantum/atlas/user/atlas.delete.js'),
				put : require('Quantum/atlas/user/atlas.put.js')
			}
		};

		/*** METODOS API Version ***/
		router.post('/version',atlas.version.post);

		router.get('/version/:id',atlas.version.get)
			  .delete('/version/:id',atlas.version.delete)
			  .put('/version/:id',atlas.version.put);

		/*** METODOS API Version ***/
		router.post('/user',atlas.user.post);

		router.get('/user/:id',atlas.user.get)
			  .delete('/user/:id',atlas.user.delete)
			  .put('/user/:id',atlas.user.put);
	

		app.use(router);
	});
});






