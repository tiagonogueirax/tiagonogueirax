<?php

class UI {

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

	public function getMainMenu() {
		try {
			$r = $this->conx->prepare('SELECT id, descricao, nivel, alvo FROM menu WHERE nivel = :nivel OR nivel = \'COMUM\'');
			$r->bindValue(':nivel', $_SESSION['nivelUsuario']);
			$r->execute();

			$m = $r->fetchAll(PDO::FETCH_ASSOC);
			
			return $m;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}	

	public function __clone() {
		
	}

	public function __destruct() {
		
	}


}