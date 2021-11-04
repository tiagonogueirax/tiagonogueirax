<?php
session_start();
require('autoload.php');
require('config.php');
require('constants.php');

if (isset($_SESSION['auth']) && $_SESSION['auth'] == true) {
	if (isset($_GET['p'])) {
		require('include/base/header.php');
		require('include/view/' . str_replace(chr(0), '', $_GET['p']) . '.php');
		require('include/base/footer.php');
	} else {
		require('include/base/header.php');
		require('include/view/main.php');
		require('include/base/footer.php');
	}
} else {
	require('include/view/logon.php');
}