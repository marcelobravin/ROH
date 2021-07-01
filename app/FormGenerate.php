<?php
	include '../config.php';

	# http://localhost/ROH/app/FormGenerate.php

	require '../model/database.class.php'; // para teste

	require '../app/lib/paginacao.php';
	require '../app/lib/formularios.php';
	require '../app/lib/snippets.php';
	require '../app/lib/html.php';
	require '../app/lib/vetores.php';

	// gerarFormulario('usuarios');
	$sobreescreverLabels = array('titulo'=> 'Título');
	$sobreEscreverCampos = array();
	$remover = array();
	$esconder = array();
	$conversoes = array();
	$descricaoLabels = array('titulo'=> 'Descrição do Título');
	$padroes = array();

	$form = gerarFormulario('hospital',
		$sobreescreverLabels,
		$sobreEscreverCampos,
		$remover,
		$esconder,
		$conversoes,
		$descricaoLabels,
		$padroes
	);
	echo('<pre>');
	print_r($form);
	echo('</pre>');


	$diretorioDestino='/opt/lampp/htdocs/ROH/_arquivos_auto_gerados/views/';
	escrever($diretorioDestino.'hospital.html', $form, true);
