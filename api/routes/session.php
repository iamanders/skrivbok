<?php

	/**
	 * POST - /session
	 */
	$app->post('/session', function() use ($app) {
		$vars = json_decode($app->request->getBody());

		//Validate data
		//TODO: Better validation
		if(!isset($vars->mail, $vars->password)) { $app->halt('400'); }

		$mail = $vars->mail;
		$password = $vars->password;

		//Remove expired tokens - poor mans cron
		helper::remove_expired_tokens();

		//Find user by mail
		$user = User::find_by_mail($mail);
		if(count($user) < 1) { $app->halt(401, "404 - Wrong mail / password"); }

		//Check password
		if(!password_verify($password, $user->password)) { $app->halt(401, "404 - Wrong mail / password"); }

		//Create token
		//TODO: Check unique tokens!
		$token = new Token();
		$token->user_id = $user->id;
		$token->expires = time() + (3600 * 24 * 90);
		$token->token = sha1(mt_rand());
		$token->save();

		echo json_encode(array('user' => $user->to_array(), 'token' => $token->token));
	});


	/**
	 * DELETE - /session
	 */
	$app->delete('/session', function() use ($app) {
		if(!helper::validate_token($app)) { $app->halt(401, "not authenticated"); }

		//Remove expired tokens - poor mans cron
		helper::remove_expired_tokens();

		//Find and remove the specified one
		$token = Token::find_by_token($app->request->headers->get('Api-Token'));
		if($token) {
			$token->delete();
		}

		echo json_encode(array('result' => 'ok'));
	});
