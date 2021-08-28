<?php
include '../../app/Grimoire/core_inc.php';

if ( empty($_POST) ) {
	responderAjax("Dados vazios!", false, $codigo=400); # 400 Bad Request
}

$in_mesAtual = mesAtual();
$in_anoAtual = anoAtual();


$resultado = array();
foreach ($_POST['form'] as $value) {
	$campos = array(
		'justificativa_aceita' => ($value['estado']=='true') ? 1 : 0
	);

	$condicoes = array(
		"id_meta"	=> $value['metaId'],
		"mes"		=> $in_mesAtual,
		"ano"		=> $in_anoAtual
	);

	$resultado[$value['metaId']] = atualizar("resultado", $campos, $condicoes);
}


foreach ($resultado as $key => $value) {
	# sucesso
	if ( positivo($value) ) {
		$resposta = "Registrado o estado de aceitação das justificativas do mês atual";
		responderAjax($resposta, true, $codigo=201); # 201 Created
	}
}

# nenhuma alteração
$resposta = "Nenhuma alteração realizada";
responderAjax($resposta, 'info', $codigo=201); # 201 Created
