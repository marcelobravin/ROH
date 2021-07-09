<?php
	include 'app/Grimoire/core_inc.php';

	$PAGINA['titulo']		= "Verificação de Metas";
	$PAGINA['subtitulo']	= DESCRICAO_SITE;

	$categorias	= selecionar("categoria", array(), "ORDER BY titulo");
	$hospitais	= selecionar("hospital", array(), "ORDER BY titulo");

	$meses = getJson('app/Grimoire/biblioteca/opcionais/listas/meses_do_ano.json');
	$mesAtual = $meses[date('n')];

	$hospitalValido = false;
	if ( isset($_GET['hospital']) )
		$hospitalValido = positivo($_GET['hospital']); # inteiro tb
?>
<!DOCTYPE html>
<html lang="<?php echo IDIOMA ?>" <?php echo PRODUCAO ? "" : 'class="ambiente_desenvolvimento"' ?>>
	<head>
		<?php include "public/views/frames/metas.php" ?>
		<link rel="stylesheet" type="text/css" href="public/css/metas.css">
		<script type="text/javascript">
			$(document).ready(function(){
				$(".sucesso, .erro").click(function(){
					$(this).slideToggle('slow')
				})

				$("[type='text']").on("keyup change", function(){
					let $this = $(this)
					let id = $this.data("id")

					if ( $this.val() < $this.data("meta") ) {
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
				min-width:	310px;
				max-width:	310px;

				min-height:	70px;
				/* max-height:	80px; */
			}
			.insuficiente {
				/* border: 1px solid red */
				background-color: #ffb8b8 !important
			}
		</style>
	</head>
<body>
	<?php require_once 'public/views/frames/header.php' ?>

	<div class="container">
		<h2>Preencher Ocupação Atual</h2>

		<div class="<?php echo isset($_SESSION['mensagemClasse']) ? $_SESSION['mensagemClasse'] : "" ?>">
			<?php echo esvaziarMensagem() ?>
		</div>

		<div class="container-selects">
			<div class="inputs">
				<label for="hospital">Hospital</label>
				<select name="hospital" id="hospital">
					<option>Selecione...</option>
					<?php echo gerarOptionsAA($hospitais, $_GET['hospital']) ?>
				</select>
			</div>

			<div class="inputs">
				<label for="categoria">Categoria</label>
				<select name="categoria" id="categoria">
					<?php echo gerarOptionsAA($categorias) ?>
				</select>
			</div>
		</div>

		<h3><?php echo $mesAtual ?> - <?php echo date('Y') ?></h3>

		<div class="container-tabelas">

			<?php if ( !$hospitalValido ): ?>
				Selecione um hospital!
			<?php else: ?>
				<?php foreach ($categorias as $v) : ?>
					<form action="app/Controller/DefineTarget.php" method="post" id="bloco-<?php echo $v['id'] ?>" class="invisivel" <?php echo $hospitalValido ? '' : 'disabled' ?>>

						<input type="hidden" name="hospital" value="<?php echo $_GET['hospital'] ?>" class="hospitalSelecionado" />

						<input type="hidden" name="categoria_id" id="categoria_id-<?php echo $v['id'] ?>" value="<?php echo $v['id'] ?>" />

						<?php $especialidades = selecionar("elemento", array('categoria_id'=>$v['id']), "ORDER BY titulo") ?>


						<table>
							<caption><?php echo $v['legenda'] ?></caption>

							<thead>
								<tr>
									<th>Especialidade dos Leitos</th>
									<th>Volume de saída</th>
									<th title="Preencha para definir uma justificativa para a meta dessa linha não ter sido atingida">Justificativa</th>
									<th title="Marque essa caixa caso a seja aceitável a justificativa para a meta não ser ter sido atingida">Aceita?</th>
								</tr>
							</thead>

							<?php foreach ($especialidades as $e) : ?>

								<?php
									# localiza metas estabelecidas desse hospital para essa especialidade
									$cond = array(
										'hospital_id' => isset($_GET['hospital']) ? $_GET['hospital'] : 0,
										'elemento_id' => $e['id']
									);
									$meta = localizar("meta", $cond);

									// if ( empty( $meta ) ) {
									// 	$meta['quantidade'] = 0;
									// }


									if ( empty( $meta ) ) {
										die("Meta não definida para esse hospital!");
									}

								?>

								<tr>
									<td>
										<?php echo $e['titulo'] ?>
										<input type="hidden" name="especialidadeId" value="<?php echo $e['id'] ?>" />
									</td>
									<td>
										<p>
											Meta:
											<?php echo $meta['quantidade'] ?>
										</p>
										<input type="text" name="leitos[<?php echo $e['id'] ?>]" id="leitos-<?php echo $e['id'] ?>" data-meta="<?php echo $meta['quantidade'] ?>" data-id="<?php echo $e['id'] ?>" />
									</td>
									<td>
										<textarea name="justificativa[<?php echo $e['id'] ?>]" id="justificativa-<?php echo $e['id'] ?>"  data-id="<?php echo $e['id'] ?>" disabled></textarea>
									</td>
									<td>
										<input type="checkbox" name="checkbox-<?php echo $e['id'] ?>" id="checkbox-<?php echo $e['id'] ?>" value="1" disabled />
									</td>
								</tr>
							<?php endforeach ?>

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
<script type="text/javascript" src="public/scripts/metas.js"></script>
</body>
</html>
