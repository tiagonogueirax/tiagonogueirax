<?php $m = $ui->getMainMenu(); ?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/favicons/favicon.ico">

    <title><?=SITE_TITLE?></title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <script>window.jQuery || document.write('<script src="assets/js/jquery-slim.min.js"><\/script>')</script>

    <!-- Custom styles for this template -->
    <link href="assets/css/sticky-footer-navbar.css" rel="stylesheet">

    <!-- Effects -->
    <link href="assets/css/effects.css" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/4df84252ad.js" crossorigin="anonymous"></script>
  </head>

  <body>

    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="<?=URL_HOME?>"><?=SITE_TITLE?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <?php foreach($m as $l) { ?>
            <li class="nav-item"><!--active-->
              <a class="nav-link" href="?p=<?=$l['alvo']?>"><?=$l['descricao']?></a>
            </li>
            <?php } ?>
          </ul>
          <a class="nav-link" href="?p=perfil">Perfil</a>
          <a class="nav-link" href="logoff.php">Sair</a>
        </div>
      </nav>
    </header>
    <!-- Begin page content -->
    <main role="main" class="container">