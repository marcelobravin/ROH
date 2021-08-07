<?php
	include 'app/Grimoire/core_inc.php';

	if ( empty($_GET['modulo']) ) {
		redirecionar("index.php");
	}

	define('MODULO', $_GET['modulo']);

	$PAGINA['titulo']		= "Cadastro";
	$PAGINA['subtitulo']	= MODULO;

	include "public/views/frames/frameset.php";
