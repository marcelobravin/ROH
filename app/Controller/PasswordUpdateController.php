<?php
include '../../app/Grimoire/core_inc.php';

$campos = array(
	'senha' => criptografar($_POST['senha1']),
	'reset' => ''
);

$condicoes = array(
	'login' => $_POST['email'],
	'reset' => $_POST['token']
);

$rowCount = atualizar('usuario', $campos, $condicoes);

if ( $rowCount == 1 ) {
	registrarOperacao('U', 'usuario', 0);

	$resposta = "Senha atualizada com sucesso!";
	montarRespostaPost($resposta, true, $codigo=201); # 201 Created
} else {
	$resposta = "Erro ao atualizar a senha do usuário!";
	montarRespostaPost($resposta, false, $codigo=201); # 201 Created
}

header('Location: ../../index.php');
