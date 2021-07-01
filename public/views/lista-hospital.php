<table>
	<tr>
		<th>
			<?php criarLinkOrdenacao("id", "id") ?>
		</th>
		<th>
			<?php criarLinkOrdenacao("titulo", "nome") ?>
		</th>
		<th>Opções</th>
	</tr>

	<?php foreach ($paginacao['listaPaginada'] as $obj) : ?>

		<tr>
			<td><?php echo $obj['id'] ?></td>
			<td><?php echo $obj['titulo'] ?></td>
			<td>
				<button>
					<a href="user-form.php?id=<?php echo $obj['id'] ?>">Editar</a>
				</button>

				<button>
					<a href="app/Controller/DeleteController.php?id=<?php echo $obj['id'] ?>" class="excluir">Excluir</a>
				</button>

				<button>
					<?php if ( $obj['ativo'] ): ?>
						<a href="app/Controller/DeactivateController.php?id=<?php echo $obj['id'] ?>&ativo=0" class="desativar">Desativar</a>
					<?php else: ?>
						<a href="app/Controller/DeactivateController.php?id=<?php echo $obj['id'] ?>&ativo=1" class="desativar">Ativar</a>
					<?php endif ?>
				</button>
			</td>
		</tr>
	<?php endforeach ?>

</table>
