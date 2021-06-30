<?php
define('PRODUCAO'		, false);
define('PROJECT_FOLDER'	, 'ROH');


if ( PRODUCAO ) {
	ini_set('display_errors'		, 0);
	ini_set('display_startup_errors', 0);
} else {
	ini_set('display_errors'		, 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}


define('WEB_SERVER_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('ROOT'           , WEB_SERVER_ROOT .'/'. PROJECT_FOLDER .'/' );



$env = parse_ini_file(ROOT ."/.env"); #----------------------------------------- credenciais de DB

date_default_timezone_set('america/sao_paulo');
session_start();








# Funções universais ===========================================================
// /**
//  * Remove um índice da sessão e retorna o conteúdo
//  * @package	grimoire/bibliotecas/vetores.php
//  * @since	05-07-2015
//  * @version	15-06-2021
//  *
//  * @param	string
//  * @return	string
//  */
// function esvaziarMensagem($indice="mensagem") {
// /*
// 	if(session_id() == '') { // For versions of PHP prior to PHP 5.4.0:
// 		// session isn't started
// 	}
// */
// 	if (session_status() === PHP_SESSION_NONE) {
// 		session_start();
// 	}

// 	$retorno = "";
// 	if (isset($_SESSION[$indice])) {
// 		$retorno = $_SESSION[$indice];
// 		unset($_SESSION[$indice]);
// 	}

// 	return $retorno;
// }

/**
 * Retorna o navegador do usuário
 * @package grimoire/bibliotecas/email.php
 * @version 05-07-2015
 *
 * @param   string
 * @return  bool
 *
 * @uses    $_SERVER
 */
// @enviarEmail("marcelo.bravin@gmail.com", "Assunto", "Conteúdo do email", "Nome Remetente", "email@falso.com");
function enviarEmail ($to, $subject="Assunto", $message="Conteúdo do email", $fromNome="Nome Remetente", $from="Automatico") {
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
 * @package grimoire/bibliotecas/email.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	bool
 *
 * @uses	$_SERVER
 */
/*
$fromNome = "MC Papel de Parede";
$from = "marcelobravin@azclick.com.br"; #AMBTST
$to = $_POST['email'];

$subject = "Novo Pedido";
$subject2 = "Pedido Realizado";

$h = gerarMailHeader($subject, $fromNome, $from);
$h2 = gerarMailHeader($subject2, $fromNome, $from);
*/
# Headers======================================
function gerarMailHeader($subject, $fromNome, $from) {
	// Correções para utf8
	$fromNome = "=?UTF-8?B?". base64_encode($fromNome) ."?=";
	$subject = "=?UTF-8?B?". base64_encode($subject) ."?=";

	$headers = array();
	$headers[] = "MIME-Version: 1.0";
	$headers[] = "Content-type: text/html; charset=utf-8";
	$headers[] = "Content-Transfer-Encoding: 7bit";
	$headers[] = "Date: " . date('r', $_SERVER['REQUEST_TIME']);
	$headers[] = "Message-ID: <" . $_SERVER['REQUEST_TIME'] . md5($_SERVER['REQUEST_TIME']) . '@' . $_SERVER['SERVER_NAME'] . ">";

	$headers[] = "From: {$fromNome} <{$from}>";
	// $headers[] = "Cc: birthdayarchive@example.com";
	// $headers[] = "Bcc: JJ Chong <bcc@domain2.com>";
	// $headers[] = "Reply-To: Recipient Name <receiver@domain3.com>";
	$headers[] = "Subject: {$subject}";
	$headers[] = "Return-Path: " . $from;
	$headers[] = "X-Mailer: PHP/" . phpversion();
	$headers[] = "X-Originating-IP: " . $_SERVER['SERVER_ADDR'];
	return implode("\r\n", $headers);
}

/**
 * Retorna o navegador do usuário
 * @package grimoire/bibliotecas/email.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	bool
 *
 * @uses	$_SERVER
 */
function gerarMailBody($conteudo, $titulo="No Subject") {
	return '
		<html>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title>'. $titulo .'</title>
		</head>
		<body>'. $conteudo .'</body>
		</html>';
}

// function backtrace() {

// 	$callers = debug_backtrace();
// 	$arrBacktrace = array();
// 	$callersNum = count($callers);

// 	echo('<pre>');
// 	print_r($callers);
// 	echo('</pre>');

// 	for ($i = 1; $i < $callersNum; $i++) {
// 		$arrBacktrace[] = sprintf('%s::%s(%d)', $callers[$i]['class'], $callers[$i]['function'], $callers[$i]['line']);
// 	}

// 	return implode('->', $arrBacktrace);
// }

// function lancarExcecao( $mssg ) {
// 	backtrace();
// 	throw new Exception($mssg);
// }
