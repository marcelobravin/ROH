<?php
include '../../config.php';

require '../../app/model/database.class.php';

$db = new Database();

$exclusao = $db->excluir('usuario', ['id'=>$_GET['id']] );

if ( $exclusao == 1 ) {
	$_SESSION['mensagem'] = "Usuário {$_GET['id']} excluído com sucesso!";
	header('Location: ../../lista.php?modulo=usuario');
	exit;
} else {
	echo "Erro ao excluir o usuário: ". $_GET['id'];
	echo '<p><a href="../../lista.php?modulo=usuario">Voltar</a></p>';
}
