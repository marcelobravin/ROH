<?php
require 'app/Grimoire/core_inc.php';

if ( LOGADO ) {
	$PAGINA['titulo']		= "Home";
	$PAGINA['subtitulo']	= "Página Inicial";
	$PAGINA['endereco']		= "home.php";

	include "public/views/frames/frameset.php";
} else {
	$PAGINA['subtitulo']	= "Login";
	$PAGINA['endereco']		= "login.php";
	$omitirMenu = true;

	include "public/views/frames/frameset.php";
}
