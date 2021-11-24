<?php

class Auth {

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

	function authUser($user){
	    try {
	        $r = $this->conx->prepare('SELECT id, nome, email, dt_verificacao, dt_cadastro, nivel FROM usuario WHERE email = :email AND senha = sha1(:senha)');
	        $r->bindValue(':email', $user->email);
	        $r->bindValue(':senha', $user->passwd);
	        $r->execute();
	        
	        $u = $r->fetchAll(PDO::FETCH_ASSOC);
	        
	        if (!empty($u)) {
	            return $u[0];
	        } else {
	            return false;
	        }
	    } catch (Exception $e) {
	        return false;
	    }
	}

	public function __clone() {
		
	}

	public function __destruct() {
		
	}
}