<!DOCTYPE html>
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

	<form action="app/Controller/LoginController.php" method="post">
		<h1>Login</h1>
		<input type="text" name="login" id="login" value="usuario@email.com" />
		<input type="text" name="senha" id="senha" value="senha123" />
		<input type="submit" value="entrar" disabled />
	</form>

</body>
</html>
