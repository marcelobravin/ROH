<?php
	require_once("app/vendors/dompdf/autoload.inc.php");

	include 'app/Grimoire/core_inc.php';

	if ( empty($_GET['hospital']) ) {
		die("Hospital não selecionado!");
	}

	$hospital = localizar("hospital", ['id'=>$_GET['hospital']]);
	if ( empty($hospital) ) {
		die("Hospital não encontrado!");
	}

	$vistoriador = localizar("usuario", ['id'=>$_SESSION[USUARIO_SESSAO]['id']], '', 'nome');


	$meses = getJson('app/Grimoire/biblioteca/opcionais/listas/meses_do_ano.json');

	$st_mesAtual = $meses[date('n')];
	$in_mesAtual = date('n');
	$in_anoAtual = date('Y');

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
			r.criado_em				resultado_criacao

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

	ob_start();
	include "public/views/comprovante-visita.php";
	if ( !PRODUCAO ){
		$c1->mark();
	}
	ob_end_flush();
	$contents = ob_get_clean();




	//echo $contents;	/*
	gerarPDF($contents);
//*/
	# reference the Dompdf namespace
	use Dompdf\Dompdf;

	function gerarPDF ($contents)
	{
		# instantiate and use the dompdf class
		$dompdf = new Dompdf();
		$dompdf->loadHtml($contents);

		# (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'portrait');

		# Render the HTML as PDF
		$dompdf->render();

		# Output the generated PDF to Browser
		#$dompdf->stream(); # download
		$dompdf->stream("dompdf_out.pdf", array("Attachment" => false)); # show in browser
	}
