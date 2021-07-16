<?php
include '../../app/Grimoire/core_inc.php';

$campos = array(
	'ativo' => $_GET['ativo']
);
$rowCount = atualizar($_GET['modulo'], $campos, ['id' => $_GET['id']]);

if ( $rowCount == 1 ) {
	$_SESSION['mensagemClasse'] = "sucesso";

	if ( $_GET['ativo'] ) {
		$_SESSION['mensagem'] = $_GET['modulo']. " {$_GET['id']} ativado com sucesso!";
	} else {
		$_SESSION['mensagem'] = $_GET['modulo']. " {$_GET['id']} desativado com sucesso!";
	}
} else {
	$_SESSION['mensagem'] = "Erro ao desativar o : ". $_GET['modulo'] ." " . $_GET['id'];
	$_SESSION['mensagemClasse'] = "erro";
}

voltar();
// header('Location: ../../lista.php?modulo=usuario');
