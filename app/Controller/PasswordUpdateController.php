<?php
include '../../config.php';

require '../../app/model/database.class.php';
require '../../model/security.class.php';

$db = new Database();
$sec = new Security();

$campos = array(
	'senha' => $sec->criptografar($_POST['senha1']),
	'reset' => ''
);

$condicoes = array(
	'login' => $_POST['email'],
	'reset' => $_POST['token']
);

$rowCount = $db->atualizar('usuario', $campos, $condicoes);

if ( $rowCount == 1 ) {
	echo "Senha atualizada com sucesso!";
} else {
	echo "Erro ao atualizar a senha do usuário!";
}

echo '<p><a href="../../index.php">Voltar</a></p>';
