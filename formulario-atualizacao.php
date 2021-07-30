<?php
	include 'app/Grimoire/core_inc.php';

	$PAGINA['titulo']		= "Atualização";
	$PAGINA['subtitulo']	= "Hospitais";

	if ( !isset($_GET['modulo']) ) {
		die("modulo invalido");
	}

	if ( !isset($_GET['codigo']) ) {
		die("codigo invalido");
	}


	define('MODULO', $_GET['modulo']);
	$condicoes = array(
		'id' => $_GET['codigo']
	);
	$obj = localizar(MODULO, $condicoes);

	if ( empty($obj) ) {
		die("Objeto não encontrado");
	}

?><!DOCTYPE html>
<html lang="<?php echo IDIOMA ?>">
<head>
	<?php include "public/views/frames/metas.php" ?>
	<script src="public/vendors/jquery.mask.min.js"></script>
	<style>
		label {
			display: block;
		}
		label[for] {
			margin-top: 15px;
		}

		form {
			display: block;
			margin: 0 auto;
		}
		h2 { text-align: center;}
		[type="checkbox"],
		[type="radio"] { margin-left: 10px; }
	</style>
</head>
<body>
	<?php include "public/views/frames/header.php" ?>

	<div class="container">
		<div class="<?php echo isset($_SESSION['mensagemClasse']) ? $_SESSION['mensagemClasse'] : "" ?>">
			<?php echo esvaziarMensagem() ?>
		</div>
		<h2>Atualização</h2>

		<form action="app/Controller/UpdateController-<?php echo MODULO ?>.php" method="post">
			<?php #require 'public/views/forms/'.MODULO.'-atualizacao.php'  #--- prod ?>
			<?php require '_arquivos_auto_gerados/views/'.MODULO.'-atualizacao.php' #  dev ?>

			<input type="submit" value="ATUALIZAR" />
		</form>
	</div>
</body>
</html>
