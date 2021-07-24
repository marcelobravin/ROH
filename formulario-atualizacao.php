<?php
	include 'app/Grimoire/core_inc.php';

	$PAGINA['titulo']		= "Atualização";
	$PAGINA['subtitulo']	= "Hospitais";
	// $PAGINA['endereco']		= "home.php";

	if ( !isset($_GET['modulo']) )
		die("modulo invalido");

	if ( !isset($_GET['codigo']) )
		die("codigo invalido");


	define('MODULO', $_GET['modulo']);
	$condicoes = array(
		'id' => $_GET['codigo']
	);
	$obj = localizar(MODULO, $condicoes);

	if ( empty($obj) )
		die("Objeto não encontrado");

?><!DOCTYPE html>
<html lang="<?php echo IDIOMA ?>">
<head>
	<?php include "public/views/frames/metas.php" ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
	<style>
		label {
			display: block;
			margin-top: 15px;
		}
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
