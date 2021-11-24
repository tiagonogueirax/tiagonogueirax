<?php
session_start();
require('autoload.php');
require('config.php');

$ui = new UI();
$r = new Route();

if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
	if (isset($_GET['p'])) {
		require('include/base/header.php');
		require('include/view/' . $r->getRoute($_GET['p']));
		require('include/base/footer.php');
	} else {
		require('include/base/header.php');
		require('include/view/main.php');
		require('include/base/footer.php');
	}
} else if (isset($_GET['cadastrar'])) {
	require('include/view/cadastro.php');
} else if (isset($_GET['redefinir'])) {
	require('include/view/redefinicao.php');
} else {
	require('include/view/logon.php');
}