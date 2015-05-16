<?php

	/**
	 * GET - /notes/
	 */
	$app->get('/notes/', function() use ($app) {
		if(!helper::validate_token($app)) { $app->halt(401, "not authenticated"); }

		$notes = helpers::to_array(Note::find('all', array('order' => 'updated_at DESC')));

		echo json_encode(array('notes' => $notes));
	});


	/**
	 * POST - /notes/
	 */
	$app->post('/notes/', function() use ($app) {
		if(!helper::validate_token($app)) { $app->halt(401, "not authenticated"); }

		$vars = json_decode($app->request->getBody());

		//Validate data
		//TODO: Better validation
		if(!isset($vars->note->title, $vars->note->body)) { $app->halt('400'); }

		$note = new Note();
		$note->title = $vars->note->title;
		$note->body = $vars->note->body;
		$note->save();

		echo json_encode(array('note' => $note->to_array()));
	});


	/**
	 * PUT - /notes/
	 */
	$app->put('/notes/:note_id', function($note_id) use ($app) {
		if(!helper::validate_token($app)) { $app->halt(401, "not authenticated"); }

		//Validate data
		//TODO: Better validation
		if(!isset($vars->note->title, $vars->note->body)) { $app->halt('400'); }

		try {
			$note = Note::find($note_id);
		} catch (Exception $e) {
			$app->halt(404, "404");
		}

		$vars = json_decode($app->request->getBody());

		$note->title = $vars->note->title;
		$note->body = $vars->note->body;
		$note->save();

		echo json_encode(array('note' => $note->to_array()));
	})->conditions(array('note_id' => '\d+'));


	/**
	 * GET - /notes/:id
	 */
	$app->get('/notes/:note_id', function($note_id) use ($app) {
		if(!helper::validate_token($app)) { $app->halt(401, "not authenticated"); }

		try {
			$note = Note::find($note_id)->to_array();
		} catch (Exception $e) {
			$app->halt(404, "404");
		}

		echo json_encode(array('note' => $note));
	})->conditions(array('note_id' => '\d+'));


	/**
	 * DELETE - /notes/:id
	 */
	$app->delete('/notes/:note_id', function($note_id) use ($app) {
		if(!helper::validate_token($app)) { $app->halt(401, "not authenticated"); }

		try {
			$note = Note::find($note_id);
			$note->delete();
		} catch (Exception $e) {
			$app->halt(404, "404");
		}

		echo json_encode(array('result' => 'ok'));
	})->conditions(array('note_id' => '\d+'));

