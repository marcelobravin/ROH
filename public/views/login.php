<div class="container-login">
	<img src="public/img/login.png" alt="Usuário observando um sistema computacional">
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

<script src="public/scripts/login.js"></script>
<link rel="stylesheet" type="text/css" href="public/css/login.css">
