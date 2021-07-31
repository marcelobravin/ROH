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
function finalizarSessao ()
{
	if ( iniciarSessao() ) {
		session_destroy();
		session_unset();
		unset($_SESSION);
		return true;
	}

	return false;
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
		if (session_status() == PHP_SESSION_NONE) { # For versions of PHP >= 5.4.0
			session_start();
		}
		return true;

	} elseif (session_id() == '') { # For versions of PHP < 5.4.0
		session_start();
		return true;
	}
	return false;
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

/**
 * Unset cookies
 *
 * @param	string	$key	Nome do cookie
 * @param	string	$path	(Opcional) Se definido irá remover o cookie de caminhos especificos
 * @param	string	$domain	(Opcional) Se definido irá remover o cookie de (sub)dominios especificos
 * @param	bool	$secure	(Opcional) Se definido irá remover o cookie em conexão segura (isto varia conforme o navegador)
 *
 * @return bool
 *
 * @example
	unsetcookie('meucookie'); # Elimina o cookie pro path atual
	unsetcookie('meucookie', '/'); # Elimina o cookie pro path raiz
	unsetcookie('meucookie', '/', 'foo.com'); # Elimina o cookie de um domínio quando estiver em um subdomínio por exemplo: bar.foo.com
 */
function unsetCookie($key, $path = '', $domain = '', $secure = false)
{
	if (array_key_exists($key, $_COOKIE)) {
		if (false === setcookie($key, null, -1, $path, $domain, $secure)) {
			return false;
		}

		unset($_COOKIE[$key]);
	}

	return true;
}
