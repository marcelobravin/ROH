<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Reset de Senha - Relatório Ocupação Hospitalar</title>
		<link rel="shortcut icon" type="x-icon" href="public/img/favicon-32x32.png" />
		<link rel="stylesheet" type="text/css" href="public/css/normalize.css">
		<link rel="stylesheet" type="text/css" href="public/css/resets.css">
		<link rel="stylesheet" type="text/css" href="public/css/reset-senha.css">
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
		<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" ></script>

	</head>
<body>

	<div class="container-login">
		<div class="container-form">
			<form action="app/Controller/PasswordUpdateController.php" method="post">
			<!-- <form> -->
				<h1>Esqueci a senha</h1>
				<input type="hidden" name="email" id="email" value="<?php echo $_GET['email'] ?>" />
				<input type="hidden" name="token" id="token" value="<?php echo $_GET['token'] ?>" />

				<div class="inputs">
					<input type="password" name="senha1" id="senha1" value="" autocomplete="current-password" placeholder=" " />
					<label>Nova Senha</label>
					<i class="fas fa-eye"></i>
				</div>
				<div class="inputs">
					<input type="password" name="senha2" id="senha2" value="" placeholder=" " />
					<label>Confirme a senha</label>
				</div>
				<div class="inputs botao">
					<input type="submit" value="Redefinir Senha" disabled />
					<!-- <button id="enviar">Redefinir Senha</button> -->
				</div>
			</form>

		</div>
			<div class="forca-senha">
				<h2>A nova senha deve conter:</h2>

				<ul class="lista-rec">
					<li id="tamanho">
						<i class="fas fa-check"></i>
						<span>Letras maiúsculas</span>
					</li>
					<li id="maiusculas">
						<i class="fas fa-check"></i>
						<span>Letras minúsculas</span>
					</li>
					<li id="minusculas">
						<i class="fas fa-check"></i>
						<span>Números</span>
					</li>
					<li id="numeros">
						<i class="fas fa-check"></i>
						<span>Caracteres especiais</span>
					</li>
					<li id="simbolos">
						<i class="fas fa-check"></i>
						<span>Mínimo de 8 caracteres</span>
					</li>
				</ul>

				<div class="container-prog">
					<span>Força da senha:</span>
		            <div class="barra-prog">

		            </div>
		        </div>

				<!-- <div id="medidorForcaSenha">
					<div data-value="0" id="password-strength-meter">
						<span class="texto-medidor _1">Muito fraca</span>
						<span class="texto-medidor _2">Fraca</span>
						<span class="texto-medidor _3">Médio</span>
						<span class="texto-medidor _4">Forte</span>
						<span class="texto-medidor _5">Muito forte</span>
					</div>
				</div> -->
		</div>
	</div>
<script type="text/javascript" src="public/scripts/reset-senha.js"></script>
<script type="text/javascript" src="public/scripts/sweet-alert.js"></script>

</body>
</html>
