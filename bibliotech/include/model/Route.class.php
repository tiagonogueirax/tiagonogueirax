<?php

class Route {

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

	function getRoute($p){
		$p = str_replace(chr(0), '', $p);

	    switch ($p) {
	    	case 'emprestimos':
	    		return 'emprestimos.php';
	    		break;
	    	case 'usuarios':
	    		return 'usuarios.php';
	    		break;
	    	case 'consultar-livros':
	    		return 'consultalivros.php';
	    		break;
	    	case 'meus-livros':
	    		return 'meuslivros.php';
	    		break;
	    	case 'meus-emprestimos':
	    		return 'meusemprestimos.php';
	    		break;
			case 'livro-detalhe':
	    		return 'livrodetalhe.php';
	    		break;
			case 'cadastro-livro':
	    		return 'cadastrolivro.php';
	    		break;
			case 'estoque':
	    		return 'estoque.php';
	    		break;
	    	case 'perfil':
	    		return 'perfil.php';
	    		break;
	    	default:
	    		return 'main.php';
	    		break;
	    }
	}

	public function __clone() {
		
	}

	public function __destruct() {
		
	}
}