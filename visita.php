<?php
include 'app/Grimoire/core_inc.php';

$PAGINA['titulo']		= "Visitas Realizadas";
$PAGINA['subtitulo']	= DESCRICAO_SITE;


$condicoes = array('ativo' => 1);
$hospitais	= selecionar("hospital", $condicoes, "ORDER BY titulo");
$categorias	= selecionar("categoria", "", "ORDER BY titulo");

$meses = getJson('app/Grimoire/biblioteca/opcionais/listas/meses_do_ano.json');
$st_mesAtual = $meses[date('n')];
$in_anoAtual = anoAtual();
$in_mesAtual = mesAtual();


$hospitalValido = false;
if ( isset($_GET['hospital']) ) {
	$hospitalValido = positivo($_GET['hospital']);

	$stmt = "
		SELECT
			*
		FROM
			visita		v,
			meta		m,
			hospital	h,
			usuario		u
		WHERE
			h.id		= ?

			AND u.id	= v.criado_por
			AND h.id	= m.id_hospital
			AND m.id	= v.id_meta
		GROUP BY
			v.dia,
			v.mes,
			v.ano
		";

	$criterios = array(
		$_GET['hospital']
	);
	$matriz = executarStmt ($stmt, $criterios, "S");
	// exibir($matriz);
}


# da escape em campos de texto
foreach ($hospitais as $i=>$h) {
	$hospitais[$i]['titulo'] = bloquearXSS($h['titulo']);
}

include "public/views/frames/frameset.php";
