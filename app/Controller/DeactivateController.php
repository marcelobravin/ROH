<?php
include '../../config.php';

require '../../model/database.class.php';

$db = new Database();
$campos = array(
	'ativo' => $_GET['ativo']
);
$rowCount = $db->atualizar('usuarios', $campos, ['id' => $_GET['id']]);

if ( $rowCount == 1 ) {
	if ( $_GET['ativo'] ) {
		$_SESSION['mensagem'] = "Usuário {$_GET['id']} ativado com sucesso!";
	} else {
		$_SESSION['mensagem'] = "Usuário {$_GET['id']} desativado com sucesso!";
	}
	header('Location: ../../lista.php?modulo=usuario');
	exit;
} else {
	echo "Erro ao desativar o usuário: ". $_GET['id'];
	echo '<p><a href="../../lista.php?modulo=usuario">Voltar</a></p>';
}
