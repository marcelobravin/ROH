<?php
	include 'app/Grimoire/core_inc.php';


	require 'app/model/database.class.php';

	if ( isset($_GET['modulo']) )
		define('MODULO', $_GET['modulo']);
	else die('Modulo não selecionado');

	$paginacao = paginationCore(MODULO, 3);
?><!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Login - Relatório Ocupação Hospitalar</title>
		<link rel="shortcut icon" type="x-icon" href="public/img/favicon-32x32.png" />

		<link rel="stylesheet" type="text/css" href="public/css/normalize.css">
		<link rel="stylesheet" type="text/css" href="public/css/resets.css">
		<link rel="stylesheet" type="text/css" href="public/css/usuarios.css">
		<link rel="stylesheet" type="text/css" href="public/css/topo.css">
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
		<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>

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
			a[href='#'] { color:red }

		</style>
	</head>
<body>
	<?php require_once 'public/views/frames/header.php' ?>
	<div class="container-tabelas">
		<div>
			<?php echo esvaziarMensagem() ?>
		</div>

		<div class="container-usuario">
			<button>
				<a href="register.php?modulo=<?php echo MODULO ?>">
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
</body>
</html>

<?php require("app\Grimoire\processosFinais.php"); ?>
