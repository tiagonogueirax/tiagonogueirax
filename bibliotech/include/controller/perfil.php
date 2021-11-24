<?php

$u = new User();
$msgbox = new Message();

if (isset($_POST['edit'])) {
	$u->nome = $_POST['nome'];
	$u->email = $_POST['email'];
	$u->passwd = $_POST['senha'];
	$res = $u->updateUserById();

	if ($res) {
		$msgbox->setMsgCodeResult(1003, 'success');
	} else {
		$msgbox->setMsgCodeResult(4003, 'danger');
	}
}

$user = $u->getDataUserById();