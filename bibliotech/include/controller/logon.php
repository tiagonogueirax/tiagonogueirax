<?php

if (!empty($_POST['email']) && !empty($_POST['senha'])) {
	$p = isset($_GET['p']) ? $_GET['p'] : '';

	$user = new User();
	$user->email = $_POST['email'];
	$user->passwd = $_POST['senha'];

	$auth = new Auth();

	if ($data = $auth->authUser($user)) {
		$_SESSION['auth'] = true;
		
		$_SESSION['idUsuario']  = $data['id'];
		$_SESSION['nomeUsuario']  = $data['nome'];
		$_SESSION['emailUsuario'] = $data['email'];
		$_SESSION['nivelUsuario'] = $data['nivel'];
		$_SESSION['MSGBOX'] = '';

		if ($p == '') {
			header('Location: ' . URL_HOME);
		} else {
			header('Location: ' . URL_HOME . '/?p=' . $p);
		}
	} else {
		
	}
}