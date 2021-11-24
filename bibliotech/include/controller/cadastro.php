<?php

$u = new User();
$m = new Message();

if (isset($_POST['edit'])) {
	$u->nome = $_POST['nome'];
	$u->email = $_POST['email'];
	$u->passwd = $_POST['passwd'];
	$res = $u->insertUser();

	if ($res) {
		$m->inflateAlert('Cadastro realizado com sucesso!');
	} else {
		$m->inflateAlert('Erro no cadastro!');
	}
}

