<?php

class Livro {

	private $conx;
	private $sec;
	private $nome;
	private $autor;
	private $descricao;
	private $img;

	public function __construct() {
		$this->conx = new DataBase();
		$this->sec = new Security();
	}
	
	public function __get($atr) {
		return $this->$atr;
	}
	
	public function __set($atr, $val) {
		$this->$atr = $val;
	}

	function getLivro(){
		try {
			$r = $this->conx->prepare('
				SELECT a.id, a.nome, a.descricao, a.autor, a.img, a.dt_cadastro cadastro, a.fk_usuario, b.nome usuario FROM livro a 
				INNER JOIN usuario b ON b.id = a.fk_usuario
			');
			$r->execute();

			$l = $r->fetchAll(PDO::FETCH_ASSOC);
			
			return $l;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	function getLivroByPesquisa($nome){
		try {
			$r = $this->conx->prepare('
				SELECT a.id, a.nome, a.descricao, a.autor, a.img, a.dt_cadastro cadastro, a.fk_usuario, b.nome usuario FROM livro a 
				INNER JOIN usuario b ON b.id = a.fk_usuario 
				WHERE a.nome LIKE :nome
			');
			$r->bindValue(':nome', '%'.$nome.'%');
			$r->execute();

			$l = $r->fetchAll(PDO::FETCH_ASSOC);
			
			return $l;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	function getLivroById($id){
		try {
			$r = $this->conx->prepare('
				SELECT a.id, a.nome, a.descricao, a.autor, a.img, a.dt_cadastro cadastro, a.fk_usuario, b.nome usuario FROM livro a 
				INNER JOIN usuario b ON b.id = a.fk_usuario 
				WHERE a.id = :id 
				LIMIT 0, 1
			');
			$r->bindValue(':id', $id);
			$r->execute();

			$l = $r->fetchAll(PDO::FETCH_ASSOC);
			
			return $l[0];
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	function getLivrosByUsuarioId($id){
		try {
			$r = $this->conx->prepare('
				SELECT a.id, a.nome, a.descricao, a.autor, a.img, a.dt_cadastro cadastro, a.fk_usuario, b.nome usuario FROM livro a 
				INNER JOIN usuario b ON b.id = a.fk_usuario 
				WHERE a.fk_usuario = :id
			');
			$r->bindParam(':id', $id);
			$r->execute();

			$l = $r->fetchAll(PDO::FETCH_ASSOC);
			
			return $l;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	function insertLivro(){
		$h = sha1(time());
		$exp = explode('.', $this->img['name']);
		$img = $h . '.' . end($exp);

		try {
			$r = $this->conx->prepare('
				INSERT INTO livro (id, nome, descricao, autor, img, dt_cadastro, fk_usuario) 
				VALUES (null, UPPER(:nome), UPPER(:descricao), UPPER(:autor), :img, SYSDATE(), :idusuario)
			');
			$r->bindParam(':nome', $this->nome);
			$r->bindParam(':descricao', $this->descricao);
			$r->bindParam(':autor', $this->autor);
			$r->bindParam(':img', $img);
			$r->bindParam(':idusuario', $_SESSION['idUsuario']);
			
			if ($this->sec->isImage($this->img['tmp_name']) && move_uploaded_file($this->img['tmp_name'], IMG_UPLOAD.$img) && $r->execute()) {
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