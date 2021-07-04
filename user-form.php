<?php
	include 'app/Grimoire/core_inc.php';

	require ROOT.'/app/model/database.class.php';

	$user['id']					= '';
	$user['login']				= '';
	$user['email_confirmado']	= '';
	$user['senha']				= '';

	if ( isset($_GET['id']) ) {
		$db = new Database();
		$condicoes = array(
			'id' => $_GET['id']
		);
		$user = $db->selecionar('usuario', $condicoes);

		if ( sizeof($user) > 0 ) {
			$user = $user[0];
		}
	}
?><!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Login - Relatório Ocupação </title>
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

		<h1><?php echo empty($_GET) ? 'Cadastrar' : 'Atualizar' ?></h1>

		<?php if ( !empty($_GET) ): ?>
			<input type="hidden" name="id" id="id" value="<?php echo $user['id'] ?>" readonly />
		<?php endif ?>

		<label>
			Login
			<br>
			<input type="text" name="login" id="login" value="<?php echo $user['login'] ?>" />
		</label>

		<?php if ( !empty($_GET) ): ?>
			<?php if ( $user['email_confirmado'] ): ?>
				Email confirmado!
			<?php else: ?>
				<a href="app/Controller/ConfirmationController.php?id=<?php echo $user['id'] ?>">Reenviar confirmação de email</a>
			<?php endif ?>
		<?php endif ?>

		<br>

		<?php if ( empty($_GET) ): ?>
			<input type="text" name="senha" id="senha" value="<?php echo $user['senha'] ?>" />
		<?php endif ?>

		<br>

		<input type="submit" value="Atualizar" disabled />
	</form>

</body>
</html>
