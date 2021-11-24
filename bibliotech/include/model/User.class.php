<?php

class User {

	private $conx;
	private $nome;
	private $email;
	private $passwd;
	private $nivel;

	public function __construct() {
		$this->conx = new DataBase();
	}
	
	public function __get($atr) {
		return $this->$atr;
	}
	
	public function __set($atr, $val) {
		$this->$atr = $val;
	}

	public function getDataUserById() {
		try {
			$r = $this->conx->prepare('SELECT id, nome, email, senha, dt_verificacao, dt_cadastro, nivel FROM usuario WHERE id = :id');
			$r->bindValue(':id', $_SESSION['idUsuario']);
			$r->execute();

			$u = $r->fetchAll(PDO::FETCH_ASSOC);
			
			return $u[0];
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function updateUserById() {		
		try {
			$this->conx->beginTransaction();

			if (!empty($this->nome)) {
				$r = $this->conx->prepare('UPDATE usuario SET nome = UPPER(:nome) WHERE id = :usuario');
				$r->bindParam(':nome', $this->nome);
				$r->bindParam(':usuario', $_SESSION['idUsuario']);
				$r->execute();
			}

			if (!empty($this->email)) {
				$r = $this->conx->prepare('UPDATE usuario SET email = LOWER(:email) WHERE id = :usuario');
				$r->bindParam(':email', $this->email);
				$r->bindParam(':usuario', $_SESSION['idUsuario']);
				$r->execute();				
			}

			if (!empty($this->passwd)) {
				$r = $this->conx->prepare('UPDATE usuario SET senha = :senha WHERE id = :usuario');
				$r->bindValue(':senha', sha1($this->passwd));
				$r->bindParam(':usuario', $_SESSION['idUsuario']);
				$r->execute();				
			}

			if($this->conx->commit()) {
				return true;
			} else {
				$this->conx->rollBack();
				return false;
			}
		} catch (Exception $e) {
			$this->conx->rollBack();
			echo $e->getMessage();
		}
	}

	public function insertUser() {		
		try {
			$r = $this->conx->prepare('
				INSERT INTO usuario (id, nome, email, senha, dt_verificacao, dt_cadastro, nivel)
				VALUES (null, UPPER(:nome), LOWER(:email), :senha, null, SYSDATE(), :nivel)
			');
			$r->bindParam(':nome', $this->nome);
			$r->bindParam(':email', $this->email);
			$r->bindValue(':senha', sha1($this->passwd));
			$r->bindValue(':nivel', 'COMUM');

			if($r->execute()) {
				return true;
			} else {
				return false;
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function resetPasswdUser() {
		try {
			$pass = substr(sha1(time()), 0, 6);

			$r = $this->conx->prepare('UPDATE usuario SET senha = :senha WHERE email = :email');
			$r->bindParam(':email', $this->email);
			$r->bindValue(':senha', $pass);

		    $from = 'admin@bibliotech.org';
		    $to = $this->email;
		    $subject = 'Alteracao de Senha';
		    $message = 'Sua nova senha é: ' . $pass;
		    $headers = "From:" . $from;
		    mail($to, $subject, $message, $headers);

			if($r->execute()) {
				return true;
			} else {
				return false;
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function __clone() {
		
	}

	public function __destruct() {
		
	}
}