<?php
	include 'app/Grimoire/core_inc.php';

	#bloquear não logados

	#verificar permissão de acesso

	$PAGINA['titulo']		= "Atualização";
	$PAGINA['subtitulo']	= "Usuário";
	// $PAGINA['endereco']		= "home.php";

	$user['id']					= '';
	$user['login']				= '';
	$user['email_confirmado']	= '';
	$user['senha']				= '';

	if ( isset($_GET['id']) ) {
		$condicoes = array(
			'id' => $_GET['id']
		);
		$user = localizar('usuario', $condicoes);
	}
?><!DOCTYPE html>
<html lang="<?php echo IDIOMA ?>">
<head>
	<?php include "public/views/frames/metas.php" ?>
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
	<?php include "public/views/frames/header.php" ?>

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
