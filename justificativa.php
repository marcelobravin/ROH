<?php
include 'app/Grimoire/core_inc.php';

$PAGINA['titulo']		= "Verificação de Justificativas";
$PAGINA['subtitulo']	= DESCRICAO_SITE;


$condicoes = array('ativo' => 1);
$hospitais	= selecionar("hospital", $condicoes, "ORDER BY titulo");
$categorias	= selecionar("categoria", "", "ORDER BY titulo");

$meses = getJson('app/Grimoire/biblioteca/opcionais/listas/meses_do_ano.json');
$st_mesAtual = $meses[date('n')];
$in_mesAtual = date('n');
$in_anoAtual = date('Y');

$hospitalValido = false;
if ( isset($_GET['hospital']) ) {
	$hospitalValido = positivo($_GET['hospital']);

	$sql = "
		SELECT
			c.id					id_categoria,
			c.titulo				categoria_nome,
			c.legenda				categoria_legenda,
			c.ativo					categoria_ativo,

			e.id_categoria			id_elemento_categoria,
			e.titulo				elemento_nome,
			e.id					id_elemento,

			m.id_elemento			id_meta_elemento,
			m.quantidade			meta_quantidade,
			m.ativo					meta_ativo,
			m.id_hospital			id_meta_hospital,
			m.id					id_meta,

			r.id_meta				id_resultado_meta,
			r.resultado				resultado,
			r.mes					mes,
			r.justificativa			justificativa,
			r.justificativa_aceita	justificativa_aceita,
			r.id					id_resultado
		FROM
			categoria	c,
			elemento	e

			LEFT OUTER JOIN (meta m)
				ON m.id_elemento	= e.id
				AND m.id_hospital	= {$_GET['hospital']}
			LEFT OUTER JOIN (resultado r)
				ON r.id_meta		= m.id
				AND r.mes			= {$in_mesAtual}
				AND r.ano			= {$in_anoAtual}

		WHERE
			e.id_categoria	= c.id
			AND m.ativo		= 1

		ORDER BY
			c.titulo,
			e.titulo
	";

	$matriz = executar( $sql );

	# separa metas e resultados por categorias para facilitar
	$especialidades = array();
	foreach ($matriz as $e) {
		$especialidades[$e['categoria_nome']][] = $e;
	}

	# da escape em campos de texto
	foreach ($especialidades as $i=>$h) {
		foreach ($especialidades[$i] as $j=>$v) {
			$especialidades[$i][$j]['categoria_nome']		= bloquearXSS($v['categoria_nome']);
			$especialidades[$i][$j]['categoria_legenda']	= bloquearXSS($v['categoria_legenda']);
			$especialidades[$i][$j]['elemento_nome']		= bloquearXSS($v['elemento_nome']);
			$especialidades[$i][$j]['justificativa']		= bloquearXSS($v['justificativa']);
		}
	}

	foreach ($matriz as $i=>$h) {
		$matriz[$i]['categoria_nome']		= bloquearXSS($h['categoria_nome']);
		$matriz[$i]['categoria_legenda']	= bloquearXSS($h['categoria_legenda']);
		$matriz[$i]['elemento_nome']		= bloquearXSS($h['elemento_nome']);
		$matriz[$i]['justificativa']		= bloquearXSS($h['justificativa']);
	}
}

# da escape em campos de texto
foreach ($hospitais as $i=>$h) {
	$hospitais[$i]['titulo'] = bloquearXSS($h['titulo']);
}
foreach ($categorias as $i=>$h) {
	$categorias[$i]['tituloSanitizado'] = bloquearXSS($h['titulo']);
}

include "public/views/frames/frameset.php";
