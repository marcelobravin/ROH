<div class="container">
	<h2><?php echo $PAGINA['titulo'] ?></h2>

	<div class="container-selects">
		<div class="inputs">
			<label for="hospital">Hospital</label>
			<select name="hospital" id="hospital">
				<?php if ( !$hospitalValido ): ?>
					<option>Selecione...</option>
				<?php endif ?>
				<?php echo gerarOptionsAA($hospitais, $_GET['hospital']) ?>
			</select>

			<?php if ( $hospitalValido ): ?>
				<label for="ano">Ano</label>
				<select name="ano" id="ano">
					<?php foreach ($anos as $v) : ?>
						<?php if ( !$hospitalValido ): ?>
							<option value="<?php echo $v ?>"><?php echo $v ?></option>
						<?php else: ?>
							<option selected value="<?php echo $v ?>"><?php echo $v ?></option>
						<?php endif ?>
					<?php endforeach ?>
				</select>

				<label for="mes">Mês</label>
				<select name="mes" id="mes">
					<?php echo gerarOptions($meses, $mesSelecionado) ?>
				</select>
			<?php endif ?>

		</div>
	</div>

	<div class="container-tabelas">

		<?php if ( !$hospitalValido ): ?>
			Selecione um hospital!
		<?php else: ?>

			<table aria-label="Tabela de verificação de cumprimento de metas">
				<?php foreach ($categorias as $v) : ?>

					<thead>
						<tr>
							<td colspan="7" class="tituloCategoria">
								<h3>
									<?php echo $v['titulo'] ?>
								</h3>
							</td>
						</tr>

						<tr>
							<td colspan="7">
								<?php echo $v['legenda'] ?>
							</td>
						</tr>

						<tr>
							<th scope="Coluna id">Especialidade<br>dos Leitos</th>
							<th scope="Coluna id">Leitos</th>
							<th scope="Coluna id">Volume<br>de saída</th>
							<th scope="Coluna id" title="Preencha para definir uma justificativa para a meta dessa linha não ter sido atingida">Justificativa</th>
							<th scope="Coluna id" title="Marque essa caixa caso a seja aceitável a justificativa para a meta não ser ter sido atingida">Justificativa<br>Aceita?</th>
							<th scope="Coluna id">Responsável<br>pela vistoria</th>
							<th scope="Coluna id">Data da<br>vistoria</th>
						</tr>
					</thead>

					<?php if ( !isset($especialidades[$v['titulo']]) ) : ?>
						<tr>
							<td colspan="7">
								Nenhuma definição dessa categoria encontrada para esse hospital!
							</td>
						</tr>
					<?php else : ?>
						<?php foreach ($especialidades[$v['titulo']] as $e) : ?>
							<tr>
								<td>
									<?php echo $e['elemento_nome'] ?>
									<input type="hidden" name="especialidadeId" value="<?php echo $e['id_elemento'] ?>" />
								</td>

								<td>
									<?php if ( isset($e['meta_quantidade']) ): ?>
										<?php echo $e['meta_quantidade'] ?>
									<?php else: ?>
										<em>Meta não<br>definida!</em>
									<?php endif ?>
								</td>

								<td>
									<?php if ( isset($e['meta_quantidade']) ): ?>
										<?php if ( isset($e['resultado']) ): ?>
											<span <?php echo $e['resultado'] < $e['meta_quantidade'] ? 'class="insuficiente"' : '' ?>>
												<?php echo $e['resultado'] ?>
											</span>
										<?php else: ?>
											<em>Meta não<br>verificada!</em>
										<?php endif ?>
									<?php else: ?>
										&nbsp;
									<?php endif ?>
								</td>

								<td>
									<?php if ( isset($e['resultado']) ): ?>
										<textarea disabled><?php echo $e['justificativa'] ?></textarea>
									<?php else: ?>
										&nbsp;
									<?php endif ?>
								</td>

								<td>
									<?php if ( isset($e['resultado']) && $e['resultado'] < $e['meta_quantidade'] ): ?>
									<?php #if ( isset($e['justificativa']) ): ?>
										<?php if ( isset($e['justificativa_aceita']) && $e['justificativa_aceita'] ): ?>
											<span class="suficiente">
												Sim
											</span>
										<?php else: ?>
											Não
										<?php endif ?>
									<?php else: ?>
										-
									<?php endif ?>
								</td>

								<td>
									<?php if ( isset($e['autor']) ): ?>
										<a href="lista.php?modulo=usuario&id=<?php echo $e['id_autor'] ?>">
											<?php echo $e['autor'] ?>
										</a>
									<?php endif ?>
								</td>

								<td>
									<?php if ( isset($e['criacao']) ): ?>
										<?php echo converterData( descartarHorario($e['criacao']) ) ?>
									<?php endif ?>
								</td>

							</tr>
						<?php endforeach ?>
					<?php endif ?>

					<tfoot>
						<tr>
							<td colspan="7">
								<?php echo $v['observacoes'] ?>
							</td>
						</tr>
						<tr>
							<td colspan="7">
								&nbsp;
							</td>
						</tr>
					</tfoot>
				<?php endforeach ?>
			</table>

		<?php endif ?>

	</div>

	<?php if ( isset($matriz) ): ?>
		<button>
			<a href="app/Controller/ExportController.php?hospital=<?php echo $_GET['hospital'] ?>&mes=<?php echo $mesSelecionado ?>&ano=<?php echo $anoSelecionado ?>">Exportar</a>
		</button>
	<?php endif ?>
</div>

<script src="public/scripts/relatorio.js"></script>

<link rel="stylesheet" type="text/css" href="public/css/metas.css">
<style>
	textarea {
		resize: none;
		min-width: 310px;
		max-width: 310px;
		min-height:	70px;
	}
	td { border: 1px solid silver; }
	/* table {	border-collapse: collapse; } */
	thead th { background-color: #00dfc0 !important; }
	/* td input,
	td:nth-child(5),
	td:nth-child(4),
	td:nth-child(3),
	td:nth-child(2) { text-align: center } */
	/* tr:nth-child(even){ background-color: #ddd; } */
	.tituloCategoria { text-align: center }
	.insuficiente {
		color: red;
		font-weight: bold;
	}
	.suficiente {
		color: green;
		font-weight: bold;
	}

	#ano > option[value="<?php echo $in_anoAtual ?>"],
	#mes > option[value="<?php echo $in_mesAtual ?>"] {
		font-weight: bold;
	}
	button {
		/* border: 1px solid gray; */
		background-color: #609bf5;
		color: white;
		padding: 10px 30px;
		border-radius: 6px;
		margin: 10px auto;
		display: block;
		margin-top: 20px;
	}

	button:hover {
		/* border: 1px solid silver; */
		text-decoration: underline;
	}
	table {
		margin-top: 0;
	}

	.container-selects {
		margin: 20px 0px 00px;
	}
</style>
