<?php
	include 'app/Grimoire/core_inc.php';

	$PAGINA['titulo']		= "Definição de Metas";
	$PAGINA['subtitulo']	= DESCRICAO_SITE;

	$categorias = selecionar("categoria", array(), "ORDER BY titulo");
	$hospitais = selecionar("hospital", array(), "ORDER BY titulo");

?><!DOCTYPE html>
<html lang="<?php echo IDIOMA ?>">
	<head>
		<?php include "public/views/frames/metas.php" ?>
		<link rel="stylesheet" type="text/css" href="public/css/metas.css">
	</head>
<body>
	<?php require_once 'public/views/frames/header.php' ?>

	<div class="container">

		<div class="container-selects">
			<div class="inputs">
				<label for="hospital">Hospital</label>
					<select name="hospital" id="hospital">
					<?php echo gerarOptions($hospitais) ?>
				</select>
			</div>

			<div class="inputs">
				<label for="categoria"> Categoria</label>
				<select name="categoria" id="categoria">
					<?php echo gerarOptions($categorias) ?>
				</select>
			</div>
		</div>

		<div class="container-tabelas">

			<?php foreach ($categorias as $v) : ?>
				<form action="app/Controller/defineTarget.php" method="post">

					<input type="hidden" name="especialidade_id" id="especialidade_id-<?php echo $v['id'] ?>" value="<?php echo $v['id'] ?>" />

					<?php $especialidades = selecionar("elemento", array('categoria_id'=>$v['id']), "ORDER BY titulo") ?>

					<table id="bloco-<?php echo $v['id'] ?>">

						<caption><?php echo $v['legenda'] ?></caption>

						<thead>
							<tr>
								<th>Especialidade dos Leitos</th>
								<th title="Essa instituição realiza esse tipo de atendimento?">Aplicável?</th>
								<th>Leitos</th>
								<th>Volume de saída/mês</th>
								<th title="Preencha para definir uma justificativa para a meta dessa linha não ter sido atingida">Justificativa</th>
								<th title="Marque essa caixa caso a justificativa para a meta não ser atingida foi aceita">Aceita?</th>
							</tr>
						</thead>

						<?php foreach ($especialidades as $e) : ?>
						<tr>
							<td><?php echo $e['titulo'] ?></td>
							<td><input type="checkbox" name="checkbox" id="checkbox-<?php echo $e['id'] ?>" value="1" /></td>
							<td><input type="text" name="text" id="leitos-<?php echo $e['id'] ?>" value="102" /></td>
							<td><input type="text" name="text" id="text-<?php echo $e['id'] ?>" value="520" /></td>
							<td><input type="text" name="justificativa" id="justificativa-<?php echo $e['id'] ?>"></td>
							<td><input type="checkbox" name="checkbox" id="aceita-<?php echo $e['id'] ?>" value="1" /></td>
						</tr>
						<?php endforeach ?>

						<tfoot>
							<tr>
								<td colspan="6">
									<?php echo $v['observacoes'] ?>
								</td>
							</tr>
						</tfoot>
					</table>
				</form>

			<?php endforeach ?>

		</div>
	</div>
<script type="text/javascript" src="public/scripts/metas.js"></script>
</body>
</html>
