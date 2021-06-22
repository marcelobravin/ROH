<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Reset de Senha - Relatório Ocupação Hospitalar</title>
		<link rel="shortcut icon" type="x-icon" href="public/img/favicon-32x32.png" />
		<link rel="stylesheet" type="text/css" href="">
		<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
		<!-- <script src='js/lib/jquery-3.3.1.js?j=$r'></script> -->
		<script>
			$(document).on("change, keyup", "input", function(){
				check()
			})

			function check() {
				if (
					(
						$("#senha1").val() != ''
						&&
						$("#senha2").val() != ''
					) &&
					$("#senha1").val() == $("#senha2").val()
				) {
					$(":submit").removeAttr("disabled")
				} else {
					$(":submit").attr("disabled", "disabled")
				}
			}

			function validateEmail(email) {
				var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				return re.test(email);
			}

			function CheckPassword(inputtxt) {
				var decimal = /^(?=.\d)(?=.[a-z])(?=.[A-Z])(?=.[^a-zA-Z0-9])(?!.*\s).{8,20}$/;
				if( decimal.test(inputtxt) ) {
					return true;
				} else {
					return false;
				}
			}


			// The password is at least 8 characters long
			function has8Chars (str) {
				var patt = /^.{8,}$/;
				return patt.test(str);
			}
			// The password has at least one uppercase letter
			function hasUpper (str) {
				var patt = /[A-Z]/;
				return patt.test(str);
			}
			// The password has at least one lowercase letter
			function hasLower (str) {
				var patt = /[a-z]/;
				return patt.test(str);
			}
			// The password has at least one digit
			function hasNumber (str) {
				var patt = /[0-9]/;
				return patt.test(str);
			}
			// The password has at least one special character ([^A-Za-z0-9]).
			function hasSymbol (str) {
				var patt = /[-!$%^&*()_+|~=`{}\[\]:";'<>?,.\/]/;
				// var patt = /^(?=.[^a-zA-Z0-9])(?!.*\s)$/;
				return patt.test(str);
			}

			function validatePasswordStrenght (str) {
				if ( has8Chars(str)) { $("#tamanho").addClass("validado")    } else { $("#tamanho").removeClass("validado")    }
				if ( hasUpper(str) ) { $("#maiusculas").addClass("validado") } else { $("#maiusculas").removeClass("validado") }
				if ( hasLower(str) ) { $("#minusculas").addClass("validado") } else { $("#minusculas").removeClass("validado") }
				if ( hasNumber(str)) { $("#numeros").addClass("validado")    } else { $("#numeros").removeClass("validado")    }
				if ( hasSymbol(str)) { $("#simbolos").addClass("validado")   } else { $("#simbolos").removeClass("validado")   }
			}

			$(document).ready(function(){
				$("#senha1").keyup(function(){
					validatePasswordStrenght( $(this).val() )
				});

				$("#reveal").click(function(){
					if ( $(this).attr("src") == "public/img/eye-view.png") {
						$(this).attr("src", "public/img/eye-hide.png")
						$(":password").attr("type", "text")
					} else {
						$(this).attr("src", "public/img/eye-view.png")
						$(":text").attr("type", "password")
					}
				})
			});

		</script>
		<style>
			.validado { color: green}
		</style>
	</head>
<body>

	<form action="app/Controller/PasswordUpdateController.php" method="post">
		<input type="hidden" name="email" id="email" value="<?php echo $_GET['email'] ?>" />
		<h1>Esqueci a senha</h1>
		<p>
			<label>
				Nova Senha
				<br>
				<input type="password" name="senha1" id="senha1" value="" />
			</label>
			<img src="public/img/eye-view.png" alt="" id="reveal">
		</p>

		<p>
			<label>
				Confirme a senha
				<br>
				<input type="password" name="senha2" id="senha2" value="" />
			</label>
		</p>


		<input type="submit" value="Redefinir Senha" disabled />
	</form>


	<p>A nova senha deve conter:</p>

	<ul>
		<li id="tamanho">Mínimo de 8 caracteres</li>
		<li id="maiusculas">Letras maiúsculas</li>
		<li id="minusculas">Letras minúsculas</li>
		<li id="numeros">Números</li>
		<li id="simbolos">Caracteres especiais</li>
	</ul>

</body>
</html>
