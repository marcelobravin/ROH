<?php
	include 'app/Grimoire/core_inc.php';

	$PAGINA['titulo']		= "Relatório de metas";
	$PAGINA['subtitulo']	= DESCRICAO_SITE;

	$categorias	= selecionar("categoria", array(), "ORDER BY titulo");
	$hospitais	= selecionar("hospital", array(), "ORDER BY titulo");

	$meses = getJson('app/Grimoire/biblioteca/opcionais/listas/meses_do_ano.json');
	$mesAtual = $meses[date('n')];

	$mesSelecionado = isset( $_GET['mes'] ) ? $_GET['mes'] : $mesAtual;
	$hospitalSelecionado = isset( $_GET['hospital'] ) ? $_GET['hospital'] : 1; # corrigir




		// $matriz = array();
	// foreach ($especialidades as $e) {
	// 	# localiza metas estabelecidas para essa especialidade
	// 	$cond = array(
	// 		'hospital_id'	=> $hospitalSelecionado,
	// 		'elemento_id'	=> $e['id']
	// 		// 'mes'			=> $e['mes']
	// 	);
	// 	$matriz[] = localizar("meta", $cond);
	// }

	$cond = array(
		'hospital_id'	=> $hospitalSelecionado,
	);
	$metas = selecionar("meta", $cond);


	foreach ($metas as $i => $v) {
		$metas[$i]['elemento'] = localizar( "elemento", array('id'=>$v['elemento_id']) );
		$metas[$i]['resultado'] = localizar( "resultado", array(
			'meta_id'	=> $v['id']
			, 'mes'		=> $mesSelecionado
		));
	}




echo('<pre>');
// print_r($especialidades);
print_r($metas);
echo('</pre>');

	exit;

?><!DOCTYPE html>
<html lang="<?php echo IDIOMA ?>" <?php echo PRODUCAO ? "" : 'class="ambiente_desenvolvimento"' ?>>
	<head>
		<?php include "public/views/frames/metas.php" ?>
		<link rel="stylesheet" type="text/css" href="public/css/metas.css">

		<script src="public/scripts/metas.js"></script>

		<script>
			$(document).ready(function(){
				$(".sucesso, .erro").click(function(){
					$(this).slideToggle('slow')
				});

				$("#mes").change(function(){
					$( "form" ).addClass("invisivel")
					$( "#bloco-"+ $(this).val() ).removeClass("invisivel")
				})


				$("#mes").change(function(){
					var h = $(this).val()
					let paginaAtual = window.location.href
					let fragmentos = paginaAtual.split('?')

					const queryString = window.location.search;

					const urlParams = new URLSearchParams(queryString);

					const hospital = urlParams.get('hospital')

					console.log(hospital);

					fragmentos = fragmentos[0].split('/')
					window.location.href = fragmentos[5] + "?hospital="+hospital+"&mes="+h // PROJETOS/roh
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
					<?php echo gerarOptionsAA($hospitais, $_GET['hospital']) ?>
				</select>
			</div>

			<div class="inputs">
				<label for="mes">Mês</label>
				<select name="mes" id="mes">
					<?php echo gerarOptions($meses, $mesSelecionado) ?>
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
				</form>

				<hr>

			<?php endforeach ?>

		</div>
	</div>
</body>
</html>
