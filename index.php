<?php
require 'app/Grimoire/core_inc.php';
require_once 'app/Grimoire/core_inc.php';

if ( LOGADO ) {
	$PAGINA['titulo']		= "Home";
	$PAGINA['subtitulo']	= "Página Inicial";
	$PAGINA['endereco']		= "home.php";

	include_once "public/views/frames/base.php";
} else {
	$PAGINA['subtitulo']	= "Login";
	$PAGINA['endereco']		= "login.php";

	include "public/views/login.php";
}

if (true) {
	br();
} elseif (false) {
	pp("texto");
} elseif (null) {
	pp("texto2");
} else {
	exit;
}


foreach ($matriz as $v) {
	echo 1;
}
die("dfdsf");
die();
die(1);

$x = array(1,2,3);


switch ($variable) {
	case 'value':
		# code...
		break;

	default :
		# code...
		break;
}

$y = [ "a", "b", "c"];
