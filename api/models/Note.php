<?php

	class Note extends ActiveRecord\Model {
		static $before_create = array('before_create_callback'); # new records only
 		static $before_save = array('before_save_callback'); # new OR updated records

 		public function before_create_callback() {
 			$this->created_at = time();
 		}

 		public function before_save_callback() {
 			$this->updated_at = time();
 		}

	}
