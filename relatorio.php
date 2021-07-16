<?php
include 'app/Grimoire/core_inc.php';

$PAGINA['titulo']		= "Relatório de Ocupação Hospitalar";
$PAGINA['subtitulo']	= DESCRICAO_SITE;

$categorias	= selecionar("categoria", array(), "ORDER BY titulo");
$hospitais	= selecionar("hospital", array(), "ORDER BY titulo");

$meses = getJson('app/Grimoire/biblioteca/opcionais/listas/meses_do_ano.json');
// $st_mesAtual = $meses[date('n')];
$in_mesAtual = date('n');
$in_anoAtual = date('Y');

$anos = Array();
for ($i=2021; $i<= $in_anoAtual; $i++) {
	$anos[] = $i;
}

$mesSelecionado = $in_mesAtual;
if ( isset($_GET['mes']) )
	$mesSelecionado = $_GET['mes'];

$anoSelecionado = $in_anoAtual;
if ( isset($_GET['ano']) )
	$anoSelecionado = $_GET['ano'];

$hospitalValido = false;
if ( isset($_GET['hospital']) ) {
	$hospitalValido = positivo($_GET['hospital']);

	$sql = "
		SELECT
			c.id					categoria_id,
			c.titulo				categoria_nome,
			c.legenda				categoria_legenda,
			c.ativo					categoria_ativo,

			'-',

			e.categoria_id			elemento_categoria_id,
			e.titulo				elemento_nome,
			e.id					elemento_id,

			'--',

			m.elemento_id			meta_elemento_id,
			m.quantidade			meta_quantidade,
			m.ativo					meta_ativo,
			m.hospital_id			meta_hospital_id,
			m.id					meta_id,

			'---',

			r.meta_id				resultado_meta_id,
			r.resultado				resultado,
			r.mes					mes,
			r.justificativa			justificativa,
			r.justificativa_aceita	justificativa_aceita,
			r.id					resultado_id,
			r.criado_em				criacao,
			r.criado_por			autor_id,

			u.login					autor


			-- c.*,
			-- '||',
			-- e.*,
			-- '||',
			-- m.*,
			-- '||',
			-- r.*
		FROM
			categoria	c,
			elemento	e

			LEFT OUTER JOIN (meta m)
				ON m.elemento_id		= e.id
				AND m.hospital_id		= ?
			LEFT OUTER JOIN (resultado r)
				ON r.meta_id			= m.id
				AND r.mes				= ?
				AND r.ano				= ?

			LEFT OUTER JOIN (usuario u)
				ON r.criado_por			= u.id

		WHERE
			e.categoria_id = c.id

		ORDER BY
			c.titulo,
			e.titulo
	";
	$condicoes = array(
		$_GET['hospital'],
		$mesSelecionado,
		$anoSelecionado
	);

	$matriz = executarStmt($sql, $condicoes, 'S');

	# separa metas e resultados por categorias para facilitar
	$especialidades = array();
	foreach ($matriz as $e) {
		$especialidades[$e['categoria_nome']][] = $e;
	}
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

			$("#mes").change(function(){
				var h = $(this).val()
				let paginaAtual = window.location.href
				let fragmentos = paginaAtual.split('?')

				fragmentos = fragmentos[0].split('/')
				// achar roh +1
				window.location.href = fragmentos[4] + "?hospital="+1+"&mes="+h
				// window.location.href = fragmentos[5] + "?hospital="+h // PROJETOS/roh
			})

			// $('h3').click(function(){
			// 	$(this).parent().find('.accordion').slideToggle("slow");
			// });
		});
	</script>
	<style>
		textarea {
			resize: none;
			min-width: 310px;
			max-width: 310px;
			min-height:	70px;
		}
		td { border: 1px solid silver; }
		/* table {	border-collapse: collapse; } */
		thead th { background-color: #00dfc0 !important; }
		/* td input,
		td:nth-child(5),
		td:nth-child(4),
		td:nth-child(3),
		td:nth-child(2) { text-align: center } */
		/* tr:nth-child(even){ background-color: #ddd; } */
		.tituloCategoria { text-align: center }
		.insuficiente {
			color: red;
			font-weight: bold;
		}
		.suficiente {
			color: green;
			font-weight: bold;
		}

		#ano > option[value="<?php echo $in_anoAtual ?>"],
		#mes > option[value="<?php echo $in_mesAtual ?>"] {
			font-weight: bold;
		}
		button {
			/* border: 1px solid gray; */
			background-color: #609bf5;
			color: white;
			padding: 10px 30px;
			border-radius: 6px;
			margin: 10px auto;
			display: block;
			margin-top: 20px;
		}

		button:hover {
			/* border: 1px solid silver; */
			text-decoration: underline;
		}
		table {
			margin-top: 0;
		}

		.container-selects {
			margin: 20px 0px 00px;
		}
	</style>
</head>
<body>
<?php require_once 'public/views/frames/header.php' ?>

	<div class="container">
		<h2><?php echo $PAGINA['titulo'] ?></h2>

		<div class="container-selects">
			<div class="inputs">
				<label for="hospital">Hospital</label>
				<select name="hospital" id="hospital">
					<?php if ( !$hospitalValido ): ?>
						<option>Selecione...</option>
					<?php endif ?>
					<?php echo gerarOptionsAA($hospitais, $_GET['hospital']) ?>
				</select>

				<label for="ano">Ano</label>
				<select name="ano" id="ano">
					<?php foreach ($anos as $v) : ?>
						<?php if ( !$hospitalValido ): ?>
							<option value="<?php echo $v ?>"><?php echo $v ?></option>
						<?php else: ?>
							<option selected value="<?php echo $v ?>"><?php echo $v ?></option>
						<?php endif ?>
					<?php endforeach ?>
				</select>

				<label for="mes">Mês</label>
				<select name="mes" id="mes">
					<?php echo gerarOptions($meses, $mesSelecionado) ?>
				</select>
			</div>
		</div>

		<div class="container-tabelas">

			<?php if ( !$hospitalValido ): ?>
				Selecione um hospital!
			<?php else: ?>

				<table>
					<?php foreach ($categorias as $v) : ?>

						<thead>
							<tr>
								<td colspan="7" class="tituloCategoria">
									<h3>
										<?php echo $v['titulo'] ?>
									</h3>
								</td>
							</tr>

							<tr>
								<td colspan="7">
									<?php echo $v['legenda'] ?>
								</td>
							</tr>

							<tr>
								<th>Especialidade<br>dos Leitos</th>
								<th>Leitos</th>
								<th>Volume<br>de saída</th>
								<th title="Preencha para definir uma justificativa para a meta dessa linha não ter sido atingida">Justificativa</th>
								<th title="Marque essa caixa caso a seja aceitável a justificativa para a meta não ser ter sido atingida">Justificativa<br>Aceita?</th>
								<th>Responsável<br>pela vistoria</th>
								<th>Data da<br>vistoria</th>
							</tr>
						</thead>

						<?php foreach ($especialidades[$v['titulo']] as $e) : ?>
							<tr>
								<td>
									<?php echo $e['elemento_nome'] ?>
									<input type="hidden" name="especialidadeId" value="<?php echo $e['elemento_id'] ?>" />
								</td>

								<td>
									<?php if ( isset($e['meta_quantidade']) ): ?>
										<?php echo $e['meta_quantidade'] ?>
									<?php else: ?>
										<i>Meta não<br>definida!</i>
									<?php endif ?>
								</td>

								<td>
									<?php if ( isset($e['meta_quantidade']) ): ?>
										<?php if ( isset($e['resultado']) ): ?>
											<span <?php echo $e['resultado'] < $e['meta_quantidade'] ? 'class="insuficiente"' : '' ?>>
												<?php echo $e['resultado'] ?>
											</span>
										<?php else: ?>
											<i>Meta não<br>verificada!</i>
										<?php endif ?>
									<?php else: ?>
										&nbsp;
									<?php endif ?>
								</td>

								<td>
									<?php if ( isset($e['resultado']) ): ?>
										<textarea disabled><?php echo $e['justificativa'] ?></textarea>
									<?php else: ?>
										&nbsp;
									<?php endif ?>
								</td>

								<td>
									<?php if ( isset($e['justificativa']) ): ?>
										<?php if ( isset($e['justificativa_aceita']) && $e['justificativa_aceita'] ): ?>
											<span class="suficiente">
												Sim
											</span>
										<?php else: ?>
											Não
										<?php endif ?>
									<?php else: ?>
										&nbsp;
									<?php endif ?>
								</td>

								<td>
									<?php if ( isset($e['autor']) ): ?>
										<a href="lista.php?modulo=usuario&id=<?php echo $e['autor_id'] ?>">
											<?php echo $e['autor'] ?>
										</a>
									<?php endif ?>
								</td>

								<td>
									<?php if ( isset($e['criacao']) ): ?>
										<?php echo converterData( descartarHorario($e['criacao']) ) ?>
									<?php endif ?>
								</td>

							</tr>
						<?php endforeach ?>

						<tfoot>
							<tr>
								<td colspan="7">
									<?php echo $v['observacoes'] ?>
								</td>
							</tr>
						</tfoot>
					<?php endforeach ?>
				</table>

			<?php endif ?>

		</div>

		<?php if ( isset($matriz) ): # TODO: substituir por verificação de existência de resultado?>
			<button>Exportar</button>
		<?php endif ?>

	</div>
</body>
</html>
