<?php
	include 'config.php';

	include ROOT.'app/Controller/ListController.php';
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
			$(document).ready(function(){
				$(".excluir").click(function(){
					return confirm("Tem certeza que deseja excluir esse usuário?")
				})
			})
		</script>
	</head>
<body>
	<a href="app/Controller/LogoutController.php">Logout</a>

	<div>
		<?php echo esvaziarMensagem() ?>
	</div>

	<button>
		<a href="register.html">
			Adicionar Novo Usuário
		</a>
	</button>

	<table>
		<tr>
			<th>Usuário</th>
			<th>Id</th>
			<th>Opções</th>
		</tr>

		<?php foreach ($users as $user) : ?>
			<tr>
				<td><?php echo $user['id'] ?></td>
				<td><?php echo $user['login'] ?></td>
				<td>
					<button <?php if ($user['id'] == $_SESSION['user']['id']) { echo 'disabled'; } ?>>
						<?php if ($user['id'] == $_SESSION['user']['id']) : ?>
							<a href="#">Excluir</a>
						<?php else: ?>
							<a href="app/Controller/DeleteController.php?id=<?php echo $user['id'] ?>" class="excluir">Excluir</a>
						<?php endif ?>
					</button>
					<button>
						<a href="user-form.php?id=<?php echo $user['id'] ?>">Editar</a>
					</button>
					<button>
						<a href="app/Controller/DeactivateController.php?id=<?php echo $user['id'] ?>" class="desativar">Desativar</a>
					</button>
				</td>
			</tr>
		<?php endforeach ?>

	</table>




</body>
</html>
