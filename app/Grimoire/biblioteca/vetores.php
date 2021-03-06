<?php
/**
 * Manipulação de arrays
 * @package grimoire/bibliotecas
*/

/**
 * Reordena uma matriz
 * @package grimoire/bibliotecas/vetores.php
 * @version 31-07-2015
 * {@link http://php.net/manual/pt_BR/function.array -multisort.php}
 *
 * @param	array/string
 * @return	array
 * @example
		$data[] = array('volume' => 67, 'edition' => 2);
		$data[] = array('volume' => 86, 'edition' => 1);
		$data[] = array('volume' => 85, 'edition' => 6);
		$data[] = array('volume' => 98, 'edition' => 2);
		$data[] = array('volume' => 86, 'edition' => 6);
		$data[] = array('volume' => 67, 'edition' => 7);

		// Pass the array, followed by the column names and sort flags
		$sorted = array_orderby($data, 'volume', SORT_DESC, 'edition', SORT_ASC);
 */
function array_orderby ()
{
	$args = func_get_args();
	$data = array_shift($args);
	foreach ($args as $n => $field) {
		if (is_string($field)) {
			$tmp = array();
			foreach ($data as $key => $row) {

				$tmp[$key] = $row[$field];
				$args[$n] = $tmp;
			}
		}
	}
	$args[] = &$data;
	call_user_func_array('array_multisort', $args);
	return array_pop($args);
}

/**
 * Adiciona um índice a todos vetores de uma matriz
 * @package grimoire/bibliotecas/vetores.php
 * @version 05-07-2015
 *
 * @param	array
 * @param	string
 * @param	string
 *
 * @return	array
 */
function adicionarIndice ($matriz, $indice, $valor=null)
{
	$retorno = array();
	foreach ($matriz as $array) {
		$array[$indice] = $valor;
		$retorno[] = $array;
	}
	return $retorno;
}

/**
 * Escreve o conteúdo em um arquivo
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	22/08/2021 14:35:39
 *
 * @param	string
 * @param	string
 * @param	bool	Conservar conteúdo, append
 *
 * @return	array
*/
function utf8Matriz ($matriz, $utf8=true)
{
	foreach ($matriz as $i => $vetor) {
		foreach ($vetor as $i2 => $v) {
			if ( $utf8 ) {
				$matriz[$i][$i2] = utf8_decode($v);
			} else {
				$matriz[$i][$i2] = utf8_encode($v);
			}
		}
	}

	return $matriz;
}

/**
 * Converte uma array com um único índice para string
 * @package grimoire/bibliotecas/vetores.php
 * @version 05-07-2015
 *
 * @param	array
 *
 * @return	string
 */
function converterString ($array)
{
	if (is_array($array) && sizeof($array) == 1) {
		$array = $array[0];
	}

	return $array;
}

/**
 * Envolve o conteudo(array ou string) com o tag de abertura e fechamento do elemento
 * @package grimoire/bibliotecas/vetores.php
 * @version 05-07-2015
 *
 * @param	array
 * @return	array/string
 *
 * @uses	html.php->concatenar()
 * @example
 */
function envolver ($elemento=array(), $conteudo="")
{
	if (!is_array($conteudo)) {
		$string = "$elemento[0]\n$conteudo\n$elemento[1]\n"; // AMBTST
	}
	else {
		$string = "$elemento[0]\n" . concatenar($conteudo, "", "\n") . "\n$elemento[1]\n"; // AMBTST
	}

	return $string;
}

/**
 * Remove um índice da sessão e retorna o conteúdo
 * @package	grimoire/bibliotecas/vetores.php
 * @since	05-07-2015
 * @version	06/08/2021 14:34:39
 *
 * @return	string
 */
function esvaziarMensagem ()
{
	$retorno = "";
	if ( isset($_SESSION['operacao']['mensagem']) ) {
		$retorno = $_SESSION['operacao']['mensagem'];
		unset($_SESSION['operacao']);
	}

	return $retorno;
}

/**
 * Exibe o valor de um índice GET se existir
 * @package grimoire/bibliotecas/vetores.php
 * @since 05-07-2015
 *
 * @param	string
 * @return	bool
 */
function exibirSubIndice ($indice, $subindice)
{
	if ( isset($_GET[$indice]) && isset($_GET[$indice][$subindice]) ) {
		return $_GET[$indice][$subindice];
	}

	return "";
}

/**
 * Exibe o valor de um índice GET se existir
 * @package grimoire/bibliotecas/vetores.php
 * @since 05-07-2015
 *
 * @param	string
 * @return	bool
 */
function exibirIndice ($indice)
{
	if ( isset($_GET[$indice]) ) {
		return $_GET[$indice];
	}

	return "";
}

/**
 * Retorna número do índice de uma array associativa
 * @package grimoire/bibliotecas/vetores.php
 * @version 05-07-2015
 *
 * @param	string
 * @param	array
 * @return	int
 */
function existeIndice ($valor, $array)
{
	if ( is_array($array) ) {
		foreach ($array as $indice=>$v) {
			if ($valor == $indice) {
				return true;
			}
		}
	}

	return -1;
}

/**
 * Atalho para verificar se existe um índice num vetor e se o valor desse índice é igual ao solicitado
 * @package grimoire/bibliotecas/vetores.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	bool
 */
function igual ($array, $indice, $string)
{
	if (isset($array[$indice]) && $array[$indice] == $string) {
		return true;
	}

	return false;
}

/**
* detect if array is a simple array or a struct (associative array)
*
* @param	mixed $val	The PHP array
* @return	string	(arraySimple|arrayStruct)
* @access	private
*/
function isArraySimpleOrStruct ($val)
{
	$keyList = array_keys($val);
	foreach ($keyList as $keyListValue) {
		if (!is_int($keyListValue)) {
			return 'arrayStruct';
		}
	}
	return 'arraySimple';
}

/**
 * Reordena matriz gerada por input type file com o atributo multiple
 * @package grimoire/bibliotecas/vetores.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	array
 */
function rearrange ( $file_post )
{
	$file_ary = array();
	$file_count = count($file_post['name']);
	$file_keys = array_keys($file_post);

	for ($i=0; $i<$file_count; $i++) {
		foreach ($file_keys as $key) {
			$file_ary[$i][$key] = $file_post[$key][$i];
		}
	}

	return $file_ary;
}

/**
 * @since 07/10/2015
 * Aplica recursivamente a função solicitada em todos índices de uma array
 *
 * @example
		$arranjo = array(
			1,
			"nome:	 ",
			"			zé",
			"		-		 ",
			23
		);

		echo $arranjo[0];
		echo $arranjo[1];
		echo $arranjo[2];
		echo $arranjo[3];
		echo $arranjo[4];

		$arranjo = removerEspacos($arranjo);
		echo $arranjo[0];
		echo $arranjo[1];
		echo $arranjo[2];
		echo $arranjo[3];
		echo $arranjo[4];
*/
function removerEspacos ($array)
{
	if ( is_array($array) ) {
		foreach ($array as $index => $value) {
			if ( is_array($value) ) {
				$array[$index] = removerEspacos($value);
			} else {
				$array[$index] = trim($value);
			}
		}
	}

	return $array;
}

/**
 * Remove todos os valores nulos de uma array
 * @package grimoire/bibliotecas/vetores.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	bool
 */
function removerNulos ($array, $opcao=false)
{
	if (!$opcao) {
		$arrayLimpa = array_filter($array, 'strlen'); // Remove nulls
	} else {
		$arrayLimpa = array_filter($array); // Remove falses
	}

	return $arrayLimpa;
}

/**
 * Retira um índice de todos vetores de uma matriz
 * @package grimoire/bibliotecas/vetores.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	bool
 */
function retirarIndice ($matriz, $indice)
{
	$retorno = array();
	foreach ($matriz as $array) {
		unset($array[$indice]);
		$retorno[] = $array;
	}
	return $retorno;
}

/**
 *
 */
function removeIndicePorValor (&$array, $valor)
{
	if ( ( $key = array_search($valor, $array) ) !== false) {
		unset($array[$key]);
	}
}
