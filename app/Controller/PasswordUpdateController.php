<?php
include '../../app/Grimoire/core_inc.php';

$campos = array(
	'senha' => criptografar($_POST['senha1']),
	'reset' => ''
);

$condicoes = array(
	'login' => $_POST['email']
);

$usuario = localizar('usuario', $condicoes);

if ( !empty($usuario) ) {

	if ( $usuario['reset'] == $_POST['token'] ) {
		atualizar('usuario', $campos, $condicoes);
		registrarOperacao('U', 'usuario', $usuario['id'], $usuario['id']);

		$resposta = "Senha atualizada com sucesso!";
		montarRespostaPost($resposta, true, $codigo=201); # 201 Created
	} else {
		$resposta = "Token inválido!";
		montarRespostaPost($resposta, false, $codigo=201); # 201 Created
	}
} else {

	$resposta = "Erro ao atualizar a senha do usuário!";
	montarRespostaPost($resposta, false, $codigo=201); # 201 Created
}

header('Location: ../../index.php');
