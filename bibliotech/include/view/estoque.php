<?php require('include/controller/estoque.php'); ?>

<div class="row">
  <div class="col-md-12">
    <?=$msgbox->inflateMsgBox()?>
  </div>
</div>

<div class="row welcome">
  <div class="col-md-12">
    <h4>Estoque de Livros</h4>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
        <form class="form-inline" action="" method="POST" style="justify-content: center;">
          <input type="text" class="form-control txt-pesquisa" name="pesquisa" placeholder="Nome do livro">
          <button class="btn btn-primary btn-pesquisa" type="submit"><i class="fas fa-search"></i></button>
    </form>
  </div>
</div>

<br>

<div class="row pag-space-bottom">
  <div class="col-md-12">
      <div class="pag-estoque">

        <table class="table table-sm table-hover table-bordered">
          <thead class="thead-dark">
            <tr>
              <th>Livro</th>
              <th class="m">Autor</th>
              <th class="m">Cadastro</th>
              <th class="m">Usuário</th>
              <th class="m">Estoque</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($ls as $r) { ?>
            <tr>
              <td><?=$r['nome']?></td>
              <td class="m"><?=$r['autor']?></td>
              <td class="m"><?=date('d/m/Y', strtotime($r['cadastro']))?></td>
              <td class="m"><?=$r['usuario']?></td>
              <td class="m text-center"><?=$r['estoque']?></td>
              <td class="text-center">
                <form action="" method="POST">
                  <input type="hidden" name="livro" value="<?=$r['id']?>">
                  <input type="hidden" class="tipo" name="tipo" value="">
                  <button type="button" class="btn btn-primary add"><i class="fas fa-plus-circle"></i></button>
                  <input type="number" min="1" oninput="validity.valid||(value='');" class="form-control qtd" name="qtd" style="width:50px; display:inline-block; position:relative; bottom:-2px;" required>
                  <button type="button" class="btn btn-primary minus"><i class="fas fa-minus-circle"></i></button>
                </form>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>

      </div>
  </div>
</div>

<script type="text/javascript">
  (function(){
    $('.add').on('click', function(e){
      $(this).parent().find('.tipo').eq(0).val('add');
      $(this).parent().submit();
    });

    $('.minus').on('click', function(e){
      $(this).parent().find('.tipo').eq(0).val('minus');
      $(this).parent().submit();
    });
  })();
</script>