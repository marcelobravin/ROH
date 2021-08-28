<?php
include '../../app/Grimoire/core_inc.php';

if ( empty($_POST) ) {
	responderAjax("Dados vazios!", false, $codigo=400); # 400 Bad Request
}

foreach ($_POST['form'] as $i => $value) {

	$values = array(
		'id_meta'		=> $value['metaId'],
		'mes'			=> date('n'),
		'ano'			=> date('Y'),
		'resultado'		=> $value['resultado'],
		'justificativa'	=> isset($value['justificativa']) ? $value['justificativa'] : '',
		'criado_por'	=> $_SESSION[USUARIO_SESSAO]['id']
	);

	$id = inserir('resultado', $values);

	if ( positivo($id) ) {
		registrarOperacao('I', 'resultado', $id);
		$resposta = "Resultados inseridos com sucesso!";
	} else {

		if ( contem("Duplicate entry", $id) ) {
			$values = array(
				'resultado'		=> $value['resultado'],
				'justificativa'	=> isset($value['justificativa']) ? $value['justificativa'] : '',
				'atualizado_por'=> $_SESSION[USUARIO_SESSAO]['id']
			);

			$where = array(
				'id_meta'		=> $value['metaId'],
				'mes'			=> date('n'),
				'ano'			=> date('Y'),
			);

			$rows = atualizar("resultado", $values, $where);

			if ( positivo($rows) ) {
				$id = localizar('resultado', $where, '', 'id');
				registrarOperacao('U', 'resultado', $id['id']);
			}

			$resposta = "Resultados atualizados com sucesso!";
		}
	}
}


# erro
responderAjax("Nenhuma alteração", 'info', $codigo=406); # 406 Not Acceptable
