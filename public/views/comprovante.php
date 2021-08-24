<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Comprovante de Visita</title>
	<link rel="shortcut icon" type="x-icon" href="../img/download.png" />
	<style>
		/* html { background-color: black; } */
		body {
			/* width: 220mm;
			height: 297mm;
			background: white;
			margin: 30px auto; */
		}
		table {
			width: 100%;
			border-collapse: collapse;
		}
		.assinatura {
			width: 100%;
			margin: 0;
			text-align: left;
		}

		.margemInferior {
			margin-bottom: 60px;
		}

		hr { border-bottom: 1px solid black; }
		h1 { text-align: center }
		tr:nth-child(even) { background-color: #ddd; }
		.centralizado { text-align: center; }
		.alinhadoDireita { text-align: right; }
		.coluna {
			width: 300px;
			display: inline-block;
			margin: 0px 23px;
		}

		.containerColunas { margin-top: 90px }
		.larguraTotal { width: 100% }
	</style>
</head>
<body>
	<!-- <img src="<?php echo BASE_HTTP ?>public/img/prefeitura-cidade-de-sao-paulo-vector-logo.png" alt="<?php echo BASE_HTTP ?>public/img/prefeitura-cidade-de-sao-paulo-vector-logo.png"> -->
	<img src="public/img/Prefeitura-de-Sao-Paulo.jpg" alt="public/img/Prefeitura-de-Sao-Paulo.jpg">

	<h1>Comprovante de Vistoria</h1>

	<table class="larguraTotal">
		<caption>
			<?php echo $hospital['titulo'] ?>
			<br>
			<?php echo $st_mesAtual ?> de <?php echo date('Y') ?>
		</caption>
		<tr>
			<th scope="Coluna id">Categoria</th>
			<th scope="Coluna id">Especialidade</th>
			<th scope="Coluna id">Meta</th>
			<th scope="Coluna id">Resultado</th>
			<th scope="Coluna id">Vistoria</th>
		</tr>

		<?php foreach ($matriz as $v) : ?>
			<tr>
				<td><?php echo $v['categoria_nome'] ?></td>
				<td><?php echo $v['elemento_nome'] ?></td>
				<td class="centralizado"><?php echo isset($v['meta_quantidade']) ? $v['meta_quantidade'] : "" ?></td>
				<td class="centralizado"><?php echo isset($v['resultado']) ? $v['resultado'] : "" ?></td>
				<td class="centralizado"><?php echo isset($v['resultado_criacao']) ? converterTimestamp($v['resultado_criacao'], true, true) : "" ?></td>
			</tr>
		<?php endforeach ?>
	</table>

	<hr>
	<!-- Data da visita: <?php echo hoje(true) ?> -->

	<h3>Responsáveis Técnicos</h3>
	<div class="containerColunas">

		<div class="coluna">
			<div class="assinatura margemInferior">
				Médico(a):
				<hr>
			</div>
			<div class="assinatura">
				Enfermagem:
				<hr>
			</div>
		</div>

		<div class="coluna alinhadoDireita">
			<div class="assinatura margemInferior">
				TI:
				<hr>
			</div>
			<div class="assinatura">
				Vistoriador(a):
				<hr>
			</div>
		</div>
	</div>

	<p class="alinhadoDireita">Emissão do comprovante: <?php echo agora(true) ?></p>
</body>
</html>
