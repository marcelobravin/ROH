<?php
include '../../app/Grimoire/core_inc.php';

if ( empty($_POST) ) {
	responderAjax("Dados vazios!", false, $codigo=400); # 400 Bad Request
}


// exibir($_POST);
responderAjax('$_POST["metaId"]'. '$_POST["resultado"]', false, $codigo=400); # 400 Bad Request


$idGerado = null;
foreach ($_POST['form'] as $value) {

	$values = array(
		// 'justificativa'	=> isset($value['justificativa']) ? $value['justificativa'] : '',
	);

	// $idGerado = inserir('resultado', $values);

	// if ( !positivo($idGerado) ) {
	// 	$resposta = "Erro ao registrar resultados do mês atual";

	// 	if ( contem("Integrity constraint violation: 1062 Duplicate entry", $idGerado) ) {
	// 		$resposta .= "\nRegistro duplicado!";
	// 	}
	// 	responderAjax($resposta, false, $codigo=500);
	// }
}

# sucesso
if ( positivo($idGerado) ) {
	$resposta = "Registrados os resultados do mês atual";
	responderAjax($resposta, true, $codigo=201); # 201 Created
}

# erro
responderAjax("Parametros inválidos", false, $codigo=406); # 406 Not Acceptable
