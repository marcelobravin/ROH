<?php
include '../../app/Grimoire/core_inc.php';

if ( !isset($_GET['id']) ) {
	die("Id inválido");
}



$condicoes = array(
	'id'	=> $_GET['id'],
	'token'	=> $_GET['token']
);
$user = selecionar('usuario', $condicoes);



if ( empty($user) ) {
	die("Token inválido!");
}



$user = $user[0];

$campos = array(
	'email_confirmado'	=> true,
	'token'				=> ''
);
$rowCount = atualizar('usuario', $campos, ['id' => $_GET['id']]);



if ( $rowCount == 0 ) {
	$resposta = "Erro ao validar email!";
	montarRespostaPost($resposta, false, $codigo=201); # 201 Created
} else {
	$resposta = "Email validado com sucesso!";
	montarRespostaPost($resposta, true, $codigo=201); # 201 Created
}

voltar();
