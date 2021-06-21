<?php
include '../../config.php';

require '../../model/database.class.php';

$db = new Database();

$exclusao = $db->excluir('usuarios', ['id'=>$_GET['id']] );

if ( $exclusao == 1 ) {
	$_SESSION['mensagem'] = "Usuário {$_GET['id']} excluído com sucesso!";
	header('Location: ../../list.php');
	exit;
} else {
	echo "Erro ao excluir o usuário: ". $_GET['id'];
	echo '<p><a href="../../list.php">Voltar</a></p>';
}
