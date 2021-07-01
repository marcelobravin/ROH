<?php
/**
 * Manipulação de arrays
 * @package grimoire/bibliotecas
*/

/**
 * Reordena uma matriz
 * @package grimoire/bibliotecas/vetores.php
 * @version 31-07-2015
 * {@link http://php.net/manual/pt_BR/function.array-multisort.php}
 * @todo renomear para ordenarMatriz()
 *
 * @param	 array/string
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
function array_orderby() {
	$args = func_get_args();
	$data = array_shift($args);
	foreach ($args as $n => $field) {
			if (is_string($field)) {
					$tmp = array();
					foreach ($data as $key => $row)
						$tmp[$key] = $row[$field];
						$args[$n] = $tmp;
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
 * @param	 array
 * @param	 string
 * @param	 string
 * @return	array
 *
 * @example
 * @todo adicionar array de indices
 */
function adicionarIndice($matriz, $indice, $valor=null) {
	$retorno = array();
	foreach ($matriz as $array) {
		$array[$indice] = $valor;
		$retorno[] = $array;
	}
	return $retorno;
}

/**
 * Adiciona arquivo de $_FILES a array
 * @package grimoire/bibliotecas/vetores.php
 * @version 05-07-2015
 *
 * @param	 array
 * @param	 string
 * @return	array
 *
 * @uses		arquivos.php->fazerUpload()
 * @todo		identificar tipo de arquivo
 */
function anexarArquivo($vetor, $caminho) {
	if ( !empty($_FILES['foto']['tmp_name'])) {
		$resposta = fazerUpload($_FILES['foto'], true, $caminho);
		$resposta = explode("/", $resposta);
		$resposta = end($resposta);
		$vetor['foto'] = $resposta;
	}
	return $vetor;
}

/**
 * Realiza conversão dos índices de uma array de e para utf8
 * @package grimoire/bibliotecas/vetores.php
 * @version 05-07-2015
 *
 * @param	 array
 * @param	 bool
 * @return	array
 *
 * @example
 * @todo
		return array_map('utf8_encode/utf8_decode', $value)
 */
/*
		// The function
		function utf8_encode_deep(&$input) {
				if (is_string($input)) {
						$input = utf8_encode($input);
				} else if (is_array($input)) {
						foreach ($input as &$value) {
								utf8_encode_deep($value);
						}

						unset($value);
				} else if (is_object($input)) {
						$vars = array_keys(get_object_vars($input));

						foreach ($vars as $var) {
								utf8_encode_deep($input->$var);
						}
				}
		}
*/
function codificarArray($array, $codificar=true){

	if (is_array($array)) {
		//$file_ary = array();
		foreach ($array as $key => $value) {
			if ($codificar) {
				$array[$key] = utf8_encode($value);
			} else {
				$array[$key] = utf8_decode($value);
			}
		}
		return $array;
	} else {
			if ($codificar) {
				return utf8_encode($array);
			} else {
				return utf8_decode($array);
			}
	}
}

/**
 * Converte uma array com um único índice para string
 * @package grimoire/bibliotecas/vetores.php
 * @version 05-07-2015
 *
 * @param	 array
 * @return	string/array
 */
function converterString($array) {
	if (is_array($array) && sizeof($array) == 1) {
		$array = $array[0];
	}

	return $array;
}

/**
 * Converte uma array para utf8
 * @package grimoire/bibliotecas/vetores.php
 * @version 06-07-2015
 *
 * @param	 array
 * @return	array
 */
function converterUtf8($array) {
	array_walk_recursive($array, function(&$item, $key){
		if(!mb_detect_encoding($item, 'utf-8', true)){
			$item = utf8_encode($item);
		}
	});

	return $array;
}

/**
 * Converte uma array para um objeto
 * @package grimoire/bibliotecas/vetores.php
 * @version 05-07-2015
 *
 * @param	 array
 * @return	object
 *
 * @example
		$obj = criarObjeto(array('foo' => 'bar', 'property' => 'value', 'endereco' => array('pan' => 'pum'))); echo $obj->foo; // prints 'bar' //echo $obj->endereco["pan"];
		$obj = criarObjeto(array('foo' => 'bar'));
		echo $obj->foo; // prints 'bar' //echo $obj->endereco["pan"];
		exibir($obj);
 */
function criarObjeto($atributos=array()) {
	return (object) $atributos;
}

/**
 * Envolve o conteudo(array ou string) com o tag de abertura e fechamento do elemento
 * @package grimoire/bibliotecas/vetores.php
 * @version 05-07-2015
 *
 * @param	 array
 * @return	array/string
 *
 * @uses		html.php->concatenar()
 * @example
 */
function envolver($elemento=array(), $conteudo="") {
	if (!is_array($conteudo)) {
		$string = "$elemento[0]\n$conteudo\n$elemento[1]\n"; // AMBTST
	} else {
		$string = "$elemento[0]\n" . concatenar($conteudo, "", "\n") . "\n$elemento[1]\n"; // AMBTST
	}
	return $string;
}

/**
 * Remove um índice da sessão e retorna o conteúdo
 * @package	grimoire/bibliotecas/vetores.php
 * @since	05-07-2015
 * @version	15-06-2021
 *
 * @param	string
 * @return	string
 */
function esvaziarMensagem($indice="mensagem") {
/*
	if(session_id() == '') { // For versions of PHP prior to PHP 5.4.0:
		// session isn't started
	}
*/
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}

	$retorno = "";
	if (isset($_SESSION[$indice])) {
		$retorno = $_SESSION[$indice];
		unset($_SESSION[$indice]);
	}

	return $retorno;
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
function existeIndice($valor, $array) {

	if ( is_array($array) )
		foreach ($array as $indice=>$v) {
			if ($valor === $indice)
				return $indice;

		}

	return -1;
}

/**
 * Atalho para verificar se existe um índice num vetor e se o valor desse índice é igual ao solicitado
 * @package grimoire/bibliotecas/vetores.php
 * @version 05-07-2015
 *
 * @param	 string
 * @return	bool
 */
function igual($array, $indice, $string) {
	if (isset($array[$indice]) && $array[$indice] == $string)
		return TRUE;
}

/**
* detect if array is a simple array or a struct (associative array)
*
* @param	mixed $val	The PHP array
* @return string	(arraySimple|arrayStruct)
* @access private
*/
function isArraySimpleOrStruct($val) {
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
 * @param	 string
 * @return	array
 */
function rearrange( $file_post ){
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
function removerEspacos($array) {
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
 * @param	 string
 * @return	bool
 */
function removerNulos($array, $opcao=false) {
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
 * @param	 string
 * @return	bool
 * @todo
		retirar array de indices
 */
function retirarIndice($matriz, $indice) {
	$retorno = array();
	foreach ($matriz as $array) {
		unset($array[$indice]);
		$retorno[] = $array;
	}
	return $retorno;
}

/**
 * @deprecated
 * Retorna os índices de uma array
 * @package grimoire/bibliotecas/vetores.php
 * @version 05-07-2015
 *
 * @param	 string
 * @return	bool
 */
//array_keys($array); //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
function retornarIndices($array) {
	$retorno = array();
	foreach ($array as $indice => $valor) {
		$retorno[] = $indice;
	}
	return $retorno;
}

/**
 * Converte um resource para uma array associativa
 * @package grimoire/bibliotecas/vetores.php
 * @version 05-07-2015
 *
 * @param	 resource
 * @return	array
 */
function rsParaArray($res){
	$array = array();
	while($row = mysql_fetch_assoc($res)) {
		$array[] = $row;
	}

	return $array;
}

/**
 * Retorna o nome da classe de um objeto
 * @package grimoire/bibliotecas/vetores.php
 * @version 05-07-2015
 *
 * @param	 object
 * @return	string: the name of this class
 */
function toString($object) {
	return get_class($object);
}