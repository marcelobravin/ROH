<?php
/**
 * Manipulação de sessão
 * @package grimoire/bibliotecas
*/

/**
 * @version	30/07/2021 11:50:37
 *
 * @uses	$_SESSION
 */
function encerrarSessao ()
{
	unset($_SESSION);
	session_unset();
	session_destroy();
}

/**
 * Inicia uma sessão de forma segura
 * @package	grimoire/bibliotecas/acesso.php
 * @version	17-07-2015
 *
 * @uses	session_status()
 * {@link http://www.php.net/manual/en/function.session-status.php}
 * }
 */
function iniciarSessao ()
{
	if ( function_exists ('session_status') ) {
		if (session_status() == PHP_SESSION_NONE) {// For versions of PHP >= 5.4.0
			session_start();
		}
	} elseif (session_id() == '') { // For versions of PHP < 5.4.0
		session_start();
	}
}

/**
 * Define tempo de validade para o cache da sessão
 * @package	grimoire/bibliotecas/acesso.php
 * @version	20-07-2015
 */
/* Define o limitador de cache para 'private' */
function limitarCache ()
{
	session_cache_limiter('private');
	$cache_limiter = session_cache_limiter();

	session_cache_expire(SESSAO_TTL / 60);
	$cache_expire = session_cache_expire();

	session_start();
	$_SESSION['cache_limiter'] = $cache_limiter;
	$_SESSION['cache_expire'] = $cache_expire;
}
