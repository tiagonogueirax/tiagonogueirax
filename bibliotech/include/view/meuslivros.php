<?php require('include/controller/meuslivros.php'); ?>

<div class="row welcome">
  <div class="col-md-12">
    <h4>Meus Livros</h4>
  </div>
</div>

<div class="row pag-space-bottom">
  <div class="col-md-12">
      <div class="pag-meus-livros">
      	<a href="?p=cadastro-livro" class="btn btn-primary cad-livro">Cadastrar Novo</a>
      	<br><br>
      	<table class="table table-sm table-hover table-bordered">
      		<thead class="thead-dark">
      			<tr>
	      			<th>Livro</th>
	      			<th class="m">Autor</th>
	      			<th class="m">Cadastro</th>
	      			<th class="m">Usuário</th>
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