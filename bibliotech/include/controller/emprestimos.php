<?php

$e = new Emprestimo();
$msgbox = new Message();

if (isset($_POST['emprestimo'])) {
	$res = $e->updateEmprestimoStatusById($_POST['emprestimo'], $_POST['acao']);

	if ($res) {
		$msgbox->setMsgCodeResult(1003, 'success');
	} else {
		$msgbox->setMsgCodeResult(4003, 'danger');
	}
}

if (isset($_POST['pesquisa'])) {
	$ls = $e->getEmprestimosByUsuarioPesquisa($_POST['pesquisa']);
} else {
	$ls = $e->getEmprestimosByUsuario();
}