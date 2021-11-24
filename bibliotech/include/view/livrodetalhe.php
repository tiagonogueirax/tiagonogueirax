<?php require('include/controller/livrodetalhe.php'); ?>

<div class="row">
  <div class="col-md-12">
    <?=$msgbox->inflateMsgBox()?>
  </div>
</div>

<div class="row welcome">
  <div class="col-md-12">
    <h4><?=$ls['nome']?></h4>
  </div>
</div>

<div class="row">
  <div class="col-md-6 offset-md-3">
      <div class="pag-livro-detalhe text-center">
      	<img src="<?=IMG_UPLOAD.$ls['img']?>"><br><br>
      	<span class="text-strong">Descrição:</span><br>
        <?=$ls['descricao']?><br><br>
      	<span class="text-strong">Cadastro em:</span> <?=date('d/m/Y', strtotime($ls['cadastro']))?><br>
        <span class="text-strong">Por: </span><?=$ls['usuario']?>
      </div>
  </div>
</div>

<br><br>

<div class="row pag-space-bottom">
  <div class="col-md-12">
  	<div class="text-center">
      <?php if ($empCount < $estCount) { ?>
        <button type="submit" id="btn-emp" class="btn btn-primary">Solicitar Empréstimo</button>
        
        <form action="" id="form-emp" method="POST" class="hide">
          <input type="hidden" name="action" value="emprestimo">
          <input type="hidden" name="livro" value="<?=$_GET['livro']?>">
          Devolução: <input type="date" name="devolucao" required><br><br>
          <button type="submit" class="btn btn-primary">Solicitar Empréstimo</button>
        </form>
      <?php } else { ?>
        <div class="col-md-6 offset-md-3 alert alert-danger" role="alert">
          Ops... Não há exemplares disponíveis no momento :(
        </div>
      <?php } ?>
  	</div>
  </div>
</div>

<script type="text/javascript">
  (function(){
    $('#btn-emp').on('click', function(){
      $(this).hide();
      $('#form-emp').removeClass('hide');
    });
  })();
</script>