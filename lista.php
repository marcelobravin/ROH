<?php
	include 'config.php';

	require 'model/database.class.php'; // para teste

	require 'app/lib/paginacao.php';
	require 'app/lib/html.php';
	require 'app/lib/vetores.php';

	if ( isset($_GET['modulo']) )
		define('MODULO', $_GET['modulo']);


	$paginacao = paginationCore(MODULO, 3);
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

		<script>
			$(document).ready(function(){
				$(".excluir").click(function(){
					return confirm("Tem certeza que deseja excluir esse usuário?")
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
	</head>
<body>

	<div class="container-tabelas">

		<a href="app/Controller/LogoutController.php">Logout</a>

		<div>
			<?php echo esvaziarMensagem() ?>
		</div>


		<button>
			<a href="register.html">
			<a href="register-<?php echo MODULO ?>.php">
				Adicionar Novo <?php echo MODULO ?>
			</a>
		</button>

		<?php paginacaoHeader( $paginacao['registros'] ) ?>

		<?php selecaoResultadosPorPagina( $paginacao ) ?>

		<?php require 'public/views/lista-'.MODULO.'.php' ?>

		<div class="centralizar">
			<?php echo implode('&nbsp;&nbsp;', $paginacao['links']) ?>
		</div>

	</div>
</body>
</html>
