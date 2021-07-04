<?php
include 'app/Grimoire/core_inc.php';

if ( LOGADO ) {
	$PAGINA['endereco']		= "home.php";
	$PAGINA['subtitulo']	= "Página Inicial";
	include "public/views/frames/base.php";
} else {
	$PAGINA['endereco']		= "login.php";
	$PAGINA['subtitulo']	= "Login";
	include "public/views/login.php";
}
