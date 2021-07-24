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
	// return password_hash($senha, PASSWORD_BCRYPT, $options);
	return password_hash($senha, PASSWORD_DEFAULT, $options);
}

/**
 * Registra operação nos modelos
 * @package grimoire/bibliotecas/acesso.php
 * @since	05-07-2015
 * @version	17-06-2021
 *
 * @param	string	I/U/D Insert, update or delete
 * @return	bool
 *
 * @uses	$_SESSION
 * @uses	acesso.php->identificarIP()
 * @uses	acesso.php->getBrowser()
 * @uses	persistencia.php->inserir()
 * @example
	registrarOperacao("U", "produto", 15);
	registrarOperacao("I", "produto", "29");
 */
function registrarOperacao ($acao, $tabela, $objetoId)
{
	$values = array(
		'usuarioId'	=> $_SESSION['user']['id'],
		'acao'		=> $acao,
		'tabela'	=> $tabela,
		'objetoId'	=> $objetoId,
		'ip'		=> identificarIP(),
		'navegador'	=> json_encode( getBrowser() )
	);

	return inserir('_log_operacoes', $values, false);
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
	$newTime = strtotime('-15 minutes');
	$dt = date('Y-m-d H:i:s', $newTime);

	$sql = "
		SELECT * FROM _log_acesso
		WHERE
			usuarioId = {$id}
			AND sucesso = 0
			AND datahora > '{$dt}'
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

	if ( $falhasConsecutivas >= 3) {
		echo "<p>Tentativas de login incorretas: {$falhasConsecutivas}</p>";
		die("Usuário bloqueado temporariamente!");
	}
}
