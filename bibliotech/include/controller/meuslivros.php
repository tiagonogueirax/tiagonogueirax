<?php

$l = new Livro();

$ls = $l->getLivrosByUsuarioId($_SESSION['idUsuario']);