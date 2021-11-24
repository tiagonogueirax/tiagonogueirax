<?php

$l = new Emprestimo();

$ls = $l->getEmprestimosByUsuarioId($_SESSION['idUsuario']);