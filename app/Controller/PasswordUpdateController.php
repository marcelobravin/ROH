<?php
include '../../app/Grimoire/core_inc.php';


require '../../app/model/database.class.php';

$db = new Database();

$campos = array(
	'senha' => criptografar($_POST['senha1']),
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
