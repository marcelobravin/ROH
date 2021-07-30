<?php
/**
 * Controle de acesso
 * @package	grimoire/bibliotecas
*/

/**
 * Bloqueia o acesso de usuários conforme critério solicitado e redireciona para a página de destino
 * @package	grimoire/bibliotecas/acesso.php
 * @version	17-07-2015
 *
 * @param	bool	bloquear usuários logados ou deslogados
 * @param	string
 *
 * @uses	acesso.php->logado()
 */
function bloquear ($criterio=FALSE, $destino=PAGINA_INICIAL)
{
	$logado = logado();
	if ( !$criterio ) {
		if ( !$logado ) { # Bloqueia acesso de usuários deslogados
			redirecionar($destino);
		}
	} else {
		if ( $logado ) { # Bloqueia acesso de usuários logados
			redirecionar($destino);
		}
	}
}

/**
 * Bloqueia usuários não logados nas páginas internas e redireciona para a página inicial
 * @package	grimoire/bibliotecas/acesso.php
 * @since	21/07/2021 16:26:30
 *
 * @param	array	whitelist de páginas internas, onde não haverá bloqueio
 *
 * @uses	configuracoes.php->LOGADO
 * @uses	acesso.php->paginaAtual()
 * @uses	acesso.php->redirecionar()
 */
function bloquearAcesso ($paginasExternas)
{
	if ( !in_array(paginaAtual(), $paginasExternas) && !LOGADO ) {
		redirecionar();
	}
}

function configurarCookies ()
{
	if (PHP_VERSION_ID < 70300) {
		// ! Deve obedecer as regras abaixo
		session_set_cookie_params(SESSAO_TTL, '/; samesite='.PROJECT_NAME, $_SERVER['HTTP_HOST'], true, true);
	} else {
		session_set_cookie_params([
			'lifetime'	=> SESSAO_TTL,
			'path'		=> '/',
			'domain'	=> $_SERVER['HTTP_HOST'],
			'secure'	=> true, // if you only want to receive the cookie over HTTPS
			'httponly'	=> true, // prevent JavaScript access to session cookie
			'samesite'	=> PROJECT_NAME
		]);
	}
}

function configurarExibicaoErros ($conf=PRODUCAO)
{
	if ( $conf ) {
		ini_set('display_errors'		, 0);
		ini_set('display_startup_errors', 0);
	} else {
		ini_set('display_startup_errors', 1);
		ini_set('display_errors'		, TRUE);
		ini_set('error_reporting'		, E_ALL);
		error_reporting(E_ALL);
	}
}

/**
 * Retorna o navegador do usuário
 * @package	grimoire/bibliotecas/acesso.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	bool
 *
 * @uses	$_SERVER
 */
function identificarNavegador ()
{
	$u_agent = $_SERVER['HTTP_USER_AGENT'];
	$bname = 'Unknown';
	$platform = 'Unknown';
	$version= "";

	//First get the platform?
	if (preg_match('/linux/i', $u_agent)) {
		$platform = 'linux';
	} elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
		$platform = 'mac';
	} elseif (preg_match('/windows|win32/i', $u_agent)) {
		$platform = 'windows';
	}
	// Next get the name of the useragent yes seperately and for good reason
	if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) {
		$bname = 'Internet Explorer';
		$ub = "MSIE";
	} elseif(preg_match('/Firefox/i',$u_agent)) {
		$bname = 'Mozilla Firefox';
		$ub = "Firefox";
	} elseif(preg_match('/Chrome/i',$u_agent)) {
		$bname = 'Google Chrome';
		$ub = "Chrome";
	} elseif(preg_match('/Safari/i',$u_agent)) {
		$bname = 'Apple Safari';
		$ub = "Safari";
	} elseif(preg_match('/Opera/i',$u_agent)) {
		$bname = 'Opera';
		$ub = "Opera";
	} elseif(preg_match('/Netscape/i',$u_agent)) {
		$bname = 'Netscape';
		$ub = "Netscape";
	}

	// finally get the correct version number
	$known = array('Version', $ub, 'other');
	$pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
	if (!preg_match_all($pattern, $u_agent, $matches)) {
		// we have no matching number just continue
	}

	// see how many we have
	$i = count($matches['browser']);
	if ($i != 1) {
		//we will have two since we are not using 'other' argument yet
		//see if version is before or after the name
		if (strripos($u_agent,"Version") < strripos($u_agent,$ub)) {
			$version= $matches['version'][0];
		} else {
			$version= $matches['version'][1];
		}

	} else {
		$version= $matches['version'][0];
	}

	// check if we have a number
	if ($version==null || $version=="") {
		$version="?";
	}

	return array(
		'userAgent'	=> $u_agent,
		'name'		=> $bname,
		'version'	=> $version,
		'platform'	=> $platform,
		'pattern'	=> $pattern
	);
}

/**
 * Identifica e retorna o navegador do usuário
 * @package	grimoire/bibliotecas/acesso.php
 * @version	05-07-2015
 *
 * @return	array
 *
 * @uses	$_SERVER
 */
function identificarNavegador2 ()
{
	$var = $_SERVER['HTTP_USER_AGENT'];
	$info['browser'] = "OTHER";
	// valid brosers array
	$browser = array(
		"MSIE", "OPERA", "FIREFOX", "MOZILLA", "NETSCAPE", "SAFARI", "LYNX", "KONQUEROR"
	);
	// bots = ignore
	$bots = array(
		'GOOGLEBOT', 'MSNBOT', 'SLURP'
	);
	foreach ($bots as $bot) {
		// if bot, returns OTHER
		if ( !strpos(strtoupper($var), $bot) ) {
			return $info;
		}
	}
	// loop the valid browsers
	foreach ($browser as $parent) {
		$s = strpos(strtoupper($var), $parent);
		$f = $s + strlen($parent);
		$version = substr($var, $f, 5);
		$version = preg_replace('/[^0-9,.]/', '', $version);
		if ( !strpos(strtoupper($var), $parent) ) {
			$info['browser'] = $parent;
			$info['version'] = $version;
			return $info;
		}
	}
	return $info;
}

/**
 * Pega o endereço de IP do usuário
 * @package	grimoire/bibliotecas/acesso.php
 * @since	05-07-2015
 * @version	21/06/2017
 *
 * @return	string
 *
 * @uses	$_SERVER
 */
function identificarIP ()
{
	// default unreliable ip
	$ip = $_SERVER['REMOTE_ADDR'];

	// check for shared internet/ISP IP
	if (!empty($_SERVER['HTTP_CLIENT_IP']) && validarIp($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}
	# when behind cloudflare
	else if( isset($_SERVER['HTTP_CF_CONNECTING_IP']) )	{
		$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
	}
	# check for IPs passing through proxies
	elseif ( !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
		# check if multiple ips exist in var
		if ( !strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') ) {
			$iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

			foreach ($iplist as $ipCurrent) {
				if ( validarIp($ipCurrent) ) {
					$ip = $ipCurrent;
				}
			}
		} else {
			if (validarIp($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}
		}
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED']) && validarIp($_SERVER['HTTP_X_FORWARDED'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED'];
	} elseif (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validarIp($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_FORWARDED_FOR']) && validarIp($_SERVER['HTTP_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_FORWARDED_FOR'];
	} elseif (!empty($_SERVER['HTTP_FORWARDED']) && validarIp($_SERVER['HTTP_FORWARDED'])) {
		$ip = $_SERVER['HTTP_FORWARDED'];
	}

	return $ip;
}

/**
 * Verifica se o usuário está registrado na sessão
 * @package	grimoire/bibliotecas/acesso.php
 * @version	17-07-2015
 *
 * @return	bool
 *
 * @uses	acesso.php->iniciarSessao()
 */
function logado ($indice='usuario_logado')
{
	iniciarSessao();
	return isset($_SESSION[$indice]);
}

/**
 * Bloqueia o acesso de usuários conforme critério solicitado e redireciona para a página de destino
 * @package	grimoire/bibliotecas/acesso.php
 * @version	17-07-2015
 *
 * @param	bool	bloquear usuários logados ou deslogados
 * @param	string
 *
 * @uses	acesso.php->logado()
 */
function login ($login, $senha)
{
	$condicoes = array(
		'login' => $login
	);
	$campos = array(
		'id',
		'login',
		'senha',
		'email_confirmado',
		'token',
		'ativo',
		'reset',
		'telefone',
		'nome',
		'endereco',
		'cpf'
	);
	$user = selecionar('usuario', $condicoes, "", $campos);

	if ( empty($user) ) {
		password_verify('senha', 'senhaStub'); # operacao custosa para não sinalizar retorno muito rápido
		return false;

	} else {
		$user = $user[0];
		$ip = identificarIP();
		$browser = getBrowser();

		$conn = conectar();

		bloquearForcaBruta($user['id'], $conn);

		if ( password_verify($senha, $user['senha']) ) {
			$acesso = registroDeAcesso($user['id'], $ip, $browser, 1);
			$stm = $conn->prepare($acesso);
			$stm->execute();

			criarSessao();
			unset($user['senha']);
			$_SESSION['user'] = $user;
			return true;
		} else {
			$falhaAcesso = registroDeAcesso($user['id'], $ip, $browser, 0);
			$stm = $conn->prepare($falhaAcesso);
			$stm->execute();
		}
	}

	return false;
}

/**
 * Realiza log out do usuário no sistema
 * @package	grimoire/bibliotecas/acesso.php
 * @version	05-07-2015
 *
 * @param	string
 *
 * @uses	$_SESSION
 */
function logOut ($url="index.php")
{
	encerrarSessao();
	redirecionar($url);
}

/**
 * Retorna para página anterior
 * @package	grimoire/bibliotecas/acesso.php
 * @since 08/07/2021 11:00:08
 *
 * @uses	$_SERVER
 */
function voltar ()
{
	redirecionar( $_SERVER['HTTP_REFERER'] );
}

/**
 * Recarrega a página atual
 * @package	grimoire/bibliotecas/acesso.php
 * @since 08/07/2021 11:03:11
 *
 * @param	bool/null/string
 * @param	bool
 *
 * @uses	$_SERVER
 */
function recarregar ($descartarParametros=false)
{
	if ( $descartarParametros ) {
		$url = explode("?", $_SERVER['PHP_SELF']);
		$url = $url[0];
	} else {
		$url = $_SERVER['PHP_SELF'];
	}

	redirecionar($url);
}

function redirecionamentoTemporal ($destino="index.php", $tempo=5)
{
	header( "refresh:{$tempo};url={$destino}" );
	echo 'Você será redirecionado em <span id="c">'.$tempo.'</span> segundos.<br>Caso contrário, clique <a href="'. $destino .'">aqui</a>.';
	contagem($tempo, 'c');
}

/**
 * Redireciona para página solicitada via php (se possível) ou javascript e html
 * @package	grimoire/bibliotecas/acesso.php
 * @since	05-07-2015
 * @version	08/07/2021 10:57:15
 *
 * @param	string
 */
function redirecionar ($url=PAGINA_INICIAL)
{
	if ( !file_exists( BASE.$url ) ) {
		pp("Página inexistente");
		die($url);
	}

	$url = PROTOCOLO.BASE_HTTP.$url;

	if ( headers_sent() ) {
		echo '<script type="text/javascript">window.location=\'' . $url . '\';</script>';
		echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0; URL='". $url ."'\">";
	} else {
		header('Location: ' . $url);
	}
	exit;
}

/**
 * Verifica o tempo de inatividade da sessão
 * @package	grimoire/bibliotecas/acesso.php
 * @since	05-07-2015
 * @version	08/07/2021 10:57:15
 * @uses	$_SESSION
 */
function verificarTempoAtividadeSessao ()
{
	// Registra atividade da sessão
	if (isset($_SESSION['LAST_ACTIVITY']) && time() - $_SESSION['LAST_ACTIVITY'] > SESSAO_TTL ) { // last request was more than 30 minutes ago
		encerrarSessao();
		redirecionamentoTemporal();
		exit;
	}

	$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

	// Recria sessão a cada solicitação evitando ataques de sequestro de sessão
	if ( !isset($_SESSION['CREATED']) ) {
		$_SESSION['CREATED'] = time();
	}
}

/**
 * Verifica o tempo de inatividade da sessão
 * @package	grimoire/bibliotecas/acesso.php
 * @since	05-07-2015
 * @version	08/07/2021 10:57:15
 * @uses	$_SESSION
 */
function criarSessao ()
{
	$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
	$_SESSION['CREATED'] = time();
}

/**
 * Bloqueia o acesso de usuários conforme critério solicitado e redireciona para a página de destino
 * @package	grimoire/bibliotecas/acesso.php
 * @version	17-07-2015
 *
 * @param	bool	bloquear usuários logados ou deslogados
 * @param	string
 *
 * @uses	acesso.php->logado()
 */
function getBrowser ()
{
	$u_agent	= $_SERVER['HTTP_USER_AGENT'];
	$bname		= 'Unknown';
	$platform	= 'Unknown';
	$version	= "";

	//First get the platform?
	if (preg_match('/linux/i', $u_agent)) {
		$platform = 'linux';
	} elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
		$platform = 'mac';
	} elseif (preg_match('/windows|win32/i', $u_agent)) {
		$platform = 'windows';
	}
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
		if (strripos($u_agent,"Version") < strripos($u_agent,$ub)) {
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

/**
 * Bloqueia o acesso de usuários conforme critério solicitado e redireciona para a página de destino
 * @package	grimoire/bibliotecas/acesso.php
 * @version	17-07-2015
 *
 * @param	bool	bloquear usuários logados ou deslogados
 * @param	string
 *
 * @uses	acesso.php->logado()
 */
function isMobile ()
{
	$regExp = "/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i";
	return preg_match($regExp, $_SERVER["HTTP_USER_AGENT"]);
}

/**
 * Bloqueia o acesso de usuários conforme critério solicitado e redireciona para a página de destino
 * @package	grimoire/bibliotecas/acesso.php
 * @version	17-07-2015
 *
 * @param	bool	bloquear usuários logados ou deslogados
 * @param	string
 *
 * @uses	acesso.php->logado()
 */
function getOS ()
{
	global $user_agent;
	$os_platform = "Unknown OS Platform";
	$os_array = array(
		'/windows nt 10/i'		=> 'Windows 10',
		'/windows nt 6.3/i'		=> 'Windows 8.1',
		'/windows nt 6.2/i'		=> 'Windows 8',
		'/windows nt 6.1/i'		=> 'Windows 7',
		'/windows nt 6.0/i'		=> 'Windows Vista',
		'/windows nt 5.2/i'		=> 'Windows Server 2003/XP x64',
		'/windows nt 5.1/i'		=> 'Windows XP',
		'/windows xp/i'			=> 'Windows XP',
		'/windows nt 5.0/i'		=> 'Windows 2000',
		'/windows me/i'			=> 'Windows ME',
		'/win98/i'				=> 'Windows 98',
		'/win95/i'				=> 'Windows 95',
		'/win16/i'				=> 'Windows 3.11',
		'/macintosh|mac os x/i' => 'Mac OS X',
		'/mac_powerpc/i'		=> 'Mac OS 9',
		'/linux/i'				=> 'Linux',
		'/ubuntu/i'				=> 'Ubuntu',
		'/iphone/i'				=> 'iPhone',
		'/ipod/i'				=> 'iPod',
		'/ipad/i'				=> 'iPad',
		'/android/i'			=> 'Android',
		'/blackberry/i'			=> 'BlackBerry',
		'/webos/i'				=> 'Mobile'
	);

	foreach ($os_array as $regex => $value) {
		if (preg_match($regex, $user_agent)) {
			$os_platform = $value;
		}
	}

	return $os_platform;
}

/**
 * Bloqueia o acesso de usuários conforme critério solicitado e redireciona para a página de destino
 * @package	grimoire/bibliotecas/acesso.php
 * @version	17-07-2015
 *
 * @param	bool	bloquear usuários logados ou deslogados
 * @param	string
 *
 * @uses	acesso.php->logado()
 */
function urlExists ($file = 'https://www.domain.com/somefile.jpg')
{
	$file_headers = @get_headers($file);
	return ($file_headers[0] == 'HTTP/1.1 404 Not Found');
}

/**
 * Bloqueia o acesso de usuários conforme critério solicitado e redireciona para a página de destino
 * @package	grimoire/bibliotecas/acesso.php
 * @version	17-07-2015
 *
 * @param	bool	bloquear usuários logados ou deslogados
 * @param	string
 *
 * @uses	acesso.php->logado()
 * @todo	puxar do módulo
 */
function temDependencias ($modulo, $id)
{
	if ( $modulo == "usuario" ) {

		$campos = array(
			'usuarioId'	=> $id
		);
		$dependenciasDoObjeto = selecionar('_log_operacoes', $campos);
	} else if ( $modulo == "hospital" ) {

		$campos = array(
			'hospital_id'	=> $id
		);
		$dependenciasDoObjeto = selecionar('meta', $campos);
	}

	return !empty($dependenciasDoObjeto);
}

/**
 * Retorna o nome do arquivo atual
 * @package	grimoire/bibliotecas/vetores.php
 * @since	15/07/2021 15:49:52
 * WARNING talvez sea necessário usar DIRECTORY_SEPARATOR -> DS
 */
function paginaAtual ()
{
	$frags = explode("/", $_SERVER['SCRIPT_FILENAME']);
	return $frags[ sizeof($frags)-1 ];
}

function verificarManutencao ()
{
	if ( MANUTENCAO ) {
		if ( incluir("404.php") ) {
			exit;
		} else {
			die("Página em manutenção! Volte novamente mais tarde!");
		}
	}
}
