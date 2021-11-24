<?php

$u = new User();
$m = new Message();

if (isset($_POST['recup'])) {
	$u->email = $_POST['email'];
	$res = $u->resetPasswdUser();

	if ($res) {
		$m->inflateAlert('Verifique seu email!');
	} else {
		$m->inflateAlert('Erro na recuperação!');
	}
}

