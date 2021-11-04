<?php require('include/controller/logon.php'); ?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/favicon.ico">

    <title><?=SITE_TITLE?></title>

    <!--<link rel="canonical" href="">-->

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" method="post" action="">
      <img class="mb-4" src="assets/img/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal"><?=SITE_TITLE?></h1>
      <label for="inputEmail" class="sr-only">E-mail</label>
      <input type="email" id="inputEmail" class="form-control" name="email" placeholder="exemplo@exemplo.com" required autofocus>
      <label for="inputPassword" class="sr-only">Senha</label>
      <input type="password" id="inputPassword" class="form-control" name="senha" placeholder="*******" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      <br>
      <div class="checkbox mb-3">
        <label>
          <a href="">Não tenho uma conta</a><br>
      	  <a href="">Esqueci minha senha</a>
        </label>
      </div>
      <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
    </form>
  </body>
</html>