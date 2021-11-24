<?php require('include/controller/emprestimos.php'); ?>

<div class="row">
  <div class="col-md-12">
    <?=$msgbox->inflateMsgBox()?>
  </div>
</div>

<div class="row welcome">
  <div class="col-md-12">
    <h4>Gerenciar Empréstimos</h4>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
        <form class="form-inline" action="" method="POST" style="justify-content: center;">
          <input type="text" class="form-control txt-pesquisa" name="pesquisa" placeholder="Nome do usuário">
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
              <th>Usuário</th>
              <th class="m">Dev. Prevista</th>
              <th class="m">Aprovado</th>
              <th class="m">Dev. Real</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($ls as $r) { ?>
            <tr>
              <td><?=$r['nome']?></td>
              <td><?=$r['usuario']?></td>
              <td class="m"><?=date('d/m/Y', strtotime($r['dt_devprev']))?></td>
              <td class="m"><?=$r['aprovado']?></td>
              <td class="m"><?=date('d/m/Y', strtotime($r['dt_devreal'])) == '01/01/1970' ? '' : date('d/m/Y', strtotime($r['dt_devreal'])) ?></td>
              <td class="text-center">
                <form action="" method="POST">
                  <input type="hidden" name="emprestimo" value="<?=$r['id']?>">
                  <select class="form-control acao" name="acao">
                    <option value="">Ação</option>

                    <?php if ($r['aprovado'] == 'EM ANÁLISE') { ?>
                    <option value="APROVAR">Aprovar</option>
                    <option value="REPROVAR">Reprovar</option>
                    <?php } ?>

                    <?php if ($r['aprovado'] == 'SIM') { ?>
                    <option value="DEVOLVER">Apontar devolução</option>
                    <option value="EXTRAVIO">Apontar extravio</option>
                    <?php } ?>
                  </select>
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
    $('.acao').on('change', function(e){
      $(this).parent().submit();
    });
  })();
</script>