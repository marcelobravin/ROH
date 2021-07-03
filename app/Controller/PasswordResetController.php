<?php
include '../../config.php';

require ROOT.'app/model/database.class.php';



// echo('<pre>');
// print_r($_POST);
// echo('</pre>');

if ( !isset($_POST['email']) ) {
	die("Email inválido");
}






$db = new Database();

$condicoes = array(
	'login' => $_POST['email']
);
$user = $db->selecionar('usuario', $condicoes);





// echo('<pre>');
// print_r($user);
// echo('</pre>');



if ( empty($user) ) {
	echo "Email não encontrado!"; # falha de segurança
} else {
	$user = $user[0];

	$token = uniqid();

	$campos = array(
		'reset'	=> $token
	);
	$rowCount = $db->atualizar('usuario', $campos, ['id' => $user['id']]);

	if ( $rowCount == 0 ) {
		echo "Erro ao validar email!";
	} else {
		echo "Link de redefinição de senha registrado com sucesso!";
	}

}





echo '<p><a href="../../lista.php?modulo=usuario">Voltar</a></p>';





$assunto = "Redefinição de senha";
$servidor = "http://localhost/roh/";
$endereco = "reset-senha.php?email=". $user['login'] ."&token=". $token;
$body = '<a href="'. $servidor . $endereco .'">Clique aqui para resetar sua senha</a>';





$enviarEmail = enviarEmail($user['login'], $assunto, $body, "Nome Remetente", "Automatico");
if ( $enviarEmail == 1 ) {
	$_SESSION['mensagem'] = "Email enviado para o usuário {$_GET['id']} com sucesso!";
	header('Location: '. ROOT .'lista.php?modulo=usuario');
	exit;
} else {
	echo "Erro ao enviar email para o usuário: ". $user['login'];
	echo '<p><a href="../../lista.php?modulo=usuario">Voltar</a></p>';


	/* em ambiente de teste exibir conteúdo do email */
	echo "<hr>";
	echo $assunto;
	echo "<br>";
	echo $body;
}
