<?php

class User {
	private $name;
	private $email;
	private $level;

	public function __construct() {
		
	}
	
	public function __get($atr) {
		return $this->$atr;
	}
	
	public function __set($atr, $val) {
		$this->$atr = $val;
	}

	public function __clone() {
		
	}

	public function __destruct() {
		
	}


}