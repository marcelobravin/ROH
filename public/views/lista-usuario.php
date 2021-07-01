<table>
	<tr>
		<th>Usuário</th>
		<th>Id</th>
		<th>Opções</th>
	</tr>

	<?php foreach ($paginacao['listaPaginada'] as $obj) : ?>

		<tr>
			<td><?php echo $obj['id'] ?></td>
			<td><?php echo $obj['login'] ?></td>
			<td>

				<button>
					<a href="user-form.php?id=<?php echo $obj['id'] ?>">Editar</a>
				</button>

				<button <?php if ($obj['id'] == $_SESSION['user']['id']) { echo 'disabled'; } ?>>
					<?php if ($obj['id'] == $_SESSION['user']['id']) : ?>
						<span>Excluir</span>
					<?php else: ?>
						<a href="app/Controller/DeleteController.php?id=<?php echo $obj['id'] ?>" class="excluir">Excluir</a>
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
							<a href="app/Controller/DeactivateController.php?id=<?php echo $obj['id'] ?>&ativo=0" class="desativar">Desativar</a>
						<?php else: ?>
							<a href="app/Controller/DeactivateController.php?id=<?php echo $obj['id'] ?>&ativo=1" class="desativar">Ativar</a>
						<?php endif ?>
					<?php endif ?>
				</button>

			</td>
		</tr>
	<?php endforeach ?>

</table>
