<?php
	include 'app/Grimoire/core_inc.php';

	#bloquear não logados

	if ( empty($_GET['modulo']) )
		redirecionar("index.php");

	define('MODULO', $_GET['modulo']);
	$PAGINA['titulo']		= "Lista";
	$PAGINA['subtitulo']	= MODULO;
	// $PAGINA['endereco']		= "home.php";

	$paginacao = paginationCore(MODULO, 3);
?>
<!DOCTYPE html>
<html lang="<?php echo IDIOMA ?>" <?php echo PRODUCAO ? "" : 'class="ambiente_desenvolvimento"' ?>>
	<head>
		<?php include "public/views/frames/metas.php" ?>
		<link rel="stylesheet" type="text/css" href="public/css/usuarios.css">
	</head>
<body>
	<?php require_once 'public/views/frames/header.php' ?>
	<div class="container-tabelas">
		<div class="<?php echo isset($_SESSION['mensagemClasse']) ? $_SESSION['mensagemClasse'] : "" ?>">
			<?php echo esvaziarMensagem() ?>
		</div>

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
</body>
</html>
