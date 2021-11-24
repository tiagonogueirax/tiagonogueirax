<?php

class Security {
	private $conx;

	public function __construct() {
		$this->conx = new DataBase();
	}
	
	public function __get($atr) {
		return $this->$atr;
	}
	
	public function __set($atr, $val) {
		$this->$atr = $val;
	}

	function isImage($file) {
	    $mime_type = mime_content_type($file);

	    $allowed_file_types = ['image/png', 'image/jpeg'];

	    if (in_array($mime_type, $allowed_file_types)) {
	        return true;
	    } else {
	    	return false;
	    }
	}

	public function __clone() {
		
	}

	public function __destruct() {
		
	}
}