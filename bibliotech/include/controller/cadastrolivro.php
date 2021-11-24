<?php

$l = new Livro();
$msgbox = new Message();

if (isset($_POST['cadastro'])) {
	$l->nome = $_POST['nome'];
	$l->autor = $_POST['autor'];
	$l->descricao = $_POST['descricao'];
	$l->img = $_FILES['img'];
	$res = $l->insertLivro();

	if ($res) {
		$msgbox->setMsgCodeResult(1002, 'success');
	} else {
		$msgbox->setMsgCodeResult(4002, 'danger');
	}
}