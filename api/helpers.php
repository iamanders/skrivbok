<?php

	class helpers {

		public static function to_array($result) {
			$array = array();
			foreach($result as $row) { $array[] = $row->to_array(); }
			return $array;
		}

	}