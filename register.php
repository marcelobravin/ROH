<?php
	include 'app/Grimoire/core_inc.php';

	// require 'app/model/database.class.php'; // para teste


	if ( isset($_GET['modulo']) )
		define('MODULO', $_GET['modulo']);


	// $paginacao = paginationCore(MODULO, 3);
?><!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Login - Relatório Ocupação Hospitalar</title>
		<link rel="shortcut icon" type="x-icon" href="public/img/favicon-32x32.png" />

		<link rel="stylesheet" type="text/css" href="public/css/resets.css">
		<link rel="stylesheet" type="text/css" href="public/css/normalize.css">
		<link rel="stylesheet" type="text/css" href="public/css/metas.css">
		<link rel="stylesheet" type="text/css" href="public/css/topo.css">
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
		<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
	</head>
<body>

	<div class="container-tabelas">

		<a href="app/Controller/LogoutController.php">Logout</a>

		<p>
			<a href="formGenerate.php">Gerar formulário conforme definição do BD</a>
		</p>


		<form action="app/Controller/RegisterController.php?modulo=<?php echo MODULO ?>" method="post">
			<?php require '_arquivos_auto_gerados/views/'.MODULO.'.html' ?>

			<input type="submit" value="CADASTRAR" />
		</form>

	</div>
</body>
</html>
