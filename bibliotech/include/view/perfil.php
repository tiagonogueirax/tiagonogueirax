<?php require('include/controller/perfil.php'); ?>

<div class="row">
  <div class="col-md-12">
    <?=$msgbox->inflateMsgBox()?>
  </div>
</div>

<div class="row welcome">
  <div class="col-md-12">
    <h4>Meu Perfil</h4>
  </div>
</div>

<div class="row pag-space-bottom">
  <div class="col-md-12">
    <div class="pag-cadastro-livro">
    	<form action="" method="POST">
    		<input type="hidden" name="edit" value="1">
    		<div class="form-group col-md-6 offset-md-3">
    			<label class="full-width">Nome<input type="text" class="form-control" name="nome" value="" placeholder="<?=$user['nome']?>"></label>
    		</div>
    		<div class="form-group col-md-6 offset-md-3">
    			<label class="full-width">E-mail<input type="email" class="form-control" name="email" value="" placeholder="<?=$user['email']?>"></label>
    		</div>
    		<div class="form-group col-md-6 offset-md-3">
    			<label class="full-width">Senha<input type="password" class="form-control" name="senha" value="" placeholder="************"></label>
    		</div>
    		<div class="form-group col-md-6 offset-md-3">
    			<button class="btn btn-primary" type="submit">Atualizar</button>
    			<button class="btn btn-danger" type="reset">Cancelar</button>
    		</div>
    	</form>
    </div>
  </div>
</div>