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


	<div class="container-tabelas">

		<?php if ( !$hospitalValido ): ?>
			Selecione um hospital!
		<?php else: ?>
			<a href="nova-visita.php?hospital=<?php echo exibirIndice('hospital') ?>">Nova Visita</a>
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
