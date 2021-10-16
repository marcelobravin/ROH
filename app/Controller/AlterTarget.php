<?php
include '../../app/Grimoire/core_inc.php';

if ( empty($_POST) ) {
	responderAjax("Dados vazios!", false, $codigo=400); # 400 Bad Request
}

$resposta = "Nenhuma alteração";
$resultados = array();

foreach ($_POST['form']['metas'] as $i => $value) {

	$values = array(
		'resultado'			=> $value['resultado'],
		'justificativa'		=> isset($value['justificativa']) ? $value['justificativa'] : '',
		'atualizado_por'	=> $_SESSION[USUARIO_SESSAO]['id']
	);

	$criterios = array(
		'id_meta'		=> $value['metaId'],
		'mes'			=> $_POST['form']['data']['mes'],
		'ano'			=> $_POST['form']['data']['ano'],
		'dia'			=> $_POST['form']['data']['dia']
	);

	$id = atualizar('visita', $values, $criterios);

	if ( positivo($id) ) {
		$resultados[] = $id;

		registrarOperacao('U', 'visita', $id);
		$resposta = "Resultados atualizados com sucesso!";
	}
}

if ( empty($resultados) ) {
	responderAjax($resposta, 'info', $codigo=406); # 406 Not Acceptable;
} else {
	responderAjax($resposta, true, $codigo=406); # 406 Not Acceptable
}
