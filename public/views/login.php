<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Login - Relatório Ocupação Hospitalar</title>
		<link rel="shortcut icon" type="x-icon" href="public/img/favicon-32x32.png" />
		<link rel="stylesheet" type="text/css" href="public/css/normalize.css">
		<link rel="stylesheet" type="text/css" href="public/css/resets.css">
		<link rel="stylesheet" type="text/css" href="public/css/login.css">
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
		<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
	</head>
<body>
	<div class="container-login">
		<img src="public/img/login.png">
		<div class="container-form">
			<form action="app/Controller/LoginController.php" method="post">
				<h1>Ocupação Hospitalar</h1>
				<div class="inputs">
					<input type="text" name="login" id="login" value="usuario@email.com" placeholder=" " />
					<label> Usuário </label>
				</div>
				<div class="inputs">
					<input type="password" name="senha" id="senha" value="12345678" placeholder=" " />
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

<?php require("app\Grimoire\processosFinais.php"); ?>
