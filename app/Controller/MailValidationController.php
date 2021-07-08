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
	echo "Token inválido!";
} else {
	$user = $user[0];

	$campos = array(
		'email_confirmado'	=> true,
		'token'				=> ''
	);
	$rowCount = atualizar('usuario', $campos, ['id' => $_GET['id']]);

	if ( $rowCount == 0 ) {
		$_SESSION['mensagem'] = "Erro ao validar email!";
		$_SESSION['mensagemClasse'] = "sucesso";
	} else {
		$_SESSION['mensagem'] = "Email validado com sucesso!";
		$_SESSION['mensagemClasse'] = "erro";
	}
}

header('Location: ../../lista.php?modulo=usuario');
