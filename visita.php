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

	$sql = "
		SELECT
			*
		FROM
			visita	v
		group by
			v.dia,
			v.mes,
			v.ano
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
