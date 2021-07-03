<?php
	include 'config.php';

	# http://localhost/roh/app/FormGenerate.php

	require 'app/model/database.class.php'; // para teste

	require 'app/lib/paginacao.php';
	require 'app/lib/formularios.php';
	require 'app/lib/snippets.php';
	require 'app/lib/html.php';
	require 'app/lib/vetores.php';

	# ========================================================================== hospital
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

	$diretorioDestino='/opt/lampp/htdocs/roh/_arquivos_auto_gerados/views/';
	escrever($diretorioDestino.'hospital.html', $form, true);
	# ========================================================================== hospital

	echo "<hr>";

	# ========================================================================== hospital
	// gerarFormulario('usuarios');
	$sobreescreverLabels = array();
	$sobreEscreverCampos = array();
	$remover = array();
	$esconder = array();
	$conversoes = array();
	$descricaoLabels = array();
	$padroes = array();

	$form = gerarFormulario('usuario',
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

	$diretorioDestino='/opt/lampp/htdocs/roh/_arquivos_auto_gerados/views/';
	escrever($diretorioDestino.'usuario.html', $form, true);
	# ========================================================================== hospital
