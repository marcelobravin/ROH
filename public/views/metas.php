<div class="container">
	<h2>Definição de metas</h2>

	<div class="container-selects">
		<div class="inputs">
			<label for="hospital">Hospital</label>
			<select name="hospital" id="hospital">
				<?php if ( !$hospitalValido ) : ?>
					<option>Selecione...</option>
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

	<div class="container-tabelas">

		<?php if ( !$hospitalValido ): ?>
			Selecione um hospital!
		<?php else: ?>

			<?php foreach ($categorias as $v) : ?>

				<form action="app/Controller/DefineTarget.php" method="post" id="bloco-<?php echo $v['id'] ?>" class="invisivel aba" <?php echo $hospitalValido ? "" : "disabled" ?>>

					<input type="hidden" name="hospital" value="<?php echo $_GET['hospital'] ?>" class="hospitalSelecionado" />

					<input type="hidden" name="id_categoria" id="id_categoria-<?php echo $v['id'] ?>" value="<?php echo $v['id'] ?>" />

					<?php $especialidades = selecionar("elemento", array('id_categoria'=>$v['id']), "ORDER BY titulo") ?>

					<table id="metas">

						<caption><?php echo $v['legenda'] ?></caption>

						<thead>
							<tr>
								<th scope="Especialidades">Especialidade<br>dos Leitos</th>
								<th scope="Aplicável" title="Essa instituição realiza esse tipo de atendimento?">Aplicável?</th>
								<th scope="Leitos">Leitos</th>
							</tr>
						</thead>

						<?php foreach ($especialidades as $e) : ?>

							<?php
								# localiza metas estabelecidas para essa especialidade
								$cond = array(
									'id_hospital' => isset($_GET['hospital']) ? $_GET['hospital'] : 0,
									'id_elemento' => $e['id']
								);
								$meta = localizar("meta", $cond);

								if ( empty( $meta ) ) {
									$meta['ativo'] = 0;
									$meta['quantidade'] = 0;
								}
							?>

							<tr>
								<td>
									<?php echo $e['titulo'] ?>
									<input type="hidden" name="especialidadeId" value="<?php echo $e['id'] ?>" />
								</td>
								<td><input type="checkbox" name="checkbox-<?php echo $e['id'] ?>" id="checkbox-<?php echo $e['id'] ?>" value="1" <?php echo checked($meta['ativo']) ?> /></td>
								<td><input type="text" name="leitos[<?php echo $e['id'] ?>]" id="leitos-<?php echo $e['id'] ?>" value="<?php echo $meta['quantidade'] ?>" /></td>
							</tr>
						<?php endforeach ?>

						<tfoot>
							<tr>
								<td colspan="4">
									<?php echo $v['observacoes'] ?>
								</td>
							</tr>
						</tfoot>
					</table>
					<input type="submit" value="Atualizar Metas" />
				</form>

			<?php endforeach ?>
		<?php endif ?>

	</div>
</div>

<script src="public/scripts/metas.js"></script>

<link rel="stylesheet" type="text/css" href="public/css/metas.css">
