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

	</div>

	<h3><?php echo $st_mesAtual ?> - <?php echo date('Y') ?></h3>


	<!-- <div class="container-tabelas"> -->

		<?php if ( !$hospitalValido ): ?>
			Selecione um hospital!
		<?php else: ?>
			<p>
				<a href="visita-nova.php?hospital=<?php echo exibirIndice('hospital') ?>">Nova Visita</a>
			</p>

			<table>
				<?php foreach ($matriz as $v) : ?>
					<tr>
						<td>
							<?php echo preencherZeros($v['dia']) ?>/<?php echo preencherZeros($v['mes']) ?>/<?php echo $v['ano'] ?>
						</td>
						<td>
							<?php echo $v['criado_por'] ?>
							<?php echo $v['id'] ?>
						</td>
						<td>
							<a href="visita-editar.php?id=<?php echo $v['id'] ?>">Editar Visita</a>
						</td>
					</tr>
				<?php endforeach ?>
			</table>
			<?php 	exibir($matriz); ?>
		<?php endif ?>

	<!-- </div> -->
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
