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
	$_SESSION['mensagem'] = "Senha atualizada com sucesso!";
	$_SESSION['mensagemClasse'] = "sucesso";
} else {
	$_SESSION['mensagem'] = "Erro ao atualizar a senha do usuário!";
	$_SESSION['mensagemClasse'] = "erro";
}

header('Location: ../../index.php');
