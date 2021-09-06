<link rel="stylesheet" type="text/css" href="public/css/metas.css">
<link rel="stylesheet" type="text/css" href="public/css/resultado.css">

<div class="container">
	<h2><?php echo $PAGINA['titulo'] ?></h2>

	<div class="container-selects">
		<div class="inputs">
			<label for="hospital">Hospital</label>
			<select name="hospital" id="hospital">
				<?php if ( !$hospitalValido ): ?>
					<option value="">Selecione...</option>
				<?php endif ?>
				<?php echo gerarOptionsAA($hospitais, $_GET['hospital']) ?>
			</select>
		</div>

		<?php if ( $hospitalValido ): ?>
			<div class="inputs">
				<label for="categoria">Categoria</label>
				<select name="categoria" id="categoria">
					<?php echo gerarOptionsAA($categorias, $_GET['categoria']) ?>
				</select>
			</div>
		<?php endif ?>
	</div>

	<h3><?php echo $st_mesAtual ?> - <?php echo date('Y') ?></h3>

	<a href="nova-visita.php">Nova Visita</a>

	<div class="container-tabelas">

		<?php if ( !$hospitalValido ): ?>
			Selecione um hospital!
		<?php else: ?>

			<form id="form">

				<?php foreach ($categorias as $v) : ?>

					<div id="bloco-<?php echo $v['id'] ?>" class="invisivel aba">
						<h4><?php echo $v['tituloSanitizado'] ?></h4>

						<table>
							<caption><?php echo $v['legenda'] ?></caption>

							<thead>
								<tr>
									<th scope="Especialidade dos Leitos">Especialidade<br>dos Leitos</th>
									<th scope="Volume de saída">Volume<br>de saída</th>
									<th scope="Percentual">Percentual</th>
									<th scope="Justificativa para a meta não ter sido atingida" title="Preencha para definir uma justificativa para a meta dessa linha não ter sido atingida">Justificativa</th>
								</tr>
							</thead>

							<?php if ( !isset($especialidades[$v['titulo']]) ) : ?>
								<tr>
									<td>Nenhuma definição dessa categoria encontrada para esse hospital!</td>
								</tr>
							<?php else : ?>
								<?php foreach ($especialidades[$v['titulo']] as $e) : ?>
									<tr <?php echo isset($e['resultado']) && isset($e['meta_quantidade']) && $e['resultado'] < $e['meta_quantidade'] ? "class='insuficiente'" : "" ?>>
										<td>
											<?php echo $e['elemento_nome'] ?>
										</td>

										<td>
											<?php if ( !isset($e['meta_quantidade']) ): ?>
												<em>Meta não definida!</em>
												<br>
												<em>
													<a href="metas.php?<?php echo $_SERVER['QUERY_STRING'] ?>&categoria=<?php echo $v['id'] ?>">Definir meta</a>
												</em>

											<?php else: ?>
												<p>
													Meta: <?php echo $e['meta_quantidade'] ?>
												</p>

												<input type="number" min="0" class="quantidade" name="leitos[<?php echo $e['id_meta'] ?>]" id="leitos-<?php echo $e['id_meta'] ?>" title="leitos-<?php echo $e['id_meta'] ?>" data-meta="<?php echo $e['meta_quantidade'] ?>" data-id="<?php echo $e['id_meta'] ?>" value="<?php echo $e['resultado'] ?>" />

											<?php endif ?>
										</td>

										<td>
											<?php if ( isset($e['meta_quantidade']) && isset($e['resultado']) ): ?>
												<?php echo number_format(calcularPorcentagem($e['resultado'], $e['meta_quantidade']), 2) ?>
												%
											<?php endif ?>
										</td>

										<td>
											<?php if ( isset($e['meta_quantidade']) ): ?>
												<?php if ( isset($e['resultado']) ): ?>
													<textarea name="justificativa-<?php echo $e['id_meta'] ?>" id="justificativa-<?php echo $e['id_meta'] ?>" data-id="<?php echo $e['id_meta'] ?>" <?php echo ($e['meta_quantidade'] < $e['resultado']) ? 'disabled' : '' ?>><?php echo $e['justificativa'] ?></textarea>
												<?php else: ?>
													<textarea name="justificativa-<?php echo $e['id_meta'] ?>" id="justificativa-<?php echo $e['id_meta'] ?>" data-id="<?php echo $e['id_meta'] ?>" disabled><?php echo $e['justificativa'] ?></textarea>
												<?php endif ?>
											<?php endif ?>
										</td>
									</tr>
								<?php endforeach ?>
							<?php endif ?>

							<tfoot>
								<tr>
									<td colspan="4">
										<?php echo $v['observacoes'] ?>
									</td>
								</tr>
							</tfoot>
						</table>

					</div>

				<?php endforeach ?>

				<div id="container-botoes">
					<button class="salvarTemporariamente" type="button">
						Salvar
					</button>

					<button class="salvar" type="button">
						Salvar e concluir
					</button>

					<button type="button">
						<a href="comprovante.php?hospital=<?php echo $_GET['hospital'] ?>" target="_blank">
							Gerar Comprovante
						</a>
					</button>
				</div>

			</form>

		<?php endif ?>

	</div>
</div>

<style>
	<?php echo estiloAjaxLoader() ?>
</style>

<script src="public/scripts/redirecionamento.js"></script>

<script src="public/scripts/metas.js"></script>
<script src="public/scripts/resultado.js"></script>

<script src="public/vendors/jquery.mask.min.js"></script>
<script>
	$( ".quantidade" ).keypress(function() {
		$(this).mask('0000');
	});
</script>
