<?php
include '../../config.php';

require '../../model/database.class.php';

$db = new Database();

$condicoes = array(
	'login' => $_POST['login']
);
$user = $db->selecionar('usuarios', $condicoes);


if ( empty($user) ) {
	echo '<p>Dados incorretos.</p>';
} else {
	$user = $user[0];
	$ip = identificarIP();
	$browser = getBrowser();

	bloquearForcaBruta($user['id'], $db);

	if ( password_verify($_POST['senha'], $user['senha']) ) {
		$acesso = registrarAcesso($user['id'], $ip, $browser, 1);
		$stm = $db->getConnection()->prepare($acesso);
		$stm->execute();

		verificarTempoAtividadeSessao();
		unset($user['senha']);
		$_SESSION['user'] = $user;

		# TODO: apagar logs de erro deste usuário

		header("Location: ../../index.php");
		exit;
	} else {
		$falhaAcesso = registrarAcesso($user['id'], $ip, $browser, 0);
		$stm = $db->getConnection()->prepare($falhaAcesso);
		$stm->execute();
		echo '<p>Dados incorretos.</p>';

/*
		echo "<br>";
		// hora atual
		echo date('h:i:s') . "\n";
		// espera dois segundos
		usleep(1000000);
		// de volta!
		echo date('h:i:s') . "\n";
*/
	}
}

echo date('h:i:s') . "\n"; // hora atual
echo "<br>";
usleep(1000000); // espera dois segundos
echo date('h:i:s') . "\n"; // de volta!

?>

<p>
	<a href="../../index.php">voltar</a>
</p>


<?php

/**
 * Registra acesso ao banco
 * @package grimoire/bibliotecas/acesso.php
 * @since	05-07-2015
 * @version	17-06-2021
 *
 * @param	string
 * @return	bool
 *
 * @uses	acesso.php->identificarIP()
 * @uses	persistencia.php->executar()
 * @example
	gravarLog(1, "U", "produto", 15);
	registrarOperacao("15", "C/R/U/D", "produto", "29");
 */
function registrarAcesso($usuarioId, $ip, $browser, $sucesso=true) {
	$browser = json_encode($browser);
	return "INSERT INTO _log_acesso (usuarioId, sucesso, ip, navegador)
		VALUES ($usuarioId, $sucesso, '$ip', '$browser')
	";
}

/**
 * Registra operação nos modelos
 * @package grimoire/bibliotecas/acesso.php
 * @since	05-07-2015
 * @version	17-06-2021
 *
 * @param	string
 * @return	bool
 *
 * @uses	acesso.php->identificarIP()
 * @uses	persistencia.php->executar()
 * @example
	gravarLog(1, "U", "produto", 15);
	registrarOperacao("15", "C/R/U/D", "produto", "29");
 */
function registrarOperacao ($acao, $tabela, $recursoId) {

	$sql = "CREATE TABLE IF NOT EXISTS _log_operacoes (
		id			INT(11)		PRIMARY KEY AUTO_INCREMENT,
		usuarioId	INT(11)		NOT NULL,
		acao		CHAR		NOT NULL,
		tabela		VARCHAR(50) NOT NULL,
		objetoId	INT(11)		NOT NULL,
		ip			VARCHAR (15),
		datahora	TIMESTAMP	NOT NULL DEFAULT CURRENT_TIMESTAMP
	);";
	executar($sql);

	$sql = "INSERT INTO _log_operacoes (_usuarioId, acao, tabela, objetoId, ip, dataHora)
			VALUES ('$usuarioId', '$acao', '$tabela', '$recursoId', '$ip')";
	executar($sql);
}

/**
 * Pega o endereço de IP do usuário
 * @package	grimoire/bibliotecas/acesso.php
 * @since	05-07-2015
 * @version	21/02/2017
 *
 * @return	string
 *
 * @uses	$_SERVER
 */
function identificarIP () {
	if ( isset($_SERVER['HTTP_CLIENT_IP']) )			return $_SERVER['HTTP_CLIENT_IP'];
	else if( isset($_SERVER['HTTP_CF_CONNECTING_IP']) )	return $_SERVER['HTTP_CF_CONNECTING_IP']; # when behind cloudflare
	else if( isset($_SERVER['HTTP_X_FORWARDED_FOR']) )	return $_SERVER['HTTP_X_FORWARDED_FOR'];
	else if( isset($_SERVER['HTTP_X_FORWARDED']) )		return $_SERVER['HTTP_X_FORWARDED'];
	else if( isset($_SERVER['HTTP_FORWARDED_FOR']) )	return $_SERVER['HTTP_FORWARDED_FOR'];
	else if( isset($_SERVER['HTTP_FORWARDED']) )		return $_SERVER['HTTP_FORWARDED'];
	else if( isset($_SERVER['REMOTE_ADDR']) )			return $_SERVER['REMOTE_ADDR'];
	else return '0.0.0.0';
}

/**
 * Verifica o tempo de inatividade da sessão
 * @param   string
 * @return  bool
 *
 * @uses	$_SESSION
 */
function verificarTempoAtividadeSessao () {
	// Registra atividade da sessão
	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) { // last request was more than 30 minutes ago
		session_unset(); // unset $_SESSION variable for the run-time
		session_destroy(); // destroy session data in storage
	}
	$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

	// Recria Sessão a cada 30 min evitando ataques de sequestro de sessão
	if (!isset($_SESSION['CREATED'])) {
		$_SESSION['CREATED'] = time();
	} else if (time() - $_SESSION['CREATED'] > 1800) { // session started more than 30 minutes ago
		session_regenerate_id(true); // change session ID for the current session an invalidate old session ID
		$_SESSION['CREATED'] = time(); // update creation time
	}
}

function getBrowser () {
	$u_agent	= $_SERVER['HTTP_USER_AGENT'];
	$bname		= 'Unknown';
	$platform	= 'Unknown';
	$version	= "";

	//First get the platform?
	if (preg_match('/linux/i', $u_agent))
		$platform = 'linux';
	elseif (preg_match('/macintosh|mac os x/i', $u_agent))
		$platform = 'mac';
	elseif (preg_match('/windows|win32/i', $u_agent))
		$platform = 'windows';

	// Next get the name of the useragent yes seperately and for good reason
	if (preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) {
		$bname = 'Internet Explorer';
		$ub = "MSIE";
	} elseif (preg_match('/Firefox/i',$u_agent)) {
		$bname = 'Mozilla Firefox';
		$ub = "Firefox";
	} elseif (preg_match('/Chrome/i',$u_agent)) {
		$bname = 'Google Chrome';
		$ub = "Chrome";
	} elseif (preg_match('/Safari/i',$u_agent)) {
		$bname = 'Apple Safari';
		$ub = "Safari";
	} elseif (preg_match('/Opera/i',$u_agent)) {
		$bname = 'Opera';
		$ub = "Opera";
	} elseif (preg_match('/Netscape/i',$u_agent)) {
		$bname = 'Netscape';
		$ub = "Netscape";
	}

	// finally get the correct version number
	$known = array('Version', $ub, 'other');
	$pattern = '#(?<browser>' . join('|', $known) .
	')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
	if (!preg_match_all($pattern, $u_agent, $matches)) {
		// we have no matching number just continue
	}

	// see how many we have
	$i = count($matches['browser']);
	if ($i != 1) {
		//we will have two since we are not using 'other' argument yet
		//see if version is before or after the name
		if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
			$version= $matches['version'][0];
		} else {
			$version= $matches['version'][1];
		}
	} else {
		$version= $matches['version'][0];
	}

	// check if we have a number
	if ($version==null || $version=="") {$version="?";}

	return array(
		'userAgent'	=> $u_agent,
		'name'		=> $bname,
		'version'	=> $version,
		'platform'	=> $platform,
		'pattern'	=> $pattern
	);
}

function bloquearForcaBruta ($id, $db) {

	$newTime = strtotime('-15 minutes');
	$dt = date('Y-m-d H:i:s', $newTime);

	$sql = "SELECT * FROM _log_acesso
		WHERE
			usuarioId = {$id}
			AND sucesso = 0
			AND datahora > '{$dt}'
	";
	$stm = $db->getConnection()->prepare($sql);
	$stm->execute();
	$x = $stm->rowCount();

	if ( $x >= 3) {
		echo "<p>Tentativas de login incorretas: {$x}</p>";
		die("Usuário bloqueado temporariamente!");
	}
}
