<?php
include '../../app/Grimoire/core_inc.php';

require ROOT.'app/model/database.class.php';


if ( !isset($_GET['id']) ) {
	die("Id inválido");
}

$db = new Database();

$condicoes = array(
	'id' => $_GET['id']
);
$user = selecionar('usuario', $condicoes);
$user = $user[0];


$token = uniqid();

$assunto = "Confirmação de email";
// $servidor = "http://localhost/roh/";
$servidor = "http://". $_SERVER['SERVER_NAME'] ."/". PROJECT_FOLDER;
// $servidor = "http://localhost/PROJETOS/roh/";
$endereco = "app/Controller/MailValidationController.php?id=". $_GET['id'] ."&token=". $token;
$body = '<a href="'. $servidor . $endereco .'">Clique aqui para confirmar seu email</a>';






$campos = array(
	'token' => $token
);
$rowCount = atualizar('usuario', $campos, ['id' => $_GET['id']]);



$enviarEmail = enviarEmail($user['login'], $assunto, $body, "Nome Remetente", "Automatico");
if ( $enviarEmail == 1 ) {
	$_SESSION['mensagem'] = "Email enviado para o usuário {$_GET['id']} com sucesso!";
	header('Location: '. ROOT .'lista.php?modulo=usuario');
	exit;
} else {
	echo "Erro ao enviar email para o usuário: ". $_GET['id'];
	echo '<p><a href="../../lista.php?modulo=usuario">Voltar</a></p>';

	if ( !PRODUCAO ) { /* em ambiente de teste exibir conteúdo do email */
		echo "<hr>";
		echo $assunto;
		echo "<br>";
		echo $body;
	}
}
