<?php
/**
 * Construção e envio de emails
 * @package	grimoire/bibliotecas
*/

/**
 * Retorna o navegador do usuário
 * @package	grimoire/bibliotecas/email.php
 * @since	05-07-2015
 *
 * @param	string
 * @return	bool
 *
 * @see		{@link https://meetanshi.com/blog/send-mail-from-localhost-xampp-using-gmail/}
 *
 * @example
	@enviarEmail("marcelo.bravin@gmail.com", "Assunto", "Conteúdo do email", "Nome Remetente", "email@falso.com");
 */
function enviarEmail ($to, $subject="Assunto", $message="Conteúdo do email", $fromNome="Nome Remetente", $from="Automatico")
{
	$header = gerarMailHeader($subject, $fromNome, $from);
	$body = gerarMailBody($message, $subject);

	// Cada linha deve ser separada com um LF (\n). Linhas não deve ser maiores que 70 caracteres.

	// Cuidado
	// (Somente Windows) Quando PHP está usando o servidor SMTP diretamente, e uma parada total é encontrada no início de uma linha, ela é removida. Para se defender disto, substitua estas ocorrência com dois pontos seguidos.
	$body = str_replace("\n.", "\n..", $body);

	// In case any of our lines are larger than 70 characters, we should use wordwrap()
	$body = wordwrap($body, 70);

	if ( mail($to, $subject, $body, $header) ) {
		return true;
	} else {
		return error_get_last();
	}
}

/**
 * Cria headers para envio de email
 * @package	grimoire/bibliotecas/email.php
 * @since	05-07-2015
 *
 * @param	string
 * @return	bool
 *
 * @uses	$_SERVER
 * @example
	$fromNome = "MC Papel de Parede";
	$from = "marcelobravin@azclick.com.br"; #AMBTST
	$to = $_POST['email'];

	$subject = "Novo Pedido";
	$subject2 = "Pedido Realizado";

	$h = gerarMailHeader($subject, $fromNome, $from);
	$h2 = gerarMailHeader($subject2, $fromNome, $from);
 */
function gerarMailHeader ($subject, $fromNome, $from, $cc="", $bcc="", $reply="")
{
	// Correções para utf8
	$fromNome = "=?UTF-8?B?". base64_encode($fromNome) ."?=";
	$subject = "=?UTF-8?B?". base64_encode($subject) ."?=";

	$headers = array();
	$headers[] = "MIME-Version: 1.0";
	$headers[] = "Content-type: text/html; charset=utf-8";
	$headers[] = "Content-Transfer-Encoding: 7bit";
	$headers[] = "Date: " . date('r', $_SERVER['REQUEST_TIME']);

	$headers[] = "Message-ID: <" . $_SERVER['REQUEST_TIME'] . password_hash($_SERVER['REQUEST_TIME'], PASSWORD_BCRYPT) . '@' . $_SERVER['SERVER_NAME'] . ">";

	$headers[] = "From: {$fromNome} <{$from}>";

	if ( !empty($cc) ) {
		$headers[] = "Cc: {$cc}";
	}
	if ( !empty($bcc) ) {
		$headers[] = "Bcc: {$bcc}";
	}
	if ( !empty($reply) ) {
		$headers[] = "Reply-To: {$reply}";
	}

	$headers[] = "Subject: {$subject}";
	$headers[] = "Return-Path: " . $from;
	$headers[] = "X-Mailer: PHP/" . phpversion();
	$headers[] = "X-Originating-IP: " . $_SERVER['SERVER_ADDR'];
	return implode("\r\n", $headers);
}

/**
 * Retorna o navegador do usuário
 * @package	grimoire/bibliotecas/email.php
 * @since	05-07-2015
 *
 * @param	string
 * @return	bool
 *
 * @uses	$_SERVER
 */
function gerarMailBody ($conteudo, $titulo="No Subject")
{
	return '
		<html>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title>'. $titulo .'</title>
		</head>
		<body>'. $conteudo .'</body>
		</html>';
}

function enviarEmailConfirmacao ($id)
{
	$condicoes = array(
		'id' => $id
	);
	$user = localizar('usuario', $condicoes);
	if ( !$user ) {
		die("Id inválido!");
	}


	$token = uniqid();

	$assunto = "Confirmação de email";
	$servidor = PROTOCOLO ."". BASE_HTTP;
	$endereco = 'app/Controller/MailValidationController.php?id='. $id .'&token='. $token;
	$body = '<a href="'. $servidor . $endereco .'">Clique aqui para confirmar seu email</a>';


	$campos = array(
		'token' => $token
	);
	$rowCount = atualizar('usuario', $campos, ['id' => $id]);


	if ( !$rowCount ) {
		die("Erro ao atualizar token");
	}

	return array(
		'envio' 	=> enviarEmail($user['login'], $assunto, $body, "ROH Remetente", "Automatico"),
		'assunto'	=> $assunto,
		'servidor'	=> $servidor,
		'endereco'	=> $endereco,
		'body'		=> $body
	);
}
