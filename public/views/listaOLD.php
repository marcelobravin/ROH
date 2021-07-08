<link rel="stylesheet" type="text/css" href="public/css/usuarios.css">
<link rel="stylesheet" type="text/css" href="public/css/topo.css">

<script>
	$(document).ready(function(){
		$(".excluir").click(function(){
			return confirm("Tem certeza que deseja excluir esse registro?")
		})
	})
</script>
<style>
	tbody tr,
	tbody tr td {
		text-align: center;
		height: 20px !important;
	}
	.centralizar { text-align: center }
</style>

<?php #srequire_once 'public/views/frames/header.php' ?>
<div class="container-tabelas fdfdfdff">
	<div>
		<?php echo esvaziarMensagem() ?>
	</div>

	<div class="container-usuario">
		<button>
			<a href="formulario-cadastro.php?modulo=<?php echo MODULO ?>">
				+ <?php echo MODULO ?>
			</a>
		</button>
	</div>

	<div>
		<?php echo esvaziarMensagem() ?>
	</div>

	<?php paginacaoHeader( $paginacao['registros'] ) ?>

	<?php selecaoResultadosPorPagina( $paginacao ) ?>

	<?php require 'public/views/lista-'.MODULO.'.php' ?>

	<div class="centralizar">
		<?php echo implode('&nbsp;&nbsp;', $paginacao['links']) ?>
	</div>

</div>
<script type="text/javascript" src="public/scripts/usuarios.js"></script>
