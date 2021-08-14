<?php
	include 'app/Grimoire/core_inc.php';
	# comment
	$PAGINA['titulo']		= "Definição de Metas";
	$PAGINA['subtitulo']	= DESCRICAO_SITE;


	$condicoes = array('ativo' => 1);
	$hospitais	= selecionar("hospital", $condicoes, "ORDER BY titulo");
	$categorias = selecionar("categoria", array(), "ORDER BY titulo");

	$hospitalValido = false;
	if ( isset($_GET['hospital']) ) {
		$hospitalValido = positivo($_GET['hospital']); # inteiro tb
	}

	# da escape em campos de texto
	foreach ($hospitais as $i=>$h) {
		$hospitais[$i]['titulo'] = bloquearXSS($h['titulo']);
	}
	foreach ($categorias as $i=>$h) {
		$categorias[$i]['titulo'] = bloquearXSS($h['titulo']);
	}

	include "public/views/frames/frameset.php";
