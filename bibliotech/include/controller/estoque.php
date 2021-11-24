<?php

$e = new Estoque();
$msgbox = new Message();

if (isset($_POST['livro']) && !empty($_POST['qtd'])) {
	$res = $e->insertEstoqueByLivroId($_POST['livro'], $_POST['qtd'], $_POST['tipo']);

	if ($res) {
		$msgbox->setMsgCodeResult(1002, 'success');
	} else {
		$msgbox->setMsgCodeResult(4002, 'danger');
	}
}

if (isset($_POST['pesquisa'])) {
	$ls = $e->getEstoqueByLivroPesquisa($_POST['pesquisa']);
} else {
	$ls = $e->getEstoqueByLivro();
}