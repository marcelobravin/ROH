<!DOCTYPE html>
<html lang="<?php echo IDIOMA ?>" <?php echo PRODUCAO ? "" : 'class="ambiente_desenvolvimento"' ?>>
	<head>
		<?php include "public/views/frames/metas.php" ?>
		<link rel="stylesheet" type="text/css" href="public/css/login.css">
	</head>
<body>
	<div class="container-login">
		<img src="public/img/login.png">
		<div class="container-form">
			<form action="app/Controller/LoginController.php" method="post">
				<h1>Ocupação Hospitalar</h1>
				<div class="inputs">
					<input type="text" name="login" id="login" />
					<label> Usuário </label>
				</div>
				<div class="inputs">
					<input type="password" name="senha" id="senha" />
					<label> Senha </label>
					<i class="fas fa-eye"></i>
				</div>
				<div class="inputs botao">
					<input type="submit" value="entrar" disabled />
					<a href="esqueci-a-senha.php">Esqueci a senha</a>
				</div>
			</form>
		</div>
	</div>

	<script type="text/javascript" src="public/scripts/login.js"></script>
</body>
</html>
