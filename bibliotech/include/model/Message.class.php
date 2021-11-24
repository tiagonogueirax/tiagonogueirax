<?php

class Message {

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

	public function setMsgCodeResult($codigo, $tipo, $arg = '') {
		$box = '<div class="alert alert-%tipo% alert-dismissible fade show">%msg%<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button></div>';
		
		try {
			$r = $this->conx->prepare('SELECT id, codigo, mensagem FROM msgbox WHERE codigo = :codigo');
			$r->bindParam(':codigo', $codigo);
			$r->execute();

			$m = $r->fetchAll(PDO::FETCH_ASSOC);

			$box = str_replace(array('%tipo%', '%msg%'), array($tipo, $m[0]['mensagem'] . $arg), $box);

			$_SESSION['MSGBOX'] = $box;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function inflateAlert($t) {
		$box = '<script>alert("' . $t . '");</script>';
		echo $box;
	}

	function inflateMsgBox(){
		echo $_SESSION['MSGBOX'];
		$_SESSION['MSGBOX'] = '';
	}

	public function __clone() {
		
	}

	public function __destruct() {
		
	}
}