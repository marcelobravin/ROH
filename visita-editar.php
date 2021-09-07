<?php
include 'app/Grimoire/core_inc.php';

$PAGINA['titulo']		= "Realização de Visitas";
$PAGINA['subtitulo']	= DESCRICAO_SITE;

$meses = getJson('app/Grimoire/biblioteca/opcionais/listas/meses_do_ano.json');
$in_anoAtual = anoAtual();
$in_mesAtual = mesAtual();
$in_diaAtual = date('d');
$st_mesAtual = $meses[ $in_mesAtual ];

if ( !isset($_GET['hospital']) ) {
	die("Hospital não definido!");
}
if ( !isset($_GET['dia']) ) {
	die("Dia não definido!");
}
if ( !isset($_GET['mes']) ) {
	die("Mês não definido!");
}
if ( !isset($_GET['ano']) ) {
	die("Ano não definido!");
}

$stmt = "
	SELECT
		*
	FROM
		visita		v,
		usuario		u,
		meta		m,
		hospital	h,
		elemento	e,
		categoria	c
	WHERE
		v.dia		= ?
		AND v.mes	= ?
		AND v.ano	= ?
		AND h.id	= ?

		AND u.id	= v.criado_por
		AND h.id	= m.id_hospital
		AND m.id	= v.id_meta
		AND e.id	= m.id_elemento
		AND c.id	= e.id_categoria
";
$criterios = array(
	$_GET['dia'],
	$_GET['mes'],
	$_GET['ano'],
	$_GET['hospital']
);
$matriz = executarStmt ($stmt, $criterios, "S");

include "public/views/frames/frameset.php";
