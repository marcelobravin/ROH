<?php
	include 'app/Grimoire/core_inc.php';
	# comment
	$PAGINA['titulo']		= "Definição de Metas";
	$PAGINA['subtitulo']	= DESCRICAO_SITE;

	$categorias = selecionar("categoria", array(), "ORDER BY titulo");
	$hospitais = selecionar("hospital", array(), "ORDER BY titulo");

	$hospitalValido = false;
	if ( isset($_GET['hospital']) ) {
		$hospitalValido = positivo($_GET['hospital']); # inteiro tb
	}

	include "public/views/frames/frameset.php";
