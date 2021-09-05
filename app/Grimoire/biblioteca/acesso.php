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

/**
 *
 */
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
			'secure'	=> true, # if you only want to receive the cookie over HTTPS
			'httponly'	=> true, # prevent JavaScript access to session cookie
			'samesite'	=> PROJECT_NAME
		]);
	}
}

/**
 *
 */
function configurarExibicaoErros ($conf=PRODUCAO)
{
	#error_log($path); # Path to the error log file. When running PHP in a Docker container, consider logging to stdout instead.
	if ( $conf ) {
		ini_set('display_errors'		, 0); # Defines whether errors are included in output.
		ini_set('display_startup_errors', 0); # Whether to display PHP startup sequence errors.
	} else {
		ini_set('display_errors'		, TRUE);
		ini_set('display_startup_errors', 1);
	}

	ini_set('log_errors'			, 1); # Toggles error logging.
	ini_set('log_errors_max_length'	, 0); # Max length of logged errors. Set to zero for no maximum.
	ini_set('track_errors'			, 1); # Stores the last error message in $php_errormsg

	ini_set('error_reporting'		, E_ALL);
	error_reporting(E_ALL); # The minimum error reporting level.
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
	configurarCookies();
	limitarCache();
	$_SESSION['LAST_ACTIVITY']	= time(); // update last activity time stamp
	$_SESSION['CREATED']		= time();
	$_SESSION['isMobile']		= identificarMobile();
	$_SESSION['mobile']			= identificarMobile2();
	$_SESSION['os']				= identificarPlataforma();
	$_SESSION['ip']				= identificarIP();
	$_SESSION['browser']		= identificarNavegador();
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
	# default unreliable ip
	$ip = $_SERVER['REMOTE_ADDR'];

	# check for shared internet/ISP IP
	if ( !empty($_SERVER['HTTP_CLIENT_IP']) && validarIp($_SERVER['HTTP_CLIENT_IP']) ) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}
	# behind cloudflare
	else if( isset($_SERVER['HTTP_CF_CONNECTING_IP']) )	{
		$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
	}
	# IPs passing through proxies
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

// Function written and tested December, 2018
function identificarBots ($user_agent)
{
	// Make case insensitive.
	$t = strtolower($user_agent);

	// If the string *starts* with the string, strpos returns 0 (i.e., FALSE). Do a ghetto hack and start with a space.
	// "[strpos()] may return Boolean FALSE, but may also return a non-Boolean value which evaluates to FALSE."
	//	 http://php.net/manual/en/function.strpos.php
	$t = " " . $t;

	$r = 'Other (Unknown)';

	// Humans / Regular Users
	if	 (strpos($t, 'opera') || strpos($t, 'opr/')				) { $r = 'Opera'; }
	elseif (strpos($t, 'edge')									) { $r = 'Edge'; }
	elseif (strpos($t, 'chrome')								) { $r = 'Chrome'; }
	elseif (strpos($t, 'safari')								) { $r = 'Safari'; }
	elseif (strpos($t, 'firefox')								) { $r = 'Firefox'; }
	elseif (strpos($t, 'msie') || strpos($t, 'trident/7')		) { $r = 'Internet Explorer'; }

	// Search Engines
	elseif (strpos($t, 'google')								) { $r = '[Bot] Googlebot'; }
	elseif (strpos($t, 'bing' )									) { $r = '[Bot] Bingbot'; }
	elseif (strpos($t, 'slurp')									) { $r = '[Bot] Yahoo! Slurp'; }
	elseif (strpos($t, 'duckduckgo')							) { $r = '[Bot] DuckDuckBot' ; }
	elseif (strpos($t, 'baidu')									) { $r = '[Bot] Baidu'; }
	elseif (strpos($t, 'yandex')								) { $r = '[Bot] Yandex'; }
	elseif (strpos($t, 'sogou')									) { $r = '[Bot] Sogou'; }
	elseif (strpos($t, 'exabot')								) { $r = '[Bot] Exabot'; }
	elseif (strpos($t, 'msn')									) { $r = '[Bot] MSN'; }

	// Common Tools and Bots
	elseif (strpos($t, 'mj12bot')								) { $r = '[Bot] Majestic'	 ; }
	elseif (strpos($t, 'ahrefs')								) { $r = '[Bot] Ahrefs'	   ; }
	elseif (strpos($t, 'semrush')								) { $r = '[Bot] SEMRush'	  ; }
	elseif (strpos($t, 'rogerbot'  ) || strpos($t, 'dotbot')	) { $r = '[Bot] Moz or OpenSiteExplorer'; }
	elseif (strpos($t, 'frog'	  ) || strpos($t, 'screaming')	) { $r = '[Bot] Screaming Frog'; }

	// Miscellaneous
	elseif (strpos($t, 'facebook'  )							) { $r = '[Bot] Facebook'	 ; }
	elseif (strpos($t, 'pinterest' )							) { $r = '[Bot] Pinterest'	; }

	// Check for strings commonly used in bot user agents
	elseif (strpos($t, 'crawler') || strpos($t, 'api') ||
			strpos($t, 'spider') || strpos($t, 'http'	) ||
			strpos($t, 'bot') || strpos($t, 'archive') ||
			strpos($t, 'info') || strpos($t, 'data'	)
	) {
		$r = '[Bot] Other';
	}

	return $r;
}

/**
 * Bloqueia o acesso de usuários conforme critério solicitado e redireciona para a página de destino
 * @package	grimoire/bibliotecas/acesso.php
 * @version	17-07-2015
 *
 * @param	bool	bloquear usuários logados ou deslogados
 * @param	string
 *
 */
function identificarMobile ()
{
	$regExp = "/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i";
	return preg_match($regExp, $_SERVER["HTTP_USER_AGENT"]);
}

/**
 *
 */
function identificarMobile2 ()
{
	$useragent = $_SERVER['HTTP_USER_AGENT'];
	// $useragent = 'avantgo';
	$regExp = '/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i';
	if ( preg_match($regExp, $useragent, $match) ) {
		return $match;
	}

	$regExp = '/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i';
	if ( preg_match($regExp, substr($useragent,0,4), $match ) ) {
		return $match;
	}
}

/**
 * Bloqueia o acesso de usuários conforme critério solicitado e redireciona para a página de destino
 * @package	grimoire/bibliotecas/acesso.php
 * @version	17-07-2015
 *
 * @param	bool	bloquear usuários logados ou deslogados
 * @param	string
 *
 */
function identificarNavegador ()
{
	$u_agent	= $_SERVER['HTTP_USER_AGENT'];
	$bname		= 'Unknown';
	$version	= '';
	$platform	= identificarPlataforma();

	// Next get the name of the useragent yes seperately and for good reason
	if (preg_match('/msie|trident/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
		$bname = 'Internet Explorer';
		$ub = "MSIE";
	} elseif (preg_match('/Firefox/i', $u_agent)) {
		$bname = 'Mozilla Firefox';
		$ub = "Firefox";
	} elseif (preg_match('/Chrome/i', $u_agent)) {
		$bname = 'Google Chrome';
		$ub = "Chrome";
	} elseif (preg_match('/Safari/i', $u_agent)) {
		$bname = 'Apple Safari';
		$ub = "Safari";
	} elseif (preg_match('/Opera/i', $u_agent)) {
		$bname = 'Opera';
		$ub = "Opera";
	} elseif (preg_match('/Netscape/i', $u_agent)) {
		$bname = 'Netscape';
		$ub = "Netscape";
	} elseif (preg_match('/maxthon/i', $u_agent)) {
		$bname = 'Maxthon';
		$ub = 'Maxthon';
	} elseif (preg_match('/konqueror/i', $u_agent)) {
		$bname = 'Konqueror';
		$ub = 'Konqueror';
	} elseif (preg_match('/mobile/i', $u_agent)) {
		$bname = 'Mobile';
		$ub = 'Mobile';
	}

	// finally get the correct version number
	$known = array('Version', $ub, 'other');
	$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
	preg_match_all($pattern, $u_agent, $matches);

	// see how many we have
	$i = count($matches['browser']);
	if ($i != 1) {
		//we will have two since we are not using 'other' argument yet
		//see if version is before or after the name
		if ( strripos($u_agent,"Version") < strripos($u_agent,$ub) ) {
			$version = $matches['version'][0];
		} else {
			$version = $matches['version'][1];
		}

	} else {
		$version = $matches['version'][0];
	}

	// check if we have a number
	if ($version==null || $version=="") {
		$version="?";
	}

	return array(
		'userAgent'	=> $u_agent,
		'name'		=> $bname,
		'version'	=> $version,
		'platform'  => $platform,
		'pattern'	=> $pattern
	);
}

/* return Operating System */
function operating_system_detection(){
	if ( isset( $_SERVER ) ) {
		$agent = $_SERVER['HTTP_USER_AGENT'];
	} else {
		global $_SERVER;
		if ( isset( $_SERVER ) ) {
			$agent = $_SERVER['HTTP_USER_AGENT'];
		} else {
			global $HTTP_USER_AGENT;
			$agent = $HTTP_USER_AGENT;
		}
	}
	$ros[] = array('Windows XP'													, 'Windows XP');
	$ros[] = array('Windows NT 5.1|Windows NT5.1)'								, 'Windows XP');
	$ros[] = array('Windows 2000'												, 'Windows 2000');
	$ros[] = array('Windows NT 5.0'												, 'Windows 2000');
	$ros[] = array('Windows NT 4.0|WinNT4.0'									, 'Windows NT');
	$ros[] = array('Windows NT 5.2'												, 'Windows Server 2003');
	$ros[] = array('Windows NT 6.0'												, 'Windows Vista');
	$ros[] = array('Windows NT 7.0'												, 'Windows 7');
	$ros[] = array('Windows CE'													, 'Windows CE');
	$ros[] = array('(media center pc).([0-9]{1,2}\.[0-9]{1,2})'					, 'Windows Media Center');
	$ros[] = array('(win)([0-9]{1,2}\.[0-9x]{1,2})'								, 'Windows');
	$ros[] = array('(win)([0-9]{2})'											, 'Windows');
	$ros[] = array('(windows)([0-9x]{2})'										, 'Windows');
	// Doesn't seem like these are necessary...not totally sure though..
	//$ros[] = array('(winnt)([0-9]{1,2}\.[0-9]{1,2}){0,1}'													, 'Windows NT');
	//$ros[] = array('(windows nt)(([0-9]{1,2}\.[0-9]{1,2}){0,1})'													, 'Windows NT'); // fix by bg
	$ros[] = array('Windows ME'													, 'Windows ME');
	$ros[] = array('Win 9x 4.90'												, 'Windows ME');
	$ros[] = array('Windows 98|Win98'											, 'Windows 98');
	$ros[] = array('Windows 95'													, 'Windows 95');
	$ros[] = array('(windows)([0-9]{1,2}\.[0-9]{1,2})'							, 'Windows');
	$ros[] = array('win32'														, 'Windows');
	$ros[] = array('(java)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,2})'					, 'Java');
	$ros[] = array('(Solaris)([0-9]{1,2}\.[0-9x]{1,2}){0,1}'					, 'Solaris');
	$ros[] = array('dos x86'													, 'DOS');
	$ros[] = array('unix'														, 'Unix');
	$ros[] = array('Mac OS X'													, 'Mac OS X');
	$ros[] = array('Mac_PowerPC'												, 'Macintosh PowerPC');
	$ros[] = array('(mac|Macintosh)'											, 'Mac OS');
	$ros[] = array('(sunos)([0-9]{1,2}\.[0-9]{1,2}){0,1}'						, 'SunOS');
	$ros[] = array('(beos)([0-9]{1,2}\.[0-9]{1,2}){0,1}'						, 'BeOS');
	$ros[] = array('(risc os)([0-9]{1,2}\.[0-9]{1,2})'							, 'RISC OS');
	$ros[] = array('os/2'														, 'OS/2');
	$ros[] = array('freebsd'													, 'FreeBSD');
	$ros[] = array('openbsd'													, 'OpenBSD');
	$ros[] = array('netbsd'														, 'NetBSD');
	$ros[] = array('irix'														, 'IRIX');
	$ros[] = array('plan9'														, 'Plan9');
	$ros[] = array('osf'														, 'OSF');
	$ros[] = array('aix'														, 'AIX');
	$ros[] = array('GNU Hurd'													, 'GNU Hurd');
	$ros[] = array('(fedora)'													, 'Linux - Fedora');
	$ros[] = array('(kubuntu)'													, 'Linux - Kubuntu');
	$ros[] = array('(ubuntu)'													, 'Linux - Ubuntu');
	$ros[] = array('(debian)'													, 'Linux - Debian');
	$ros[] = array('(CentOS)'													, 'Linux - CentOS');
	$ros[] = array('(Mandriva).([0-9]{1,3}(\.[0-9]{1,3})?(\.[0-9]{1,3})?)'		, 'Linux - Mandriva');
	$ros[] = array('(SUSE).([0-9]{1,3}(\.[0-9]{1,3})?(\.[0-9]{1,3})?)'			, 'Linux - SUSE');
	$ros[] = array('(Dropline)'													, 'Linux - Slackware (Dropline GNOME)');
	$ros[] = array('(ASPLinux)'													, 'Linux - ASPLinux');
	$ros[] = array('(Red Hat)'													, 'Linux - Red Hat');
	// Loads of Linux machines will be detected as unix.
	// Actually																	, all of the linux machines I've checked have the 'X11' in the User Agent.
	//$ros[] = array('X11'														, 'Unix');
	$ros[] = array('(linux)'													, 'Linux');
	$ros[] = array('(amigaos)([0-9]{1,2}\.[0-9]{1,2})'							, 'AmigaOS');
	$ros[] = array('amiga-aweb'													, 'AmigaOS');
	$ros[] = array('amiga'														, 'Amiga');
	$ros[] = array('AvantGo'													, 'PalmOS');
	//$ros[] = array('(Linux)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}(rel\.[0-9]{1,2}){0,1}-([0-9]{1,2}) i([0-9]{1})86){1}'													, 'Linux');
	//$ros[] = array('(Linux)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}(rel\.[0-9]{1,2}){0,1} i([0-9]{1}86)){1}'													, 'Linux');
	//$ros[] = array('(Linux)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}(rel\.[0-9]{1,2}){0,1})'													, 'Linux');
	$ros[] = array('[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}'							, 'Linux');
	$ros[] = array('(webtv)/([0-9]{1,2}\.[0-9]{1,2})'							, 'WebTV');
	$ros[] = array('Dreamcast'													, 'Dreamcast OS');
	$ros[] = array('GetRight'													, 'Windows');
	$ros[] = array('go!zilla'													, 'Windows');
	$ros[] = array('gozilla'													, 'Windows');
	$ros[] = array('gulliver'													, 'Windows');
	$ros[] = array('ia archiver'												, 'Windows');
	$ros[] = array('NetPositive'												, 'Windows');
	$ros[] = array('mass downloader'											, 'Windows');
	$ros[] = array('microsoft'													, 'Windows');
	$ros[] = array('offline explorer'											, 'Windows');
	$ros[] = array('teleport'													, 'Windows');
	$ros[] = array('web downloader'												, 'Windows');
	$ros[] = array('webcapture'													, 'Windows');
	$ros[] = array('webcollage'													, 'Windows');
	$ros[] = array('webcopier'													, 'Windows');
	$ros[] = array('webstripper'												, 'Windows');
	$ros[] = array('webzip'														, 'Windows');
	$ros[] = array('wget'														, 'Windows');
	$ros[] = array('Java'														, 'Unknown');
	$ros[] = array('flashget'													, 'Windows');
	// delete next line if the script show not the right OS
	//$ros[] = array('(PHP)/([0-9]{1,2}.[0-9]{1,2})'							, 'PHP');
	$ros[] = array('MS FrontPage'												, 'Windows');
	$ros[] = array('(msproxy)/([0-9]{1,2}.[0-9]{1,2})'							, 'Windows');
	$ros[] = array('(msie)([0-9]{1,2}.[0-9]{1,2})'								, 'Windows');
	$ros[] = array('libwww-perl'												, 'Unix');
	$ros[] = array('UP.Browser'													, 'Windows CE');
	$ros[] = array('NetAnts'													, 'Windows');

	$file = count ( $ros );
	$os = '';
	for ( $n=0 ; $n<$file ; $n++ ){
		if ( preg_match('/'.$ros[$n][0].'/i' , $agent, $name)){
			$os = @$ros[$n][1].' '.@$name[2];
			break;
		}
	}
	return trim($os);
}

/**
 * @param $user_agent null
 * @return string
 */
function getOS($user_agent = null)
{
    if(!isset($user_agent) && isset($_SERVER['HTTP_USER_AGENT'])) {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
    }

    // https://stackoverflow.com/questions/18070154/get-operating-system-info-with-php
    $os_array = [
        'windows nt 10'                              =>  'Windows 10',
        'windows nt 6.3'                             =>  'Windows 8.1',
        'windows nt 6.2'                             =>  'Windows 8',
        'windows nt 6.1|windows nt 7.0'              =>  'Windows 7',
        'windows nt 6.0'                             =>  'Windows Vista',
        'windows nt 5.2'                             =>  'Windows Server 2003/XP x64',
        'windows nt 5.1'                             =>  'Windows XP',
        'windows xp'                                 =>  'Windows XP',
        'windows nt 5.0|windows nt5.1|windows 2000'  =>  'Windows 2000',
        'windows me'                                 =>  'Windows ME',
        'windows nt 4.0|winnt4.0'                    =>  'Windows NT',
        'windows ce'                                 =>  'Windows CE',
        'windows 98|win98'                           =>  'Windows 98',
        'windows 95|win95'                           =>  'Windows 95',
        'win16'                                      =>  'Windows 3.11',
        'mac os x 10.1[^0-9]'                        =>  'Mac OS X Puma',
        'macintosh|mac os x'                         =>  'Mac OS X',
        'mac_powerpc'                                =>  'Mac OS 9',
        'ubuntu'                                     =>  'Linux - Ubuntu',
        'iphone'                                     =>  'iPhone',
        'ipod'                                       =>  'iPod',
        'ipad'                                       =>  'iPad',
        'android'                                    =>  'Android',
        'blackberry'                                 =>  'BlackBerry',
        'webos'                                      =>  'Mobile',
        'linux'                                      =>  'Linux',

        '(media center pc).([0-9]{1,2}\.[0-9]{1,2})'=>'Windows Media Center',
        '(win)([0-9]{1,2}\.[0-9x]{1,2})'=>'Windows',
        '(win)([0-9]{2})'=>'Windows',
        '(windows)([0-9x]{2})'=>'Windows',

        // Doesn't seem like these are necessary...not totally sure though..
        //'(winnt)([0-9]{1,2}\.[0-9]{1,2}){0,1}'=>'Windows NT',
        //'(windows nt)(([0-9]{1,2}\.[0-9]{1,2}){0,1})'=>'Windows NT', // fix by bg

        'Win 9x 4.90'=>'Windows ME',
        '(windows)([0-9]{1,2}\.[0-9]{1,2})'=>'Windows',
        'win32'=>'Windows',
        '(java)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,2})'=>'Java',
        '(Solaris)([0-9]{1,2}\.[0-9x]{1,2}){0,1}'=>'Solaris',
        'dos x86'=>'DOS',
        'Mac OS X'=>'Mac OS X',
        'Mac_PowerPC'=>'Macintosh PowerPC',
        '(mac|Macintosh)'=>'Mac OS',
        '(sunos)([0-9]{1,2}\.[0-9]{1,2}){0,1}'=>'SunOS',
        '(beos)([0-9]{1,2}\.[0-9]{1,2}){0,1}'=>'BeOS',
        '(risc os)([0-9]{1,2}\.[0-9]{1,2})'=>'RISC OS',
        'unix'=>'Unix',
        'os/2'=>'OS/2',
        'freebsd'=>'FreeBSD',
        'openbsd'=>'OpenBSD',
        'netbsd'=>'NetBSD',
        'irix'=>'IRIX',
        'plan9'=>'Plan9',
        'osf'=>'OSF',
        'aix'=>'AIX',
        'GNU Hurd'=>'GNU Hurd',
        '(fedora)'=>'Linux - Fedora',
        '(kubuntu)'=>'Linux - Kubuntu',
        '(ubuntu)'=>'Linux - Ubuntu',
        '(debian)'=>'Linux - Debian',
        '(CentOS)'=>'Linux - CentOS',
        '(Mandriva).([0-9]{1,3}(\.[0-9]{1,3})?(\.[0-9]{1,3})?)'=>'Linux - Mandriva',
        '(SUSE).([0-9]{1,3}(\.[0-9]{1,3})?(\.[0-9]{1,3})?)'=>'Linux - SUSE',
        '(Dropline)'=>'Linux - Slackware (Dropline GNOME)',
        '(ASPLinux)'=>'Linux - ASPLinux',
        '(Red Hat)'=>'Linux - Red Hat',
        // Loads of Linux machines will be detected as unix.
        // Actually, all of the linux machines I've checked have the 'X11' in the User Agent.
        //'X11'=>'Unix',
        '(linux)'=>'Linux',
        '(amigaos)([0-9]{1,2}\.[0-9]{1,2})'=>'AmigaOS',
        'amiga-aweb'=>'AmigaOS',
        'amiga'=>'Amiga',
        'AvantGo'=>'PalmOS',
        //'(Linux)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}(rel\.[0-9]{1,2}){0,1}-([0-9]{1,2}) i([0-9]{1})86){1}'=>'Linux',
        //'(Linux)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}(rel\.[0-9]{1,2}){0,1} i([0-9]{1}86)){1}'=>'Linux',
        //'(Linux)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}(rel\.[0-9]{1,2}){0,1})'=>'Linux',
        '[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}'=>'Linux',
        '(webtv)/([0-9]{1,2}\.[0-9]{1,2})'=>'WebTV',
        'Dreamcast'=>'Dreamcast OS',
        'GetRight'=>'Windows',
        'go!zilla'=>'Windows',
        'gozilla'=>'Windows',
        'gulliver'=>'Windows',
        'ia archiver'=>'Windows',
        'NetPositive'=>'Windows',
        'mass downloader'=>'Windows',
        'microsoft'=>'Windows',
        'offline explorer'=>'Windows',
        'teleport'=>'Windows',
        'web downloader'=>'Windows',
        'webcapture'=>'Windows',
        'webcollage'=>'Windows',
        'webcopier'=>'Windows',
        'webstripper'=>'Windows',
        'webzip'=>'Windows',
        'wget'=>'Windows',
        'Java'=>'Unknown',
        'flashget'=>'Windows',

        // delete next line if the script show not the right OS
        //'(PHP)/([0-9]{1,2}.[0-9]{1,2})'=>'PHP',
        'MS FrontPage'=>'Windows',
        '(msproxy)/([0-9]{1,2}.[0-9]{1,2})'=>'Windows',
        '(msie)([0-9]{1,2}.[0-9]{1,2})'=>'Windows',
        'libwww-perl'=>'Unix',
        'UP.Browser'=>'Windows CE',
        'NetAnts'=>'Windows',
    ];

    // https://github.com/ahmad-sa3d/php-useragent/blob/master/core/user_agent.php
    $arch_regex = '/\b(x86_64|x86-64|Win64|WOW64|x64|ia64|amd64|ppc64|sparc64|IRIX64)\b/ix';
    $arch = preg_match($arch_regex, $user_agent) ? '64' : '32';

    foreach ($os_array as $regex => $value) {
        if (preg_match('{\b('.$regex.')\b}i', $user_agent)) {
            return $value.' x'.$arch;
        }
    }

    return 'Unknown';
}

/**
 * Identifica o sistema operacional do usuário
 * @package	grimoire/bibliotecas/acesso.php
 * @version	17-07-2015
 *
 * @return	string
 */
function identificarPlataforma ()
{
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
		if ( preg_match($regex, $_SERVER['HTTP_USER_AGENT']) ) {
			$os_platform = $value;
		}
	}

	return $os_platform;
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
function logado ()
{
	iniciarSessao();
	return isset($_SESSION[USUARIO_SESSAO]);
}

/**
 * Bloqueia o acesso de usuários conforme critério solicitado e redireciona para a página de destino
 * @package	grimoire/bibliotecas/acesso.php
 * @version	17-07-2015
 *
 * @param	bool	bloquear usuários logados ou deslogados
 * @param	string
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
		'ativo',
		'nome'
	);
	$user = selecionar('usuario', $condicoes, "", $campos);

	if ( empty($user) ) {
		password_verify('senha', 'senhaStub'); # operacao custosa para não sinalizar retorno muito rápido
		return false;

	} else {
		$user = $user[0];
		$ip = identificarIP();
		$browser = identificarNavegador();

		$conn = conectar();

		bloquearForcaBruta($user['id'], $conn);

		if ( password_verify($senha, $user['senha']) ) {
			$acesso = registroDeAcesso($ip, $browser, 1, $user['id']);
			$stm = $conn->prepare($acesso);
			$stm->execute();

			criarSessao();
			unset($user['senha']);
			$_SESSION[USUARIO_SESSAO] = $user;
			return true;
		} else {
			$falhaAcesso = registroDeAcesso($ip, $browser, 0, $user['id']);
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
 * @uses	unsetCookie()
 * @uses	finalizarSessao()
 * @uses	redirecionar()
 */
function logOut ($url="index.php")
{
	unsetCookie('PHPSESSID');
	if ( finalizarSessao() ) {
		redirecionar($url);
	} else {
		die("Erro ao finalizar sessão!");
	}
}

/**
 * Recarrega a página atual
 * @package	grimoire/bibliotecas/acesso.php
 * @since	08/07/2021 11:03:11
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

/**
 *
 */
function redirecionamentoTemporal ($destino="index.php", $tempo=5)
{
	header( "refresh:{$tempo};url={$destino}" );
	echo "<center>";
	echo h1("Sessão expirada!");
	echo 'Você será redirecionado em <span id="c">'.$tempo.'</span> segundos.<br>Caso contrário, clique <a href="'. $destino .'">aqui</a>.';
	echo "</center>";
	exibirScriptContagem($tempo, 'c');
}

/**
 * Redireciona para página solicitada via php (se possível) ou javascript e html
 * @package	grimoire/bibliotecas/acesso.php
 * @since	05-07-2015
 * @version	06/08/2021 12:06:01
 *
 * @param	string
 */
function redirecionar ($url=PAGINA_INICIAL)
{
	$urlSemQueryString = explode("?", $url);
	$uri = BASE.$urlSemQueryString[0];
	if ( !file_exists( $uri ) ) {
		pp("Página inexistente");
		die( $uri );
	}

	$url = PROTOCOLO . BASE_HTTP . $url;

	if ( headers_sent() ) {
		echo '<script type="text/javascript">window.location=\'' . $url . '\';</script>';
		echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0; URL='". $url ."'\">";
	} else {
		header('Location: ' . $url);
	}
	exit;
}

/**
 *
 */
function registrarLogOff ()
{
	$ip = identificarIP();
	$browser = identificarNavegador();

	$acesso = registroDeAcesso($ip, $browser, -1);
	executar($acesso);
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
	# quando sessão ultrapassou o tempo limite
	if (isset($_SESSION['LAST_ACTIVITY']) && time() - $_SESSION['LAST_ACTIVITY'] > SESSAO_TTL ) { // last request was more than 30 minutes ago
		registrarLogOff();
		finalizarSessao();
		redirecionamentoTemporal();
		exit;
	}

	$_SESSION['LAST_ACTIVITY'] = time(); # atualiza ultimo acesso da sessão

	if ( !isset($_SESSION['CREATED']) ) {
		$_SESSION['CREATED'] = time();
	}
}

/**
 * Retorna para página anterior
 * @package	grimoire/bibliotecas/acesso.php
 * @since	08/07/2021 11:00:08
 *
 * @uses	$_SERVER
 */
function voltar ()
{
	$url = explode(PROJECT_FOLDER, $_SERVER['HTTP_REFERER']);
	redirecionar( $url[1] );
}

/**
 * Verifica se uma url existe
 * @package	grimoire/bibliotecas/acesso.php
 * @version	17-07-2015
 *
 * @param	bool	bloquear usuários logados ou deslogados
 * @param	string
 *
 * @uses	acesso.php->logado()
 */
function urlExiste ($file='https://www.domain.com/somefile.jpg')
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
			'id_usuario'	=> $id
		);
		$dependenciasDoObjeto = selecionar('_log_operacoes', $campos);
	} else if ( $modulo == "hospital" ) {

		$campos = array(
			'id_hospital'	=> $id
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

/**
 * Valida a impressão digital da sessão
 * @package	grimoire/bibliotecas/acesso.php
 * @since	27/08/2021 15:52:27
 * @uses	$_SESSION
 */
function validarSessao ()
{
	if (
		$_SESSION['isMobile']	== identificarMobile()		&&
		$_SESSION['mobile']		== identificarMobile2()		&&
		$_SESSION['os']			== identificarPlataforma()	&&
		$_SESSION['ip']			== identificarIP()			&&
		$_SESSION['browser']	== identificarNavegador()
	) {
		return true;
	}

	return false;
}

/**
 *
 */
function verificarManutencao ()
{
	if ( MANUTENCAO ) {
		if ( incluir("manutencao.php") ) {
			exit;
		}

		die("Página em manutenção! Volte novamente mais tarde!");
	}
}
