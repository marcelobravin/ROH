<?php
	include 'app/Grimoire/core_inc.php';

	#bloquear não logados

	$PAGINA['titulo']		= "Cadastro";
	$PAGINA['subtitulo']	= "Usuário";
	// $PAGINA['endereco']		= "home.php";

	if ( empty($_GET['modulo']) )
		redirecionar("index.php");

	define('MODULO', $_GET['modulo']);

?><!DOCTYPE html>
<html lang="<?php echo IDIOMA ?>">
<head>
	<?php include "public/views/frames/metas.php" ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
	<style>
		.obrigatorio:before { content: "*"; display: block }
	</style>
</head>
<body>
	<?php include "public/views/frames/header.php" ?>
	<div class="container">
		<h2>Cadastro</h2>

		<form action="app/Controller/RegisterController-<?php echo MODULO ?>.php" method="post">
			<?php #require 'public/views/forms/'.MODULO.'-insercao.html' #---------- prod ?>
			<?php require '_arquivos_auto_gerados/views/'.MODULO.'-insercao.html' #  dev ?>

			<input type="submit" value="CADASTRAR" />
		</form>
	</div>

</body>
</html>
