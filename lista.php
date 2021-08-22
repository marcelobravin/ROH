<?php
	include 'app/Grimoire/core_inc.php';

	if ( empty($_GET['modulo']) ) {
		redirecionar("index.php");
	}

	define('MODULO', $_GET['modulo']);
	if ( !in_array(MODULO, $MODULOS) ) {
		die("Módulo inválido!");
	}

	$PAGINA['titulo'] = "Lista";
	$paginacao = paginationCore(MODULO);

	include "public/views/frames/frameset.php";
