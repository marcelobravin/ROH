<?php
	include 'app/Grimoire/core_inc.php';

	require 'app/model/database.class.php';


	// if ( !LOGADO ) {
	// 	echo "Usuário não logado";

	// } else {
		if ( isset($_GET['modulo']) )
			define('MODULO', $_GET['modulo']);
		else die('Modulo não selecionado');

		// $tabela = limparNomeArquivo(__FILE__);


		$PAGINA['endereco']		= "lista.php";
		$PAGINA['titulo']		= "Lista";
		$PAGINA['subtitulo']	= MODULO;
		$PAGINA['separador']	= SEPARADOR_TITULO;

		$paginacao = paginationCore(MODULO, 3);

		include "public/views/frames/base.php";
	// }
