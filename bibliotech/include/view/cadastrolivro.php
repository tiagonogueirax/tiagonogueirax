<?php require('include/controller/cadastrolivro.php'); ?>

<div class="row">
  <div class="col-md-12">
    <?=$msgbox->inflateMsgBox()?>
  </div>
</div>

<div class="row welcome">
  <div class="col-md-12">
    <h4>Novo Livro</h4>
  </div>
</div>

<div class="row pag-space-bottom">
  <div class="col-md-12">
    <div class="pag-cadastro-livro">
    	<form action="" enctype="multipart/form-data" method="POST">
    		<input type="hidden" name="cadastro" value="1">
    		<div class="form-group col-md-6 offset-md-3">
    			<label class="full-width">Título<input type="text" class="form-control" name="nome" required></label>
    		</div>
    		<div class="form-group col-md-6 offset-md-3">
    			<label class="full-width">Autor<input type="text" class="form-control" name="autor" required></label>
    		</div>
    		<div class="form-group col-md-6 offset-md-3">
    			<label class="full-width">Descrição Breve<input type="text" class="form-control" name="descricao" required></label>
    		</div>
    		<div class="form-group col-md-6 offset-md-3">
    			<label class="full-width">Imagem de Capa<input type="file" class="form-control" name="img" required></label>
    		</div>
    		<div class="form-group col-md-6 offset-md-3">
    			<button class="btn btn-primary" type="submit">Cadastrar</button>
    			<button class="btn btn-danger" type="reset">Cancelar</button>
    		</div>
    	</form>
    </div>
  </div>
</div>