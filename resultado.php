<?php
include 'app/Grimoire/core_inc.php';

$PAGINA['titulo']		= "Verificação de Metas";
$PAGINA['subtitulo']	= DESCRICAO_SITE;

$categorias	= selecionar("categoria", array(), "ORDER BY titulo");
$hospitais	= selecionar("hospital", array(), "ORDER BY titulo");

$meses = getJson('app/Grimoire/biblioteca/opcionais/listas/meses_do_ano.json');
$st_mesAtual = $meses[date('n')];
$in_mesAtual = date('n');

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
}

include "public/views/frames/frameset.php";
