<?php

class DataBase extends PDO {
	private $server = 'localhost';
	private $base = 'bibliotech';
	private $user = 'root';
	private $passwd = '12345678';

	public function __construct() {
		try {
		    $conx = parent::__construct('mysql:host='.$this->server.';dbname='.$this->base, $this->user, $this->passwd, array(PDO::ATTR_TIMEOUT => 999, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			return $conx;
		} catch (PDOException $e){
			//foreach(PDO::getAvailableDrivers() as $driver) echo $driver, '<br>';
			header ('Content-type: text/html; charset=UTF-8');
			exit('<h3>Erro de conexão com o Banco de Dados!</h3>' . $e->getMessage());
		}
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