<?php require('include/controller/main.php'); ?>

<div class="row welcome">
  <div class="col-md-12">
    <h4>Bem vindo, o que você gostaria de fazer?</h4>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
      <div class="menu-main">
        
        <?php foreach($m as $r) { ?>
          <a href="?p=<?=$r['alvo']?>" class="menu-btn hvr-float-shadow">
            <div class="icon">
              <i class="fas fa-stroopwafel"></i>
            </div>
            <div class="text">
              <?=$r['descricao']?>
            </div>
          </a>
        <?php } ?>

      </div>
  </div>
</div>