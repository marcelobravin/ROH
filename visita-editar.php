<?php
include 'app/Grimoire/core_inc.php';

$PAGINA['titulo']		= "Alteração de Visita";
$PAGINA['subtitulo']	= DESCRICAO_SITE;

$meses = getJson('app/Grimoire/biblioteca/opcionais/listas/meses_do_ano.json');
$in_anoAtual = $_GET['ano'];
$in_mesAtual = $_GET['mes'];
$in_diaAtual = $_GET['dia'];
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
		, e.titulo	titulo_elemento
		, c.titulo	titulo_categoria
		, h.titulo	titulo_hospital
		, u.id		in_criado_por
		, u.nome	st_criado_por

		 , u2.id		in_atualizado_por
		 , u2.nome	st_atualizado_por
	FROM
		visita		v,
		usuario		u,
		meta		m,
		hospital	h,
		elemento	e,
		categoria	c

		 LEFT OUTER JOIN (usuario u2)
			 ON u2.id	= v.atualizado_por

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
$matriz = executarStmt($stmt, $criterios, "S");
exibir($matriz);
exibir($stmt);

$stmt = "SELECT * FROM hospital WHERE id = ?";
$hospital = executarStmt($stmt, $_GET['hospital'], "S");
$hospital = $hospital[0];

include "public/views/frames/frameset.php";
