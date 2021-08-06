<?php
include '../../app/Grimoire/core_inc.php';

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
		r.id					id_resultado,
		r.criado_em				criacao,
		r.criado_por			id_autor,

		u.login					autor

	FROM
		categoria	c,
		elemento	e

		LEFT OUTER JOIN (meta m)
			ON m.id_elemento		= e.id
			AND m.id_hospital		= ?
		LEFT OUTER JOIN (resultado r)
			ON r.id_meta			= m.id
			AND r.mes				= ?
			AND r.ano				= ?

		LEFT OUTER JOIN (usuario u)
			ON r.criado_por			= u.id

	WHERE
		e.id_categoria = c.id
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
