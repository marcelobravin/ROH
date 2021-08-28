<?php
/**
 * Segurança
 * @package grimoire/bibliotecas
*/

// 50 milliseconds
/**
 * Escreve o conteúdo em um arquivo
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @param	string
 * @param	string
 * @param	bool	Conservar conteúdo, append
 *
 * @return	bool
 *
 * @example
	cabecalho_download_csv("nome_arquivo_" . date("Y-m-d") . ".csv");
	echo array_para_csv($array);
*/
function verifyHashCost($timeTargetInMiliseconds=0.05) {

	$cost = 8;
	do {
		$cost++;
		$start = microtime(true);
		password_hash("test", PASSWORD_BCRYPT, ["cost" => $cost]);
		$end = microtime(true);
	} while (($end - $start) < $timeTargetInMiliseconds);

	return "Appropriate Cost Found: " . $cost;
}

/**
 * Criptografa uma string em modo one-way
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @param	string
 * @param	string
 * @param	bool	Conservar conteúdo, append
 *
 * @return	bool
 *
 * @example
	cabecalho_download_csv("nome_arquivo_" . date("Y-m-d") . ".csv");
	echo array_para_csv($array);
*/
function criptografar ($senha) {
	$options = ['cost' => 12];
	return password_hash($senha, PASSWORD_DEFAULT, $options);
}

/**
 * Registra operação nos modelos
 * @package grimoire/bibliotecas/acesso.php
 * @since	05-07-2015
 * @version	13/08/2021 08:51:39
 *
 * @param	string	I/U/D/d Insert, update, delete ou exclusão lógica
 * @return	bool
 *
 * @uses	$_SESSION
 * @uses	acesso.php->identificarIP()
 * @uses	acesso.php->identificarNavegador()
 * @uses	persistencia.php->inserir()
 * @example
	registrarOperacao("U", "produto", 15);
	registrarOperacao("I", "produto", "29");
 */
function registrarOperacao ($acao, $tabela, $objetoId, $usuario=null)
{
	$values = array(
		'id_usuario'=> empty($usuario) ? $_SESSION['user']['id'] : $usuario,
		'acao'		=> $acao,
		'tabela'	=> $tabela,
		'objetoId'	=> $objetoId,
		'ip'		=> identificarIP(),
		'navegador'	=> json_encode( identificarNavegador() )
	);

	return inserir('_log_operacoes', $values);
}

function registroOperacao ($acao, $tabela, $objetoId, $usuario=null)
{
	$values = array(
		'id_usuario'=> empty($usuario) ? $_SESSION['user']['id'] : $usuario,
		'acao'		=> $acao,
		'tabela'	=> $tabela,
		'objetoId'	=> $objetoId,
		'ip'		=> identificarIP(),
		'navegador'	=> json_encode( identificarNavegador() )
	);

	return insercao('_log_operacoes', $values);
}


/**
 * Escreve o conteúdo em um arquivo
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @param	string
 * @param	string
 * @param	bool	Conservar conteúdo, append
 *
 * @return	bool
 *
 * @example
	cabecalho_download_csv("nome_arquivo_" . date("Y-m-d") . ".csv");
	echo array_para_csv($array);
*/
function detectarForcaBruta ($id, $conexao)
{
	$newTime = strtotime(INTERVALO_FORCA_BRUTA);
	$dt = date('Y-m-d H:i:s', $newTime);

	$sql = "
		SELECT * FROM _log_acesso
		WHERE
			id_usuario		= {$id}
			AND sucesso		= 0
			AND datahora	> '{$dt}'
	";
	$stm = $conexao->prepare($sql);
	$stm->execute();
	return $stm->rowCount();
}

/**
 * Escreve o conteúdo em um arquivo
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @param	string
 * @param	string
 * @param	bool	Conservar conteúdo, append
 *
 * @return	bool
 *
 * @example
	cabecalho_download_csv("nome_arquivo_" . date("Y-m-d") . ".csv");
	echo array_para_csv($array);
*/
function bloquearForcaBruta ($id, $conexao)
{
	$falhasConsecutivas = detectarForcaBruta($id, $conexao);

	if ( $falhasConsecutivas >= FORCA_BRUTA) {
		echo "<p>Tentativas de login incorretas: {$falhasConsecutivas}</p>";
		die("Usuário bloqueado temporariamente!");
	}
}

/**
 * 07/08/2021 15:49:38
*/
function bloquearXSS ($inputUsuario)
{
	return htmlentities($inputUsuario);
}

/**
 * Escreve o conteúdo em um arquivo
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	12/08/2021 10:56:54
 *
 * @param	array
 * @param	string	whitelist contendo a url de onde serão aceitas requisições
*/
function bloquearRequisicoesInvalidas ($post, $paginaPermitida="formulario-cadastro.php?modulo=usuario")
{
	if ( empty($post) ) {
		die("Requisição vazia!");
	}

	if ( !isset($_SERVER['HTTP_REFERER']) ) {
		die("Requisição externa!");
	}

	if ( $_SERVER['HTTP_REFERER'] != PROTOCOLO . BASE_HTTP . $paginaPermitida ) {
		die("Requisição inválida");
	}
}
