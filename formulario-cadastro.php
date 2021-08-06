<?php
	include 'app/Grimoire/core_inc.php';

	$PAGINA['titulo']		= "Cadastro";
	$PAGINA['subtitulo']	= "Usuário";

	if ( empty($_GET['modulo']) ) {
		redirecionar("index.php");
	}

	define('MODULO', $_GET['modulo']);

	include "public/views/frames/frameset.php";
