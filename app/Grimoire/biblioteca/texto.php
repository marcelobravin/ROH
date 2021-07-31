<?php
/**
 * Manipulação de strings
 * @package grimoire/bibliotecas
*/

function adicionarHifenCep ($cep)
{
	return substr($cep, 0, -3) ."-". substr($cep, -3);
}

/**
* expands entities, e.g. changes '<' to '&lt;'.
*
* @param	string	$val	The string in which to expand entities.
* @access private
*/
function expandEntities ($val)
{
	$val = str_replace('&', '&amp;', $val);
	$val = str_replace("'", '&apos;', $val);
	$val = str_replace('"', '&quot;', $val);
	$val = str_replace('<', '&lt;', $val);
	$val = str_replace('>', '&gt;', $val);
	return $val;
}

/**
 * Formata uma string em formato de CPF
 * @package grimoire/bibliotecas/texto.php
 * @since 03/08/2016 09:19:23
 *
 * @param	string/int
 * @return	string parâmetro convertido em formato de cpf
 *
 * @example
		echo formatarCPF("01234567890");
*/
function formatarCPF ($cpf)
{
	$resultado = substr($cpf, 0, 3);
	$resultado .= ".";
	$resultado .= substr($cpf, 3, 3);
	$resultado .= ".";
	$resultado .= substr($cpf, 6, 3);
	$resultado .= "-";
	$resultado .= substr($cpf, 9, 2);

	return $resultado;
}

/**
 * Adiciona protocolo na url se não tiver
 * @package grimoire/bibliotecas/texto.php
 * @version 05-07-2015
 *
 * @param	string: url
 * @param	string: protocolo [http,https]
 * @return	string
 */
function adicionarProtocolo ($url, $protocolo="http")
{
	if (!preg_match("/^(http|ftp):/", $url)) {
		$url = $protocolo. '://'.$url;
	}
	return $url;
}

/**
 * Verifica se a string contém o trecho solicitado
 * @package grimoire/bibliotecas/texto.php
 * @version 05-07-2015
 *
 * @param	string
 * @param	string
 * @return	bool
 */
function contem ($agulha, $palheiro)
{
	// return str_contains($agulha, $palheiro); # php 8
	if ( strpos($palheiro, $agulha) !== false ) {
		return true;
	}
}

/**
 * Verifica se a string contém o trecho solicitado no começo
 * @package grimoire/bibliotecas/texto.php
 * @version 05-07-2015
 *
 * @param	string
 * @param	string
 * @return	bool
 */
function comecaCom ($needle, $haystack)
{
	return $needle === "" || strpos($haystack, $needle) === 0;
}

/**
 * Verifica se a string contém o trecho solicitado no final
 * @package grimoire/bibliotecas/texto.php
 * @version 05-07-2015
 *
 * @param	string
 * @param	string
 * @return	bool
 */
function terminaCom ($needle, $haystack)
{
	return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
}

/**
 * Transforma uma array em uma string adicionando conteúdo de abertura e fechamento entre todos os índices
 * @package grimoire/bibliotecas/texto.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	string
 */
function concatenar ($array=array(), $abertura="<p>", $fechamento="</p>")
{
	$string = "";
	if (is_array($array)) {
		foreach ($array as $valor) {
			$string .= $abertura . $valor . $fechamento;
		}
	} else {
		$string .= $abertura . $array . $fechamento;
	}
	return $string;
}

function concatenar2 ($array, $cola=QUEBRA_LINHA)
{
	return implode($cola, $array);
}

/**
 * Converte uma string para caixa alta ou caixa baixa conservando a acentuação
 * @package grimoire/bibliotecas/texto.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @example
		echo converterCaixa("Pássaro");
 */
function converterCaixa ($string, $caixaAlta=false)
{
	if ( $caixaAlta ) {
		$string = strtr(strtoupper($string), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
	} else {
		$string = strtr(strtolower($string), "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß", "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ");
	}
	return $string;
}

/**
 * Converte string para minúsculo e a primeira letra para minúsculo
 * @package grimoire/bibliotecas/texto.php
 * @version 05-07-2015
 *
 * @param	string
 * @param	bool
 * @return	string
 */
function formatarString ($string, $tratar=false)
{
	$string = ucfirst(strtolower($string));
	if ($tratar) {
		$string = reescrever($string);
	}
	return $string;
}

/**
 * Shorten an URL, to be used as link text
 * @package grimoire/bibliotecas/texto.php
 * @version 05-07-2015
 *
 * @since 1.2.0
 *
 * @param	string $url
 * @return	string
 */
function limparUrl ( $url )
{
	$short_url = str_replace( array( 'https://', 'http://', 'www.' ), '', $url );
	if ( strlen( $short_url ) > 35 ) {
		$short_url = substr( $short_url, 0, 32 ) . '&hellip;';
	}
	return $short_url;
}

/**
 * Retira espaços e quebras de linha de uma string
 * @package grimoire/bibliotecas/texto.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	string
 */
function minimizarArquivo ($buffer)
{
	$buffer = preg_replace('![ \t]*//.*[ \t]*[\r\n]!', '', $buffer); # Removes single line '//' comments, treats blank characters
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer); # Remove comments
	$buffer = str_replace(': ', ':', $buffer); # Remove space after colons

	// Remove whitespace
	$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '	', '		', '		'), '', $buffer);
	return $buffer;
}

/**
 * Transforma uma string em URL amigável
 * @package grimoire/bibliotecas/texto.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	texto.php->retirarAcento()
 * @uses	texto.php->retirarCaracterEspecial()
 * @example
		echo reescrever("Endereço da sucessão");
 */
function reescrever ($string)
{
	$string = retirarAcento(trim($string));
	$string = retirarCaracterEspecial($string);// RETIRA HIFEN -	SOLUÇÂO: adicionar parametro para retirar hifen
	$string = str_replace(" ", "-", $string);
	$string = strtolower($string);
	return $string;
}

/**
 * Deixa apenas numeros em uma string
 * @package grimoire/bibliotecas/texto.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	string
 */
function remove_non_numeric ($string)
{
	return preg_replace('/\D/', '', $string);
}

/**
 * Retira todos os caracteres especiais de uma string
 * @version 08/09/2016 22:51:47
 *
 * @param	string
 * @return	string
 *
 * @example
		echo retirarCaracterEspecial("Caramba! Vc viu isso, Zé?");
 */
function retirarCaracterEspecial ($string, $retiraEspacos=false)
{
	$especial	= array("'", '"', "!", "@", "#", "$", "%", "¨", "&","*", "(", ")", "-", "=", "+", "´", "`", "[", "]", "{", "}", "~", "^", ",", "<", ".", ">", ";", ":", "/", "?", "\\", "|", "¹", "²", "³","£", "¢", "¬", "§", "ª", "º", "°","_",'"', "–");
	$troca		= str_replace($especial, "", $string);
	if ($retiraEspacos) {
		$troca	= str_replace(" ", "", $troca);
	}
	return $troca;
}

/**
 * Retira todos os acentos de uma string
 * @package grimoire/bibliotecas/texto.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @example
		echo retirarAcento("Mané balão");
 */
function retirarAcento ($string)
{
	$acentos	= array('à','á','â','ã','ä','å','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ù','ü','ú','ÿ','À','Á','Â','Ã','Ä','Å','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ñ','Ò','Ó','Ô','Õ','Ö','O','Ù','Ü','Ú','Ÿ');
	$semAcento	= array('a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','u','u','u','y','A','A','A','A','A','A','C','E','E','E','E','I','I','I','I','N','O','O','O','O','O','O','U','U','U','Y');
	return str_replace($acentos, $semAcento, $string);
}

/**
 * Retorna o endereço da página
 * @package grimoire/bibliotecas/texto.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	bool
 *
 * @uses	expressoesRegulares.php->padrao()
 * @example
		echo retornarEndereco();
 * @todo retornar protocol
 */
function retornarEndereco ()
{
	$pageURL = 'http';
	if (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
		$pageURL .= "s";
	}

	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	}

	return $pageURL;
}

/**
 * Retorna o endereço da página atual
 * @package grimoire/bibliotecas/texto.php
 * @version 05-07-2015
 *
 * @return	string
 *
 * @example
		echo retornarEndereco3();
 */
function retornarEndereco3 ()
{
	$s = "";
	$protocol = substr(strtolower($_SERVER["SERVER_PROTOCOL"]), 0, strpos(strtolower($_SERVER["SERVER_PROTOCOL"]), "/")) . $s;
	$port		= ($_SERVER["SERVER_PORT"] == "80") ? "" : (":" . $_SERVER["SERVER_PORT"]);
	$uri		= $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
	$segments	= explode('?', $uri, 2);
	return $segments[0];
}

/**
 * Verifica se o valor se encaixa no padrão
 * @package grimoire/bibliotecas/texto.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	string
 */
function saudacao ()
{
	$hora = date("H");
	switch (true) {
		case ($hora >= 0 && $hora <= 11):
			$saudacao = "Bom dia";
			break;
		case ($hora >= 12 && $hora <= 17):
			$saudacao = "Boa tarde";
			break;
		case ($hora >= 18 && $hora <= 23):
			$saudacao = "Boa noite";
			break;
		default:
	}
	return $saudacao;
}

/**
 * Limita caracteres sem cortar palavras
 * @package grimoire/bibliotecas/texto.php
 * @version 05-07-2015
 *
 * @param	string
 * @param	 int
 * @param	string
 * @return	string
 */
function truncate ($string, $len, $etc='...')
{
	$end = array(' ', '.', ',', ';', ':', '!', '?' );
	if (strlen($string) <= $len) {
		return $string;
	}
	if (!in_array($string[$len - 1], $end) && !in_array($string[$len], $end)) {
		while (--$len && !in_array($string[$len - 1], $end));
	}
	return rtrim(substr($string, 0, $len)) . $etc;
}

/**
 * Remove comentários html e seus conteúdos
 * @package grimoire/bibliotecas/texto.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	string
 */
function removeHtmlComments ($content = '')
{
	return preg_replace( "HtmlComments", "", $content);
}

/**
 * Remove comentários de bloco
 * @package grimoire/bibliotecas/texto.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	string
 */
function removeBlockComments ($content = '')
{
	return preg_replace( "BlockComments", "", $content);
}

/**
 * Remove comentários de linha
 * @package grimoire/bibliotecas/texto.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	string
 */
function removeJsLineComments ($content = '')
{
	return preg_replace( "JsLineComments", "", $content);
}

/**
 * Remove quebras de linha
 * @package grimoire/bibliotecas/texto.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	string
 */
function removeLineBreaks ($str)
{
	return preg_replace( "LineBreaks", "", $str );
}

/**
 * Remove dois espaços em branco consecutivos
 * @package grimoire/bibliotecas/texto.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	string
 */
function removeDoubleSpaces ($str)
{
	return preg_replace( "DoubleSpaces", "", $str );
}

/**
 * Remove tabs
 * @package grimoire/bibliotecas/texto.php
 * @version 30/07/2021 22:48:04
 *
 * @param	string
 * @return	string
 */
function removeTabs ($str)
{
	return preg_replace( "Tabs", "", $str );
}

/**
 * @package grimoire/bibliotecas/texto.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	string
 */
function removeEspacoEsimbolo ($contents)
{
	//switch, case, break, function,  typeof

	//não tirar
		//case
		//typeof
	//adicionar exclusivo js
		// ;
		// console.log
	//adicionar exclusivo php
		//else_ & _if
		// html comments


	# testar
	/* -*/
	/*- */
	/* &*/
	/*& */
	/*> */
	/* >*/
	/*console.log("baixo")*/ # remover
	/*console.log( funcao() */ # remover

	$response = $contents;
	$response = preg_replace('!console.log.*?\)!s', '', $response);

	$response = preg_replace('/\s\!/'	, '!' 	, $response);
	$response = preg_replace('/\s\(/'	, '(' 	, $response);
	$response = preg_replace('/\s\)/'	, ')' 	, $response);
	$response = preg_replace('/\s\,/'	, ',' 	, $response);
	$response = preg_replace('/\s\:/'	, ':' 	, $response);
	$response = preg_replace('/\s\=/'	, '=' 	, $response);
	$response = preg_replace('/\s\{/'	, '{' 	, $response);
	$response = preg_replace('/\s\}/'	, '}' 	, $response);
	$response = preg_replace('/\s\|/'	, '|' 	, $response);
	$response = preg_replace('/\s\+/'	, '+' 	, $response);
	$response = preg_replace('/\s\;/'	, ';' 	, $response);
	$response = preg_replace('/\s\</'	, '<' 	, $response);
	$response = preg_replace('/\s\>/'	, '>' 	, $response);
	$response = preg_replace('/\s\-/'	, '-' 	, $response);
	$response = preg_replace('/\s\&/'	, '&' 	, $response);
	$response = preg_replace('/\s\//'	, '/' 	, $response);
	// $response = preg_replace('/\sif/'	, 'if'	, $response); # causam problema em js
	$response = preg_replace('/\selse/', 'else', $response);

	$response = preg_replace('/\!\s/'	, '!' 	, $response);
	$response = preg_replace('/\(\s/'	, '(' 	, $response);
	$response = preg_replace('/\)\s/'	, ')' 	, $response);
	$response = preg_replace('/\,\s/'	, ',' 	, $response);
	$response = preg_replace('/\:\s/'	, ':' 	, $response);
	$response = preg_replace('/\=\s/'	, '=' 	, $response);
	$response = preg_replace('/\{\s/'	, '{' 	, $response);
	$response = preg_replace('/\}\s/'	, '}' 	, $response);
	$response = preg_replace('/\|\s/'	, '|' 	, $response);
	$response = preg_replace('/\+\s/'	, '+' 	, $response);
	$response = preg_replace('/\;\s/'	, ';' 	, $response);
	$response = preg_replace('/\<\s/'	, '<' 	, $response);
	$response = preg_replace('/\>\s/'	, '>' 	, $response);
	$response = preg_replace('/\-\s/'	, '-' 	, $response);
	$response = preg_replace('/\&\s/'	, '&' 	, $response);
	$response = preg_replace('/\/\s/'	, '/' 	, $response);
	$response = preg_replace('/if\s/'	, 'if'	, $response);
	// $response = preg_replace('/else\s/', 'else', $response); # causam problema em js

	$response = preg_replace('/\;\;/'	, ';' 	, $response);

	return $response;
}

function substituirOcorrencia ($needle, $replace, $haystack)
{
	$pos = strpos($haystack, $needle);

	if ($pos !== false) {
		return substr_replace($haystack, $replace, $pos, strlen($needle));
	}
}
