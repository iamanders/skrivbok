<?php

	/**
	 * Random helpers
	 */
	class helper {

		/**
		 * Remove expired tokens
		 * Should probably be called from cron
		 */
		public static function remove_expired_tokens() {
			$tokens = Token::all(array('conditions' => array('expires < ?', time())));
			foreach($tokens as $t) {
				$t->delete();
			}
		}


		/**
		 * Validates api token in the http header
		 */
		public static function validate_token($app) {
			$header_api_token = $app->request->headers->get('Api-Token');
			if(!$header_api_token) { $app->halt(403, "no api token"); }

			$token = Token::find_by_token($header_api_token);
			if($token && $token->expires > time()) {
				return true;
			}

			return false;
		}

	}
