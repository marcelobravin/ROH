<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Esqueci a Senha</title>
		<link rel="shortcut icon" type="x-icon" href="public/img/favicon-32x32.png"/>
		<link rel="stylesheet" type="text/css" href="public/css/resets.css">
		<link rel="stylesheet" type="text/css" href="public/css/normalize.css">
		<link rel="stylesheet" type="text/css" href="public/css/esqueci-senha.css">
		<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
	</head>
<body>
	<div class="container-login">
		<img src="public/img/esqueci-senha.png">
		<div class="container-form">
			<form action="app/Controller/PasswordResetController.php" method="post">
				<h1>Trocar Senha</h1>
				<div class="inputs">
					<input type="text" name="email" id="email" value="usuario@email.com" placeholder=" " />
					<label>E-mail</label>
				</div>
				<div class="inputs botao">
					<input type="submit" value="Enviar" disabled/>
				</div>
			</form>
		</div>
	</div>
<script src="public/scripts/esqueci-senha.js"></script>
</body>
</html>
