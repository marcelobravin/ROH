<?php
	include 'config.php';

	if ( !isset($_SESSION['user']) )
		redirecionar('index.php');

	include ROOT.'app/Controller/ListController.php';
	require 'app/lib/vetores.php';

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
		<style>
			tr:nth-child(even) { background-color: #ddd }
			td:nth-child(1) { text-align: right; padding-right: 5px }

			table {
				border: 1px outset silver;
				margin-top: 10px;
			}
		</style>
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

		<?php foreach ($users as $u) : ?>
			<tr>
				<td><?php echo $u['id'] ?></td>
				<td><?php echo $u['login'] ?></td>
				<td>

					<button>
						<a href="user-form.php?id=<?php echo $u['id'] ?>">Editar</a>
					</button>

					<button <?php if ($u['id'] == $_SESSION['user']['id']) { echo 'disabled'; } ?>>
						<?php if ($u['id'] == $_SESSION['user']['id']) : ?>
							<span>Excluir</span>
						<?php else: ?>
							<a href="app/Controller/DeleteController.php?id=<?php echo $u['id'] ?>" class="excluir">Excluir</a>
						<?php endif ?>
					</button>

					<button <?php if ($u['id'] == $_SESSION['user']['id']) { echo 'disabled'; } ?>>
						<?php if ($u['id'] == $_SESSION['user']['id']) : ?>
							<?php if ( $u['ativo'] ): ?>
								<span>Desativar</span>
							<?php else: ?>
								<span>Ativar</span>
							<?php endif ?>
						<?php else: ?>
							<?php if ( $u['ativo'] ): ?>
								<a href="app/Controller/DeactivateController.php?id=<?php echo $u['id'] ?>&ativo=0" class="desativar">Desativar</a>
							<?php else: ?>
								<a href="app/Controller/DeactivateController.php?id=<?php echo $u['id'] ?>&ativo=1" class="desativar">Ativar</a>
							<?php endif ?>
						<?php endif ?>
					</button>

				</td>
			</tr>
		<?php endforeach ?>

	</table>
</body>
</html>
