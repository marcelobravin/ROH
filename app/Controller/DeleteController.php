<?php
include '../../app/Grimoire/core_inc.php';

# TODO
# verificar se usuário tem permissão de acesso para excluir

# verificar dependências do objeto a ser excluído

# verifica se modulo existe
$whiteList = array(
	'usuario',
	'hospital'
);

if ( !in_array($_GET['modulo'], $whiteList) ) {
	$_SESSION['mensagem'] = "Módulo inválido";
	$_SESSION['mensagemClasse'] = "erro";
	exit;
}


$exclusao = excluir($_GET['modulo'], ['id'=>$_GET['id']] );

if ( $exclusao == 1 ) {
	$_SESSION['mensagem'] = "Registro de {$_GET['modulo']} número {$_GET['id']} excluído com sucesso!";
	$_SESSION['mensagemClasse'] = "sucesso";
} else {
	$_SESSION['mensagem'] = "Erro ao excluir o registro do módulo {$_GET['modulo']} número: ". $_GET['id'];
	$_SESSION['mensagemClasse'] = "erro";
}

header('Location: ../../lista.php?modulo='. $_GET['modulo']);
