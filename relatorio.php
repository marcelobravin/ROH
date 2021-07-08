<?php
	include 'app/Grimoire/core_inc.php';

	$PAGINA['titulo']		= "Relatório de metas";
	$PAGINA['subtitulo']	= DESCRICAO_SITE;

	$categorias	= selecionar("categoria", array(), "ORDER BY titulo");
	$hospitais	= selecionar("hospital", array(), "ORDER BY titulo");

	$meses = getJson('app/Grimoire/biblioteca/opcionais/listas/meses_do_ano.json');
	$mesAtual = $meses[date('n')];
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
				});
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
		</style>
	</head>
<body>
	<?php require_once 'public/views/frames/header.php' ?>

	<div class="container">
		<h2>Relatório</h2>

		<div class="<?php echo isset($_SESSION['mensagemClasse']) ? $_SESSION['mensagemClasse'] : "" ?>">
			<?php echo esvaziarMensagem() ?>
		</div>

		<div class="container-selects">
			<div class="inputs">
				<label for="hospital">Hospital</label>
				<select name="hospital" id="hospital">
					<?php echo gerarOptionsAA($hospitais) ?>
				</select>
			</div>

			<div class="inputs">
				<label for="mes">Mês</label>
				<select name="mes" id="mes">
					<?php echo gerarOptions($meses) ?>
				</select>
			</div>

			<div class="inputs">
				<label for="categoria">Categoria</label>
				<select name="categoria" id="categoria">
					<?php echo gerarOptionsAA($categorias) ?>
				</select>
			</div>
		</div>

		<div class="container-tabelas">

			<?php foreach ($categorias as $v) : ?>
				<form action="app/Controller/DefineTarget.php" method="post" id="bloco-<?php echo $v['id'] ?>" class="invisivel">

					<!-- Mudar via jquery o hospital selecionado -->
					<input type="hidden" name="hospital" value="1" class="hospitalSelecionado" />

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
								# localiza metas estabelecidas para essa especialidade
								$cond = array(
									'hospital_id' => 1, # ---------------------- PARAMETRIZAR
									'elemento_id' => $e['id']
								);
								$meta = localizar("meta", $cond);

								if ( empty( $meta ) ) {
									$meta['ativo'] = 0;
									$meta['quantidade'] = 0;
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
									<input type="text" name="leitos[<?php echo $e['id'] ?>]" id="leitos-<?php echo $e['id'] ?>" placeholder="<?php echo $meta['quantidade'] ?>" />
								</td>
								<td>
									<textarea name="justificativa[<?php echo $e['id'] ?>]" id="justificativa-<?php echo $e['id'] ?>" value="<?php echo $meta['quantidade'] ?>">
									</textarea>
								</td>
								<td><input type="checkbox" name="checkbox-<?php echo $e['id'] ?>" id="checkbox-<?php echo $e['id'] ?>" value="1" <?php echo checked ($meta['ativo']) ?>/></td>
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
					<input type="submit" value="Atualizar Metas" />
				</form>

			<?php endforeach ?>

		</div>
	</div>
<script type="text/javascript" src="public/scripts/metas.js"></script>
</body>
</html>
