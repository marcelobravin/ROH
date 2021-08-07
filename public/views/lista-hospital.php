<table aria-label="Lista de hospitais">
	<thead>
		<tr>
			<th scope="Coluna id">
				<?php criarLinkOrdenacao("id", "id") ?>
			</th>
			<th scope="Coluna nome">
				<?php criarLinkOrdenacao("titulo", "nome") ?>
			</th>
			<th scope="Coluna opções">Opções</th>
		</tr>
	</thead>

	<?php foreach ($paginacao['listaPaginada'] as $obj) : ?>

		<tr>
			<td><?php echo $obj['id'] ?></td>
			<td><?php echo bloquearXSS($obj['titulo']) ?></td>
			<td>
				<button>
					<a href="formulario-atualizacao.php?modulo=hospital&codigo=<?php echo $obj['id'] ?>">Editar</a>
				</button>

				<button>
					<a href="app/Controller/DeleteController.php?id=<?php echo $obj['id'] ?>&modulo=hospital" class="excluir">Excluir</a>
				</button>
			</td>
		</tr>
	<?php endforeach ?>

</table>
