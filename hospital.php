<?php
	include 'config.php';

	require 'model/database.class.php'; // para teste
	require 'app/Controller/paginacao.php';

	// $db  = new Database();

	$resultadosPorPagina = definirExibicao();
	$paginacao = paginationCore ('hospital', $resultadosPorPagina, 3);
?><!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Login - Relatório Ocupação Hospitalar</title>
		<link rel="shortcut icon" type="x-icon" href="public/img/favicon-32x32.png" />

		<link rel="stylesheet" type="text/css" href="public/css/resets.css">
		<link rel="stylesheet" type="text/css" href="public/css/normalize.css">
		<link rel="stylesheet" type="text/css" href="public/css/metas.css">
		<link rel="stylesheet" type="text/css" href="public/css/topo.css">
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
		<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>

		<script>
			$(document).ready(function(){
				$(".excluir").click(function(){
					return confirm("Tem certeza que deseja excluir esse usuário?")
				})
			})
		</script>
		<style>
			tbody tr,
			tbody tr td {
				text-align: center;
				height: 20px !important;
			}
			.centralizar { text-align: center }
		</style>
	</head>
<body>

	<div class="container-tabelas">

		<a href="app/Controller/LogoutController.php">Logout</a>

		<div>
			<?php echo esvaziarMensagem() ?>
		</div>


		<button>
			<a href="register.html">
				Adicionar Novo Hospital
			</a>
		</button>

		<?php paginacaoHeader ($paginacao['registros']) ?>

		<?php selecaoResultadosPorPagina(1) ?>

		<table>
			<tr>
				<th>
					<?php criarLinkOrdenacao("id", "id") ?>
				</th>
				<th>
					<?php criarLinkOrdenacao("titulo", "nome") ?>
				</th>
				<th>Opções</th>
			</tr>

			<?php foreach ($paginacao['listaPaginada'] as $obj) : ?>

				<tr>
					<td><?php echo $obj['id'] ?></td>
					<td><?php echo $obj['titulo'] ?></td>
					<td>
						<button>
							<a href="user-form.php?id=<?php echo $obj['id'] ?>">Editar</a>
						</button>

						<button>
							<a href="app/Controller/DeleteController.php?id=<?php echo $obj['id'] ?>" class="excluir">Excluir</a>
						</button>

						<button>
							<?php if ( $obj['ativo'] ): ?>
								<a href="app/Controller/DeactivateController.php?id=<?php echo $obj['id'] ?>&ativo=0" class="desativar">Desativar</a>
							<?php else: ?>
								<a href="app/Controller/DeactivateController.php?id=<?php echo $obj['id'] ?>&ativo=1" class="desativar">Ativar</a>
							<?php endif ?>
						</button>
					</td>
				</tr>
			<?php endforeach ?>

		</table>

		<div class="centralizar">
			<?php echo implode('  ', $paginacao['links']) ?>
		</div>

	</div>
</body>
</html>
