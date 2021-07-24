<?php
include 'app/Grimoire/core_inc.php';

$PAGINA['titulo']		= "Verificação de Metas";
$PAGINA['subtitulo']	= DESCRICAO_SITE;

$categorias	= selecionar("categoria", array(), "ORDER BY titulo");
$hospitais	= selecionar("hospital", array(), "ORDER BY titulo");

$meses = getJson('app/Grimoire/biblioteca/opcionais/listas/meses_do_ano.json');
$st_mesAtual = $meses[date('n')];
$in_mesAtual = date('n');

$hospitalValido = false;
if ( isset($_GET['hospital']) ) {
	$hospitalValido = positivo($_GET['hospital']);

	$sql = "
		SELECT
			c.id					categoria_id,
			c.titulo				categoria_nome,
			c.legenda				categoria_legenda,
			c.ativo					categoria_ativo,

			e.categoria_id			elemento_categoria_id,
			e.titulo				elemento_nome,
			e.id					elemento_id,

			m.elemento_id			meta_elemento_id,
			m.quantidade			meta_quantidade,
			m.ativo					meta_ativo,
			m.hospital_id			meta_hospital_id,
			m.id					meta_id,

			r.meta_id				resultado_meta_id,
			r.resultado				resultado,
			r.mes					mes,
			r.justificativa			justificativa,
			r.justificativa_aceita	justificativa_aceita,
			r.id					resultado_id
		FROM
			categoria	c,
			elemento	e

			LEFT OUTER JOIN (meta m)
				ON m.elemento_id	= e.id
				AND m.hospital_id	= {$_GET['hospital']}
			LEFT OUTER JOIN (resultado r)
				ON r.meta_id		= m.id
				AND r.mes			= {$in_mesAtual}

		WHERE
			e.categoria_id	= c.id
			AND m.ativo		= 1

		ORDER BY
			c.titulo,
			e.titulo
	";

	$matriz = executar( $sql );

	# separa metas e resultados por categorias para facilitar
	$especialidades = array();
	foreach ($matriz as $e) {
		// if ( isset($especialidades[$e['categoria_nome']]) )
			$especialidades[$e['categoria_nome']][] = $e;
	}
	// exit;
}
?>
<!DOCTYPE html>
<html lang="<?php echo IDIOMA ?>" <?php echo PRODUCAO ? "" : 'class="ambiente_desenvolvimento"' ?>>
<head>
	<?php include "public/views/frames/metas.php" ?>
	<link rel="stylesheet" type="text/css" href="public/css/metas.css">

	<script src="public/scripts/metas.js"></script>

	<script>
		$(document).ready(function(){
			$(".sucesso, .erro").click(function(){
				$(this).slideToggle('slow')
			})

			$("[type='text']").on("keyup change", function(){
				let $this = $(this)
				let id = $this.data("id")

				if (  $this.val()!="" && $this.val() < $this.data("meta") ) {
					$("#justificativa-" +id).removeAttr("disabled")
					// $("#checkbox-" +id).removeAttr("disabled")
					$this.parent().parent().addClass("insuficiente")
				} else {
					$("#justificativa-" +id).attr("disabled", "disabled")
					$("#checkbox-" +id).attr("disabled", "disabled")
					$this.parent().parent().removeClass("insuficiente")
				}
			})

			$("textarea").on("keyup change", function(){
				let $this = $(this)
				let id = $this.data("id")

				if ( $this.val() == "" ) {
					$("#checkbox-" +id).attr("disabled", "disabled")
				} else {
					$("#checkbox-" +id).removeAttr("disabled")
				}
			})

		});
	</script>
	<style>
		textarea {
			resize: none;
			min-width: 310px;
			max-width: 310px;

			min-height:	70px;
		}
		.insuficiente {
			background-color: #ffb8b8 !important
		}
	</style>
</head>
<body>
	<?php require_once 'public/views/frames/header.php' ?>

	<div class="container">
		<h2><?php echo $PAGINA['titulo'] ?></h2>

		<div class="<?php echo isset($_SESSION['mensagemClasse']) ? $_SESSION['mensagemClasse'] : "" ?>">
			<?php echo esvaziarMensagem() ?>
		</div>

		<div class="container-selects">
			<div class="inputs">
				<label for="hospital">Hospital</label>
				<select name="hospital" id="hospital">
					<?php if ( !$hospitalValido ): ?>
						<option>Selecione...</option>
					<?php endif ?>
					<?php echo gerarOptionsAA($hospitais, $_GET['hospital']) ?>
				</select>
			</div>

			<div class="inputs">
				<label for="categoria">Categoria</label>
				<select name="categoria" id="categoria">
					<?php echo gerarOptionsAA($categorias, $_GET['categoria']) ?>
				</select>
			</div>
		</div>

		<h3><?php echo $st_mesAtual ?> - <?php echo date('Y') ?></h3>

		<div class="container-tabelas">

			<?php if ( !$hospitalValido ): ?>
				Selecione um hospital!
			<?php else: ?>

				<?php foreach ($categorias as $v) : ?>
					<form action="app/Controller/FillTarget.php" method="post" id="bloco-<?php echo $v['id'] ?>" class="invisivela" <?php echo $hospitalValido ? "" : "disabled" ?>>
						<h4><?php echo $v['titulo'] ?></h4>

						<input type="hidden" name="hospital" value="<?php echo $_GET['hospital'] ?>" class="hospitalSelecionado" />
						<input type="hidden" name="categoria_id" id="categoria_id-<?php echo $v['id'] ?>" value="<?php echo $v['id'] ?>" />

						<table>
							<caption><?php echo $v['legenda'] ?></caption>

							<thead>
								<tr>
									<th>Especialidade<br>dos Leitos</th>
									<th>Volume<br>de saída</th>
									<th title="Preencha para definir uma justificativa para a meta dessa linha não ter sido atingida">Justificativa</th>
									<th title="Marque essa caixa caso a seja aceitável a justificativa para a meta não ser ter sido atingida">Justificativa<br>Aceita?</th>
								</tr>
							</thead>

							<?php if ( !isset($especialidades[$v['titulo']]) ) : ?>
								<tr>
									<td>Nenhuma definição dessa categoria encontrada para esse hospital!</td>
								</tr>
							<?php else : ?>
								<?php foreach ($especialidades[$v['titulo']] as $e) : ?>
									<tr>
										<td>
											<?php echo $e['elemento_nome'] ?>
											<input type="hidden" name="especialidadeId" value="<?php echo $e['elemento_id'] ?>" />
										</td>

										<td>
											<?php if ( !isset($e['meta_quantidade']) ): ?>
												<i>Meta não definida!</i>
												<br>
												<i>
													<a href="metas.php?<?php echo $_SERVER['QUERY_STRING'] ?>&categoria=<?php echo $v['id'] ?>">Definir meta</a>
												</i>

											<?php else: ?>
												<p>
													Meta: <?php echo $e['meta_quantidade'] ?>
												</p>

												<?php if ( isset($e['resultado']) ): ?>
													<input type="text" disabled value="<?php echo $e['resultado'] ?>" />
												<?php else: ?>
													<input type="text" name="leitos[<?php echo $e['meta_id'] ?>]" id="leitos-<?php echo $e['meta_id'] ?>" data-meta="<?php echo $e['meta_quantidade'] ?>" data-id="<?php echo $e['meta_id'] ?>" value="<?php echo $e['resultado'] ?>" />
												<?php endif ?>

											<?php endif ?>
										</td>

										<td>
											<?php if ( isset($e['meta_quantidade']) ): ?>
												<?php if ( isset($e['resultado']) ): ?>
													<textarea disabled><?php echo $e['justificativa'] ?></textarea>
												<?php else: ?>
													<textarea name="justificativa[<?php echo $e['meta_id'] ?>]" id="justificativa-<?php echo $e['meta_id'] ?>" data-id="<?php echo $e['meta_id'] ?>" disabled><?php echo $e['justificativa'] ?></textarea>
												<?php endif ?>
											<?php endif ?>
										</td>

										<td>
											<?php if ( isset($e['meta_quantidade']) ): ?>
												<?php if ( isset($e['resultado']) ): ?>
													<input type="checkbox" disabled <?php echo $e['justificativa_aceita'] ? "checked" : "" ?> />
												<?php else: ?>
													<input type="checkbox" name="checkbox-<?php echo $e['meta_id'] ?>" id="checkbox-<?php echo $e['meta_id'] ?>" value="1" disabled />
												<?php endif ?>
											<?php endif ?>
										</td>
									</tr>
								<?php endforeach ?>
							<?php endif ?>

							<tfoot>
								<tr>
									<td colspan="4">
										<?php echo $v['observacoes'] ?>
									</td>
								</tr>
							</tfoot>
						</table>
						<input type="submit" value="Registrar Resultados" />

					</form>

				<?php endforeach ?>
			<?php endif ?>

		</div>
	</div>
</body>
</html>
