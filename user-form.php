<?php
	include 'config.php';

	require ROOT.'/model/database.class.php';

	$db = new Database();

	$condicoes = array(
		'id' => $_GET['id']
	);
	$user = $db->selecionar('usuarios', $condicoes);
	$user = $user[0];

?><!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Login - Relatório Ocupação Hospitalar</title>
		<link rel="shortcut icon" type="x-icon" href="public/img/favicon-32x32.png" />
		<link rel="stylesheet" type="text/css" href="">
		<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
		<!-- <script src='js/lib/jquery-3.3.1.js?j=$r'></script> -->
		<script>
			$(document).on( "change, keyup, mousemove", "input", function(){
				check()
			})

			function check() {
				if (
					$("#login").val() == ''
					||
					$("#senha").val() == ''
				) {
					$(":submit").attr("disabled", "disabled")
				} else {
					$(":submit").removeAttr("disabled")
				}
			}
		</script>
	</head>
<body>

	<form action="app/Controller/UpdateController.php" method="post">
		<?php if ( empty($_GET) ): ?>
			<h1>Cadastrar</h1>
		<?php else: ?>
			<h1>Atualizar</h1>
		<?php endif ?>
		<input type="text" name="id"	id="id"		value="<?php echo $user['id'] ?>" />
		<input type="text" name="login" id="login"	value="<?php echo $user['login'] ?>" />

		<?php if ( empty($_GET) ): ?>
			<input type="text" name="senha" id="senha"	value="<?php echo $user['senha'] ?>" />
		<?php endif ?>

		<a href="app/Controller/ConfirmationController.php?id=<?php echo $_GET['id'] ?>">Reenviar confirmação de email</a>

		<input type="submit" value="Atualizar" disabled />
	</form>

</body>
</html>
