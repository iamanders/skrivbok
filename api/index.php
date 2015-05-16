<?php
	require('config.php');
	require('vendor/Slim/Slim.php');
	require_once('vendor/php-activerecord/ActiveRecord.php');
	require_once('helpers.php');

	//Active record
	ActiveRecord\Config::initialize(function($config) {
		$config->set_model_directory('models');
		$config->set_connections(array('development' => CONFIG_DB));
	});

	//Slim
	\Slim\Slim::registerAutoloader();
	$app = new \Slim\Slim();
	$app->contentType('application/json');

	//Lib
	require('lib/helper.php');

	//Models
	require('models/Note.php');
	require('models/User.php');
	require('models/Token.php');

	//Routes
	require('routes/session.php');
	require('routes/note.php');

	//Run!
	$app->run();
