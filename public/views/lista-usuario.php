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
				<button <?php if ($obj['id'] == $_SESSION['user']['id']) { echo 'disabled'; } ?>>
					<?php if ($obj['id'] == $_SESSION['user']['id']) : ?>
						<?php if ( $obj['ativo'] ): ?>
							<span>Desativar</span>
						<?php else: ?>
							<span>Ativar</span>
						<?php endif ?>
					<?php else: ?>
						<?php if ( $obj['ativo'] ): ?>
							<a href="app/Controller/DeactivateController.php?id=<?php echo $obj['id'] ?>&ativo=0&modulo=usuario" class="desativar">Desativar</a>
						<?php else: ?>
							<a href="app/Controller/DeactivateController.php?id=<?php echo $obj['id'] ?>&ativo=1&modulo=usuario" class="desativar">Ativar</a>
						<?php endif ?>
					<?php endif ?>
				</button>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>
