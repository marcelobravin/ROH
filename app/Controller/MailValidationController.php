<?php
include '../../config.php';

require ROOT.'app/model/database.class.php';


if ( !isset($_GET['id']) ) {
	die("Id inválido");
}


$db = new Database();

$condicoes = array(
	'id'	=> $_GET['id'],
	'token'	=> $_GET['token']
);
$user = $db->selecionar('usuario', $condicoes);

if ( empty($user) ) {
	echo "Token inválido!";
} else {
	$user = $user[0];

	$campos = array(
		'email_confirmado'	=> true,
		'token'				=> ''
	);
	$rowCount = $db->atualizar('usuario', $campos, ['id' => $_GET['id']]);

	if ( $rowCount == 0 ) {
		echo "Erro ao validar email!";
	} else {
		echo "Email validado com sucesso!";
	}

}

echo '<p><a href="../../lista.php?modulo=usuario">Voltar</a></p>';
