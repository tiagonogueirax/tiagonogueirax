<?php

class Emprestimo {

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

	public function verifyPenalidadeByUsuario($u) {
		try {
			$r = $this->conx->prepare('SELECT id, fk_livro, fk_usuario, dt_devprev, dt_devreal, aprovado, dt_analise, fk_aprovador, extravio, dt_registro FROM emprestimo WHERE fk_usuario = :usuario AND dt_devreal > dt_devprev ORDER BY dt_registro DESC LIMIT 0, 1');
			$r->bindValue(':usuario', $u);
			$r->execute();

			$e = $r->fetchAll(PDO::FETCH_ASSOC);

			$dif = strtotime($e[0]['dt_devreal']) - strtotime($e[0]['dt_devprev']);
    		$dias = floor($dif / (60 * 60 * 24));

			if ($dias < 10) {
				$proxEmp = strtotime($e[0]['dt_devreal']) + (86400 * 2);
			} else if ($dias > 10 && $dias < 20) {
				$proxEmp = strtotime($e[0]['dt_devreal']) + (86400 * 7);
			} else if ($dias > 20 && $dias < 30) {
				$proxEmp = strtotime($e[0]['dt_devreal']) + (86400 * 14);
			} else if ($dias > 30 && $dias < 40) {
				$proxEmp = strtotime($e[0]['dt_devreal']) + (86400 * 21);
			} else {
				$proxEmp = strtotime($e[0]['dt_devreal']) + (86400 * 28);
			}

			if ($e[0]['extravio'] == 'X') {
				$proxEmp = strtotime($e[0]['dt_devreal']) + (86400 * 30);
			}

			return $proxEmp;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function verifyEmpPendByUsuario($u) {
		try {
			$r = $this->conx->prepare('SELECT id, fk_livro, fk_usuario, dt_devprev, dt_devreal, aprovado, dt_analise, fk_aprovador, extravio, dt_registro FROM emprestimo WHERE fk_usuario = :usuario AND ((aprovado = \'S\' AND dt_devreal IS NULL) OR (aprovado IS NULL))');
			$r->bindValue(':usuario', $u);
			$r->execute();

			$l = $r->fetchAll(PDO::FETCH_ASSOC);
			
			return count($l);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function getCountEmprestimosByLivroId($id){
		try {
			$r = $this->conx->prepare('SELECT COUNT(*) cont FROM emprestimo WHERE fk_livro = :id AND dt_devreal IS NULL AND (aprovado <> \'S\' OR aprovado IS NULL)');
			$r->bindValue(':id', $id);
			$r->execute();

			$l = $r->fetchAll(PDO::FETCH_ASSOC);
			
			return $l[0]['cont'];
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function insertEmprestimo($idLivro, $idUsuario, $dtDevolucao){
		try {
			$r = $this->conx->prepare('INSERT INTO emprestimo (id, fk_livro, fk_usuario, dt_devprev, dt_devreal, aprovado, dt_analise, fk_aprovador) VALUES (null, :idlivro, :idusuario, :dtdevolucao, null, null, null, null)');
			$r->bindParam(':idlivro', $idLivro);
			$r->bindParam(':idusuario', $idUsuario);
			$r->bindValue(':dtdevolucao', $dtDevolucao . ' 23:59:59');
			
			if($r->execute()) {
				return true;
			} else {
				return false;
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function getEmprestimosByUsuarioId($id){
		try {
			$r = $this->conx->prepare('
				SELECT a.id, a.nome, a.descricao, a.autor, a.img, a.dt_cadastro cadastro, a.fk_usuario, b.nome usuario, c.dt_devprev, c.dt_devreal, CASE WHEN c.aprovado = \'S\' THEN \'SIM\' WHEN c.aprovado = \'N\' THEN \'NÃO\' ELSE \'EM ANÁLISE\' END aprovado, c.dt_analise, c.extravio, c.dt_registro FROM livro a 
				INNER JOIN usuario b ON b.id = a.fk_usuario
				INNER JOIN emprestimo c ON c.fk_livro = a.id
				WHERE a.fk_usuario = :id
				LIMIT 0, 50
			');
			$r->bindValue(':id', $id);
			$r->execute();

			$l = $r->fetchAll(PDO::FETCH_ASSOC);
			
			return $l;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function getEmprestimosByUsuario(){
		try {
			$r = $this->conx->prepare('
				SELECT c.id, a.nome, a.descricao, a.autor, a.img, a.dt_cadastro cadastro, a.fk_usuario, b.nome usuario, c.dt_devprev, c.dt_devreal, CASE WHEN c.aprovado = \'S\' THEN \'SIM\' WHEN c.aprovado = \'N\' THEN \'NÃO\' ELSE \'EM ANÁLISE\' END aprovado, c.dt_analise, c.extravio, c.dt_registro FROM livro a 
				INNER JOIN usuario b ON b.id = a.fk_usuario
				INNER JOIN emprestimo c ON c.fk_livro = a.id
				WHERE (c.aprovado = \'S\' AND c.dt_devreal IS NULL) OR (c.aprovado IS NULL)
				ORDER BY c.dt_registro DESC
			');
			$r->execute();

			$l = $r->fetchAll(PDO::FETCH_ASSOC);
			
			return $l;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function getEmprestimosByUsuarioPesquisa($nome){
		try {
			$r = $this->conx->prepare('
				SELECT c.id, a.nome, a.descricao, a.autor, a.img, a.dt_cadastro cadastro, a.fk_usuario, b.nome usuario, c.dt_devprev, c.dt_devreal, CASE WHEN c.aprovado = \'S\' THEN \'SIM\' WHEN c.aprovado = \'N\' THEN \'NÃO\' ELSE \'EM ANÁLISE\' END aprovado, c.dt_analise, c.extravio, c.dt_registro FROM livro a 
				INNER JOIN usuario b ON b.id = a.fk_usuario
				INNER JOIN emprestimo c ON c.fk_livro = a.id
				WHERE (c.aprovado = \'S\' AND c.dt_devreal IS NULL) OR (c.aprovado IS NULL) AND b.nome LIKE :nome
				ORDER BY c.dt_registro DESC
			');
			$r->bindValue(':nome', '%'.$nome.'%');
			$r->execute();

			$l = $r->fetchAll(PDO::FETCH_ASSOC);
			
			return $l;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function updateEmprestimoStatusById($id, $acao){
		try {
			if ($acao == 'APROVAR') {
				$r = $this->conx->prepare('UPDATE emprestimo SET aprovado = \'S\', dt_analise = SYSDATE(), fk_aprovador = :aprovador WHERE id = :id');
				$r->bindParam(':id', $id);
				$r->bindParam(':aprovador', $_SESSION['idUsuario']);
			}

			if ($acao == 'REPROVAR') {
				$r = $this->conx->prepare('UPDATE emprestimo SET aprovado = \'N\', dt_analise = SYSDATE(), fk_aprovador = :aprovador WHERE id = :id');
				$r->bindParam(':id', $id);
				$r->bindParam(':aprovador', $_SESSION['idUsuario']);
			}

			if ($acao == 'DEVOLVER') {
				$r = $this->conx->prepare('UPDATE emprestimo SET dt_devreal = SYSDATE() WHERE id = :id');
				$r->bindParam(':id', $id);
			}

			if ($acao == 'EXTRAVIO') {
				$r = $this->conx->prepare('UPDATE emprestimo SET extravio = \'X\', dt_devreal = SYSDATE() WHERE id = :id');
				$r->bindParam(':id', $id);
			}

			if($r->execute()) {
				return true;
			} else {
				return false;
			}
			
			return $l;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function __clone() {
		
	}

	public function __destruct() {
		
	}
}