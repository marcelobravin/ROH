<table id="usuarios" class="display" style="width:100%">
	<thead>
		<tr>
			<th>Usuário</th>
			<th>ID</th>
			<th>Opções</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($paginacao['listaPaginada'] as $obj) : ?>
		<tr>
			<td><?php echo $obj['id'] ?></td>
			<td><?php echo $obj['login'] ?></td>
			<td>
				<button>
					<!--a href="user-form.php?id=<?php echo $obj['id'] ?>">Editar</a-->
					<a href="formulario-atualizacao.php?modulo=usuario&codigo=<?php echo $obj['id'] ?>">Editar</a>
				</button>
				<button <?php if ($obj['id'] == $_SESSION['user']['id']) { echo 'disabled'; } ?>>
					<?php if ($obj['id'] == $_SESSION['user']['id']) : ?>
						<span>Excluir</span>
					<?php else: ?>
						<a href="app/Controller/DeleteController.php?id=<?php echo $obj['id'] ?>&modulo=usuario" class="excluir">Excluir</a>
					<?php endif ?>
				</button>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>
