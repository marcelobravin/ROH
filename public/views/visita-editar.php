<link rel="stylesheet" type="text/css" href="public/css/metas.css">
<link rel="stylesheet" type="text/css" href="public/css/resultado.css">

<div class="container">
	<h2><?php echo $PAGINA['titulo'] ?></h2>
<br>
	<h3><?php echo $hospital['titulo'] ?></h3>
	<h4><?php echo $in_diaAtual ?> de <?php echo $st_mesAtual ?> - <?php echo date('Y') ?></h4>

	<a href="visita.php?hospital=<?php echo $_GET['hospital'] ?>">Voltar</a>


	<?php #exibir($matriz) ?>
	<div class="container-tabelas">

		<input type="hidden" value="<?php echo $in_diaAtual ?>" id="dia">
		<input type="hidden" value="<?php echo $in_mesAtual ?>" id="mes">
		<input type="hidden" value="<?php echo $in_anoAtual ?>" id="ano">

		<form id="form">

			<table>
				<thead>
					<tr>
						<th scope="Categoria dos Leitos">Categoria</th>
						<th scope="Especialidade dos Leitos">Especialidade<br>dos Leitos</th>
						<th scope="Volume de saída">Volume<br>de saída</th>
						<th scope="Percentual">Percentual</th>
						<th scope="Justificativa para a meta não ter sido atingida" title="Preencha para definir uma justificativa para a meta dessa linha não ter sido atingida">Justificativa</th>
						<th scope="Visitante">Visitante</th>
					</tr>
				</thead>

				<?php foreach ($matriz as $v) : ?>

					<tr <?php echo isset($v['resultado']) && isset($v['quantidade']) && $v['resultado'] < $v['quantidade'] ? "class='insuficiente'" : "" ?>>
						<td>
							<?php echo $v['titulo_categoria'] ?>
						</td>

						<td>
							<?php echo $v['titulo_elemento'] ?>
						</td>

						<td>
							<?php if ( !isset($v['quantidade']) ): ?>
								<em>Meta não definida!</em>
								<br>
								<em>
									<a href="metas.php?<?php echo $_SERVER['QUERY_STRING'] ?>&categoria=<?php echo $v['id'] ?>">Definir meta</a>
								</em>

							<?php else: ?>
								<p>
									Meta: <?php echo $v['quantidade'] ?>
								</p>

								<input type="number" min="0" class="quantidade" name="leitos[<?php echo $v['id_meta'] ?>]" id="leitos-<?php echo $v['id_meta'] ?>" title="leitos-<?php echo $v['id_meta'] ?>" data-meta="<?php echo $v['quantidade'] ?>" data-id="<?php echo $v['id_meta'] ?>" value="<?php echo $v['resultado'] ?>" />

							<?php endif ?>
						</td>

						<td>
							<?php if ( isset($v['quantidade']) && isset($v['resultado']) ): ?>
								<?php echo number_format(calcularPorcentagem($v['resultado'], $v['quantidade']), 2) ?>
								%
							<?php endif ?>
						</td>

						<td>
							<textarea name="justificativa-<?php echo $v['id_meta'] ?>" id="justificativa-<?php echo $v['id_meta'] ?>" data-id="<?php echo $v['id_meta'] ?>"><?php echo $v['justificativa'] ?></textarea>
						</td>

						<td>
							<?php if ( empty($v['in_atualizado_por']) ): ?>
								<a href="formulario-atualizacao.php?modulo=usuario&codigo=<?php echo $v['in_criado_por'] ?>">
									<?php echo $v['st_criado_por'] ?>
								</a>
							<?php else: ?>
								<a href="formulario-atualizacao.php?modulo=usuario&codigo=<?php echo $v['in_atualizado_por'] ?>">
									<?php echo $v['st_atualizado_por'] ?>
								</a>
							<?php endif ?>
						</td>
					</tr>
					<?php endforeach ?>
				</table>

			<div id="container-botoes">
				<button class="salvar" type="button">
					Salvar e concluir
				</button>

				<button type="button">
					<a href="comprovante.php?dia=1" target="_blank">
						Gerar Comprovante
					</a>
				</button>
			</div>

		</form>

	</div>
</div>

<style>
	<?php echo estiloAjaxLoader() ?>
</style>

<script src="public/scripts/redirecionamento.js"></script>

<script src="public/scripts/metas.js"></script>
<script src="public/scripts/visita-editar.js"></script>

<script src="public/vendors/jquery.mask.min.js"></script>
<script>
	$( ".quantidade" ).keypress(function() {
		$(this).mask('0000');
	});
</script>
