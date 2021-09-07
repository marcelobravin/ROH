<?php
include 'app/Grimoire/core_inc.php';

$PAGINA['titulo']		= "Realização de Visitas";
$PAGINA['subtitulo']	= DESCRICAO_SITE;


$condicoes = array('ativo' => 1);
$hospitais	= selecionar("hospital", $condicoes, "ORDER BY titulo");
$categorias	= selecionar("categoria", "", "ORDER BY titulo");

$meses = getJson('app/Grimoire/biblioteca/opcionais/listas/meses_do_ano.json');
$in_anoAtual = anoAtual();
$in_mesAtual = mesAtual();
$in_diaAtual = date('d');
$st_mesAtual = $meses[ $in_mesAtual ];


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
			m.id					id_meta

		FROM
			categoria	c,
			elemento	e

			LEFT OUTER JOIN (meta m)
				ON m.id_elemento	= e.id
				AND m.id_hospital	= {$_GET['hospital']}

		WHERE
			e.id_categoria	= c.id
			AND m.ativo		= 1

		ORDER BY
			c.titulo,
			e.titulo
	";

	$matriz = executar( $sql );
}

# da escape em campos de texto
foreach ($hospitais as $i=>$h) {
	$hospitais[$i]['titulo'] = bloquearXSS($h['titulo']);
}
foreach ($categorias as $i=>$h) {
	$categorias[$i]['tituloSanitizado'] = bloquearXSS($h['titulo']);
}

include "public/views/frames/frameset.php";
