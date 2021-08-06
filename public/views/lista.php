<div class="container-tabelas">

	<div class="controle">
		<div class="container-usuario">
			<button>
				<a href="formulario-cadastro.php?modulo=<?php echo MODULO ?>">
					+ <?php echo ucwords(MODULO) ?>
				</a>
			</button>
		</div>

		<span class="resultados">
			<?php paginacaoHeader( $paginacao['registros'] ) ?>
		</span>
		<div class="paginacao">
			<?php selecaoResultadosPorPagina( $paginacao ) ?>
		</div>
	</div>

	<?php require 'public/views/lista-'.MODULO.'.php' ?>

	<div class="navegacao-pag">
		<?php echo implode('&nbsp;&nbsp;', $paginacao['links']) ?>
	</div>

</div>

<script src="public/scripts/exclusao.js"></script>
<link rel="stylesheet" type="text/css" href="public/css/usuarios.css">
<style>
	span.numero { text-decoration: underline; }
</style>
