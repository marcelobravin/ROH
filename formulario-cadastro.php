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
</head>
<body>
	<?php include "public/views/frames/header.php" ?>

	<a href="app/Controller/LogoutController.php">Logout</a>

	<p>
		<a href="FormGenerate.php">Gerar formulário conforme definição do BD</a>
	</p>


	<form action="app/Controller/RegisterController-<?php echo MODULO ?>.php" method="post">
		<?php require '_arquivos_auto_gerados/views/'.MODULO.'.html' ?>
		<input type="submit" value="CADASTRAR" />
	</form>

</body>
</html>
