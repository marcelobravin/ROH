<?php
	require 'app/Grimoire/core_inc.php';

	if ( LOGADO ) {
		$PAGINA['titulo']		= "Home";
		$PAGINA['subtitulo']	= "Página Inicial";
		$PAGINA['endereco']		= "home.php";

		include "public/views/frames/base.php";
	} else {
		// $PAGINA['titulo']		= TITULO_SITE;
		$PAGINA['subtitulo']	= "Login";
		$PAGINA['endereco']		= "login.php";

		include "public/views/login.php";
	}
