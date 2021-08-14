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

	<div class="container-tabelas">

		<?php if ( !$hospitalValido ): ?>
			Selecione um hospital!
		<?php else: ?>

			<form>

				<?php foreach ($categorias as $v) : ?>
					<div id="bloco-<?php echo $v['id'] ?>" class="invisivel aba">
						<h4><?php echo $v['titulo'] ?></h4>

						<table>
							<caption><?php echo $v['legenda'] ?></caption>

							<thead>
								<tr>
									<th scope="Especialidade dos Leitos">Especialidade<br>dos Leitos</th>
									<th scope="Volume de saída">Volume<br>de saída</th>
									<th scope="Justificativa para a meta não ter sido atingida" title="Preencha para definir uma justificativa para a meta dessa linha não ter sido atingida">Justificativa</th>
									<th scope="Justificativa Aceita?" title="Marque essa caixa caso a seja aceitável a justificativa para a meta não ser ter sido atingida">Justificativa<br>Aceita?</th>
								</tr>
							</thead>

							<?php if ( !isset($especialidades[$v['titulo']]) ) : ?>
								<tr>
									<td colspan="4">Nenhuma definição dessa categoria encontrada para esse hospital!</td>
								</tr>
							<?php else : ?>
								<?php foreach ($especialidades[$v['titulo']] as $e) : ?>
									<tr <?php echo isset($e['resultado']) && isset($e['meta_quantidade']) && $e['resultado'] < $e['meta_quantidade'] ? "class='insuficiente'" : "" ?>>
										<td>
											<?php echo $e['elemento_nome'] ?>
										</td>

										<td>

												<p>
													Meta: <?php echo $e['meta_quantidade'] ?>
												</p>

												<?php if ( isset($e['resultado']) ): ?>
													<input type="text" disabled value="<?php echo $e['resultado'] ?>" />
												<?php else: ?>
													<em>Meta não preenchida!</em>
												<?php endif ?>

										</td>

										<td>
											<?php if ( isset($e['meta_quantidade']) ): ?>
												<?php if ( isset($e['resultado']) ): ?>
													<?php if ( $e['resultado'] < $e['meta_quantidade'] ): ?>
														<textarea disabled><?php echo $e['justificativa'] ?></textarea>
													<?php endif ?>
												<?php endif ?>
											<?php endif ?>
										</td>

										<td>
												<?php if ( isset($e['resultado']) ): ?>
													<?php if ( $e['resultado'] < $e['meta_quantidade'] ): ?>
														<?php if ( !empty($e['justificativa']) ): ?>
															<input type="checkbox" <?php echo $e['justificativa_aceita'] ? "checked" : "" ?> />
														<?php endif ?>
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

						<button class="salvarTemporariamente" type="button">
							Salvar temporariamente os dados dessa categoria
						</button>

					</div>

				<?php endforeach ?>

				<button class="salvar" type="button">
					Registrar Resultados
				</button>
			</form>
		<?php endif ?>

	</div>
</div>

<link rel="stylesheet" type="text/css" href="public/css/metas.css">


<script src="public/scripts/redirecionamento.js"></script>
<script src="public/scripts/relatorio.js"></script>

<script src="public/scripts/metas.js"></script>
<script src="public/scripts/justificativa.js"></script>
<style>
	textarea {
		resize: none;
		min-width: 310px;
		max-width: 310px;

		min-height:	70px;
	}
	.insuficiente {
		background-color: #ffb8b8 !important
	}

	.salvar {
		background-color: #609bf5 !important;
	}

	button { /* remover css redundante */
		background-color: #60f59b;
		color: white;
		padding: 10px 30px;
		border-radius: 6px;
		margin: 0 auto;
		display: block;
		margin-top: 20px;
	}

	<?php echo estiloAjaxLoader() ?>
</style>
