<?php
include '../../app/Grimoire/core_inc.php';


if ( !isset($_GET['id']) ) {
	die("Id inválido");
}


$condicoes = array(
	'id' => $_GET['id']
);
$user = selecionar('usuario', $condicoes);


if ( !isset($_GET['id']) ) {
	die("Id inválido");
}

if ( !$user ) {
	die("Id inválido");
}

$user = $user[0];

$token = uniqid();

$assunto = "Confirmação de email";
$servidor = "https://". $_SERVER['SERVER_NAME'] ."/". PROJECT_FOLDER;
$endereco = "app/Controller/MailValidationController.php?id=". $_GET['id'] ."&token=". $token;
$body = '<a href="'. $servidor . $endereco .'">Clique aqui para confirmar seu email</a>';




$campos = array(
	'token' => $token
);
$rowCount = atualizar('usuario', $campos, ['id' => $_GET['id']]);



$enviarEmail = enviarEmail($user['login'], $assunto, $body, "Nome Remetente", "Automatico");


if ( $enviarEmail ) {
	$resposta = "Email enviado para o usuário {$_GET['id']} com sucesso!";
	montarRespostaPost($resposta, true, $codigo=201); # 201 Created
	voltar();
	// header('Location: '. BASE .'lista.php?modulo=usuario');
} else {
	echo "Erro ao enviar email para o usuário: ({$user['login']}) ". $_GET['id'];
	echo '<p><a href="../../lista.php?modulo=usuario">Voltar</a></p>';

	if ( !PRODUCAO ) { /* em ambiente de teste exibir conteúdo do email */
		echo "<hr>";
		echo $assunto;
		echo "<br>";
		echo $body;
	}
}

exit;
