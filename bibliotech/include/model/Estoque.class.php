<?php

class Estoque {

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

	function getCountEstoqueByLivroId($id){
		try {
			$r = $this->conx->prepare('SELECT SUM(qtd) cont FROM estoque WHERE fk_livro = :id');
			$r->bindValue(':id', $id);
			$r->execute();

			$l = $r->fetchAll(PDO::FETCH_ASSOC);
			
			return $l[0]['cont'];
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	function getEstoqueByLivro(){
		try {
			$r = $this->conx->prepare('
				SELECT a.id, a.nome, a.autor, a.descricao, a.dt_cadastro cadastro, b.nome usuario, SUM(IFNULL(c.qtd, 0)) estoque FROM livro a
				INNER JOIN usuario b ON b.id = a.fk_usuario
				LEFT JOIN estoque c ON c.fk_livro = a.id
				GROUP BY a.id, a.nome, a.autor, a.descricao, a.dt_cadastro
			');
			$r->execute();

			$l = $r->fetchAll(PDO::FETCH_ASSOC);
			
			return $l;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	function getEstoqueByLivroPesquisa($nome){
		try {
			$r = $this->conx->prepare('
				SELECT a.id, a.nome, a.autor, a.descricao, a.dt_cadastro cadastro, b.nome usuario, SUM(IFNULL(c.qtd, 0)) estoque FROM livro a
				INNER JOIN usuario b ON b.id = a.fk_usuario
				LEFT JOIN estoque c ON c.fk_livro = a.id
				WHERE a.nome LIKE :nome
				GROUP BY a.id, a.nome, a.autor, a.descricao, a.dt_cadastro
			');
			$r->bindValue(':nome', '%'.$nome.'%');
			$r->execute();

			$l = $r->fetchAll(PDO::FETCH_ASSOC);
			
			return $l;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	function insertEstoqueByLivroId($id, $qtd, $tipo){
		if ($tipo == 'minus' && $qtd > 0) {
			$qtd = $qtd * -1;
		}

		try {
			$r = $this->conx->prepare('
				INSERT INTO estoque (id, fk_livro, fk_usuario, qtd, dt_registro) 
				VALUES (null, :fk_livro, :idusuario, :qtd, SYSDATE())
			');
			$r->bindParam(':fk_livro', $id);
			$r->bindParam(':idusuario', $_SESSION['idUsuario']);
			$r->bindParam(':qtd', $qtd);
			
			
			if ($r->execute()) {
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