<?php
include '../../config.php';

require ROOT.'model/database.class.php';


if ( !isset($_GET['id']) ) {
	die("Id inválido");
}


$db = new Database();

$condicoes = array(
	'id'	=> $_GET['id'],
	'token'	=> $_GET['token']
);
$user = $db->selecionar('usuarios', $condicoes);

if ( empty($user) ) {
	echo "Token inválido!";
} else {
	$user = $user[0];

	$campos = array(
		'email_confirmado'	=> true,
		'token'				=> ''
	);
	$rowCount = $db->atualizar('usuarios', $campos, ['id' => $_GET['id']]);

	if ( $rowCount == 0 ) {
		echo "Erro ao validar email!";
	} else {
		echo "Email validado com sucesso!";
	}

}

echo '<p><a href="../../list.php">Voltar</a></p>';
