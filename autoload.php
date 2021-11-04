<?php
function __autoload($class) {
	require_once 'include/model/'.$class.'.class.php';
}