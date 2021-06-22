<?php
include '../../config.php';

require ROOT.'model/database.class.php';


if ( !isset($_GET['id']) ) {
	die("Id inválido");
}

$db = new Database();

$condicoes = array(
	'id' => $_GET['id']
);
$user = $db->selecionar('usuarios', $condicoes);
$user = $user[0];


$token = uniqid();

$assunto = "Confirmação de email";
$servidor = "http://localhost/ROH/";
$endereco = "app/Controller/MailValidationController.php?id=". $_GET['id'] ."&token=". $token;
$body = '<a href="'. $servidor . $endereco .'">Clique aqui para confirmar seu email</a>';






$campos = array(
	'token' => $token
);
$rowCount = $db->atualizar('usuarios', $campos, ['id' => $_GET['id']]);



$enviarEmail = enviarEmail($user['login'], $assunto, $body, "Nome Remetente", "Automatico");
if ( $enviarEmail == 1 ) {
	$_SESSION['mensagem'] = "Email enviado para o usuário {$_GET['id']} com sucesso!";
	header('Location: '. ROOT .'list.php');
	exit;
} else {
	/* em ambiente de teste exibir conteúdo do email */






	echo "Erro ao enviar email para o usuário: ". $_GET['id'];
	echo '<p><a href="../../list.php">Voltar</a></p>';
}
