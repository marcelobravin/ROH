<?php
include '../../app/Grimoire/core_inc.php';

if ( !isset($_POST['email']) ) {
	die("Email inválido");
}

$condicoes = array(
	'login' => $_POST['email']
);
$user = selecionar('usuario', $condicoes);


if ( empty($user) ) {
	echo "Email não encontrado!"; # falha de segurança
} else {
	$user = $user[0];

	$token = uniqid();

	$campos = array(
		'reset'	=> $token
	);
	$rowCount = atualizar('usuario', $campos, ['id' => $user['id']]);

	if ( $rowCount == 0 ) {
		echo "Erro ao validar email!";
	} else {
		echo "Link de redefinição de senha registrado com sucesso!";
		#registrarOperacao('U', 'usuario', 0); #usuario não está na sessão
	}

}





echo '<p><a href="../../lista.php?modulo=usuario">Voltar</a></p>';





$assunto = "Redefinição de senha";
$servidor = "http://". $_SERVER['SERVER_NAME'] ."/". PROJECT_FOLDER;
$endereco = "reset-senha.php?email=". $user['login'] ."&token=". $token;
$body = '<a href="'. $servidor . $endereco .'">Clique aqui para resetar sua senha</a>';





$enviarEmail = enviarEmail($user['login'], $assunto, $body, "Nome Remetente", "Automatico");
if ( $enviarEmail == 1 ) {
	$_SESSION['mensagem'] = "Email enviado para o usuário {$_GET['id']} com sucesso!";
	voltar();
	// header('Location: '. ROOT .'lista.php?modulo=usuario');
	exit;
} else {
	echo "Erro ao enviar email para o usuário: ". $user['login'];
	echo '<p><a href="../../lista.php?modulo=usuario">Voltar</a></p>';

	if ( !PRODUCAO ) { /* em ambiente de teste exibe o conteúdo do email */
		echo "<hr>";
		echo $assunto;
		echo "<br>";
		echo $body;
	}
}
