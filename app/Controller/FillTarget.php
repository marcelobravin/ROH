<?php
include '../../app/Grimoire/core_inc.php';

$respostas = array();
foreach ($_POST['leitos'] as $key => $value) { #renomear para elemento id
	$values = array(
		'meta_id'				=> $key,
		'mes'					=> date('n'),
		'ano'					=> date('Y'),
		'resultado'				=> $value,
		'justificativa'			=> isset($_POST['justificativa'][$key])	? $_POST['justificativa'][$key]	: '',
		'justificativa_aceita'	=> isset($_POST['checkbox-'.$key])		? $_POST['checkbox-'.$key]		: 0,
		'criado_por'			=> $_SESSION['user']['id'],
	);

	if ( !empty($value) )
	$respostas[] = inserir('resultado', $values);
}


// echo('<pre>');
// print_r($respostas);
// echo('</pre>');
// exit;


$_SESSION['mensagem'] = "Registrados os resultados do hospital ". $_POST['hospital'] . " no mês atual";
$_SESSION['mensagemClasse'] = "sucesso";
voltar();
