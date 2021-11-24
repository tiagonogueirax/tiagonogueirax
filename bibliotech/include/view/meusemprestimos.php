<?php require('include/controller/meusemprestimos.php'); ?>

<div class="row welcome">
  <div class="col-md-12">
    <h4>Meus Empréstimos</h4>
  </div>
</div>

<div class="row pag-space-bottom">
  <div class="col-md-12">
      <div class="pag-meus-emprestimos">

        <table class="table table-sm table-hover table-bordered">
          <thead class="thead-dark">
            <tr>
              <th>Livro</th>
              <th class="m">Aprovação</th>
              <th class="m">Solicitação</th>
              <th class="m">Dev. Prevista</th>
              <th class="m">Dev. Real</th>
              <th class="m">Extravio</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($ls as $r) { ?>
            <tr>
              <td><?=$r['nome']?></td>
              <td class="m"><?=$r['aprovado']?></td>
              <td class="m"><?=date('d/m/Y', strtotime($r['dt_registro']))?></td>
              <td class="m"><?=date('d/m/Y', strtotime($r['dt_devprev']))?></td>
              <td class="m"><?=$r['dt_devreal']?></td>
              <td class="m"><?=$r['extravio']?></td>
              <td class="text-center">
                <a href="?p=livro-detalhe&livro=<?=$r['id']?>" class="btn btn-primary"><i class="fas fa-eye"></i></a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>

      </div>
  </div>
</div>