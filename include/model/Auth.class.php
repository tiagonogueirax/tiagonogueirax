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
	        $rs = $this->conx->prepare('SELECT * FROM usuario WHERE email = :email AND senha = sha1(:senha)');
	        $rs->bindValue(':email', $user->email);
	        $rs->bindValue(':senha', $user->passwd);
	        $rs->execute();
	        $rs = $rs->fetchAll(PDO::FETCH_ASSOC);
	        
	        if (!empty($rs)) {
	            return $rs[0];
	        } else {
	            return false;
	        }
	    } catch (PDOException $e) {
	        //echo $e->getMessage();
	        return false;
	        $_SESSION['ALERT_DIALOG'] = array(REG_QUERY_ERR, ALERT_DANGER);
	    }
	}

	public function __clone() {
		
	}

	public function __destruct() {
		
	}
}