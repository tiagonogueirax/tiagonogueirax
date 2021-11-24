<?php

$l = new Livro();

if (isset($_POST['pesquisa'])) {
	$ls = $l->getLivroByPesquisa($_POST['pesquisa']);
} else {
	$ls = $l->getLivro();
}