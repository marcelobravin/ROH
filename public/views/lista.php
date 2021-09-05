<link rel="stylesheet" type="text/css" href="public/css/lista.css">

<div class="container-tabelas">

	<div style="text-align: right">
		<button>
			<a href="formulario-cadastro.php?modulo=<?php echo MODULO ?>">
				+ <?php echo ucwords(MODULO) ?>
			</a>
		</button>
	</div>


	<form method="get">
		<?php #selecaoResultadosPorPagina() ?>

		<?php filtroPaginacao() ?>
	</form>


	<div>
		<p class="resultados">
			<?php paginacaoHeader( $paginacao['registros'] ) ?>
		</p>

		<?php require 'public/views/lista-'.MODULO.'.php' ?>

		<p class="resultados">
			<?php registrosExibidos( $paginacao ) ?>
		</p>

		<div class="navegacao-pag">
			<?php echo implode('&nbsp;&nbsp;', $paginacao['links']) ?>
		</div>
	</div>

</div>

<script src="public/scripts/exclusao.js"></script>
