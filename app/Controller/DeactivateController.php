<?php
include '../../app/Grimoire/core_inc.php';

$campos = array(
	'ativo' => $_GET['ativo']
);
$rowCount = atualizar('usuario', $campos, ['id' => $_GET['id']]);

if ( $rowCount == 1 ) {
	$_SESSION['mensagemClasse'] = "sucesso";

	if ( $_GET['ativo'] ) {
		$_SESSION['mensagem'] = "Usuário {$_GET['id']} ativado com sucesso!";
	} else {
		$_SESSION['mensagem'] = "Usuário {$_GET['id']} desativado com sucesso!";
	}
} else {
	$_SESSION['mensagem'] = "Erro ao desativar o usuário: ". $_GET['id'];
	$_SESSION['mensagemClasse'] = "erro";
}

header('Location: ../../lista.php?modulo=usuario');
