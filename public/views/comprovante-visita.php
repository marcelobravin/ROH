<!DOCTYPE html>
<html lang="<?php echo IDIOMA ?>">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Comprovante de Visita</title>
	<link rel="shortcut icon" type="x-icon" href="../img/download.png" />

	<style>
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
		img {
			width: 470px;
			height: 202px;
			margin: 0 auto;
			display: inline;
		}
		#logo {
			background-image: url(<?php echo imagem64('public/img/Prefeitura-de-Sao-Paulo.jpg') ?>);
			width: 100%;
			height: 184px;
			background-position: center center;
			background-repeat: no-repeat;
			margin: 0;
			margin-bottom: -20px;
			margin-top: -20px;
		}
		.negrito { font-weight: bold; }
	</style>
</head>
<body>
	<div class="centralizado" id="logo"></div>

	<h1>Comprovante de Visita</h1>

	<p>
		<strong>Hospital:</strong>
		<?php echo $hospital['titulo'] ?>
		<br>
		<strong>CNES:</strong>
		<?php echo $hospital['cnes'] ?>
		<br>
		<strong>Diretor:</strong>
		<?php echo $hospital['diretor'] ?>
		<br>
		<strong>Responsável Técnico:</strong>
		<?php echo $hospital['segundo_responsavel'] ?>
		<p>
			<strong>Visitante(a):</strong>
			<?php echo $vistoriador['nome'] ?>
		</p>
	</p>

	<table class="larguraTotal">
		<caption>
			<?php echo $st_mesAtual ?> de <?php echo date('Y') ?>
		</caption>
		<tr>
			<th scope="Coluna id">Categoria</th>
			<th scope="Coluna id">Especialidade</th>
			<th scope="Coluna id">Meta</th>
			<th scope="Coluna id">Resultado</th>
			<th scope="Coluna id">Visita</th>
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
				Visitante:
				<hr>
			</div>
		</div>
	</div>

	<p class="alinhadoDireita ">
		<span class="negrito">
			Emissão do comprovante:
		</span>
		<?php echo agora(true) ?>
	</p>
</body>
</html>
