<?php
include '../../app/Grimoire/core_inc.php';

$sql = "
	SELECT
		c.id					categoria_id,
		c.titulo				categoria_nome,
		c.legenda				categoria_legenda,
		c.ativo					categoria_ativo,

		e.categoria_id			elemento_categoria_id,
		e.titulo				elemento_nome,
		e.id					elemento_id,

		m.elemento_id			meta_elemento_id,
		m.quantidade			meta_quantidade,
		m.ativo					meta_ativo,
		m.hospital_id			meta_hospital_id,
		m.id					meta_id,

		r.meta_id				resultado_meta_id,
		r.resultado				resultado,
		r.mes					mes,
		r.justificativa			justificativa,
		r.justificativa_aceita	justificativa_aceita,
		r.id					resultado_id,
		r.criado_em				criacao,
		r.criado_por			autor_id,

		u.login					autor

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
		-- AND m.ativo = 1

	ORDER BY
		c.titulo,
		e.titulo
";

$condicoes = array(
	$_GET['hospital'],
	$_GET['mes'],
	$_GET['ano']
);

$matriz = executarStmt($sql, $condicoes, 'S');

$titulo = 'ROH '. $_GET['ano'] .'-'. $_GET['mes'];
excell($titulo, $matriz);
