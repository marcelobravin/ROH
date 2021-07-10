<?php
include '../../app/Grimoire/core_inc.php';

foreach ($_POST['leitos'] as $key => $value) { #renomear para elemento id
	$values = array(
		'meta_id'				=> $key,
		'mes'					=> $_POST['mes'],
		'resultado'				=> $value,
		'justificativa'			=> isset($_POST['justificativa'][$key])	? $_POST['justificativa'][$key]	: '',
		'justificativa_aceita'	=> isset($_POST['checkbox-'.$key])		? $_POST['checkbox-'.$key]		: 0,
		'criado_por'			=> $_SESSION['user']['id'],

	);

	$id = inserir('resultado', $values);

	if ( is_numeric($id) )
		unset($_POST['leitos'][$key]);
}

$_SESSION['mensagem'] = "Registrados os resultados do hospital ". $_POST['hospital'] . " no o mês atual";
$_SESSION['mensagemClasse'] = "sucesso";
// header('Location: ../../metas.php');
voltar();
