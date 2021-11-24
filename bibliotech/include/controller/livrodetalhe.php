<?php
$l = new Livro();
$em = new Emprestimo();
$es = new Estoque();
$msgbox = new Message();

if (isset($_GET['livro'])) {

	if (isset($_POST['action']) && $_POST['action'] == 'emprestimo') {
		if ($em->verifyEmpPendByUsuario($_SESSION['idUsuario']) == 0) {
			
			$proxEmp = $em->verifyPenalidadeByUsuario($_SESSION['idUsuario']);

			if ($proxEmp < strtotime('now')) {
				$res = $em->insertEmprestimo($_GET['livro'], $_SESSION['idUsuario'], $_POST['devolucao']);

				if ($res) {
					$msgbox->setMsgCodeResult(1001, 'success');
				} else {
					$msgbox->setMsgCodeResult(4001, 'danger');
				}
			} else {
				$msgbox->setMsgCodeResult(4005, 'danger', date('d/m/Y', $proxEmp).'!');
			}

		} else {
			$msgbox->setMsgCodeResult(4004, 'danger');
		}

	}

	$ls = $l->getLivroById($_GET['livro']);
	$empCount = $em->getCountEmprestimosByLivroId($_GET['livro']);
	$estCount = $es->getCountEstoqueByLivroId($_GET['livro']);

} else {
	header('Location: index.php');
}