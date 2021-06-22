<?php
include '../../config.php';

require '../../model/database.class.php';
require '../../model/security.class.php';

$db = new Database();
$sec = new Security();

$campos = array(
	'senha' => $sec->criptografar($_POST['senha1']),
	'reset' => ''
);
$rowCount = $db->atualizar('usuarios', $campos, ['login' => $_POST['email']]);

if ( $rowCount == 1 ) {
	echo "Senha atualizada com sucesso!";
} else {
	echo "Erro ao atualizar a senha do usuário!";
}

echo '<p><a href="../../index.php">Voltar</a></p>';
