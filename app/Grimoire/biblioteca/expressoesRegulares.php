<?php
/**
 * Biblioteca de expressões regulares
 * @package grimoire/bibliotecas
*/

/**
 * Retorna a expressão regular correspondente ao padrão solicitado
 * @package	grimoire/bibliotecas/expressoesRegulares.php
 * @since	05-07-2015
 * @version 17/07/2021 15:49:23
 *
 * @param	string	Padrão desejado
 * @return	string	Expressão regular OU string vazia
 */
function padrao ($padrao)
{
	switch ($padrao) {

		case "alfa": # letras minúsculas
			$r = "/^([a-z])+$/i";
			break;

		case "alfanumerico":
			$r = "/^([a-z0-9])+$/i";
			break;

		case "alfanumerico_e_espacos":
			$r = "/^([a-zA-Z0-9 ])+$/i";
			break;

		case "alpha_dash": # Alpha-numeric with underscores and dashes
			$r = "^([-a-z0-9_-])+$/i";
			break;

		case "alpha_space":
			$r = "/^([a-z ])+$/i";
			break;

		/**
		 * Valid Base64
		 *
		 * Tests a string for characters outside of the Base64 alphabet
		 * as defined by RFC 2045 {@link http://www.faqs.org/rfcs/rfc2045}
		 */
		case "base64":
			$r = '/[^a-zA-Z0-9\/\+=]/';
			break;

		case "BlockComments":
			$r = '!/\*.*?\*/!s';
			break;

		case "cep":
			$r = "^[0-9]{5}-[0-9]{3}$^";
			break;

		case "celularComMascara":
			$r = '/^(\(11\) (9\.\d{4})-\d{4})|((\(1[2-9]{1}\)|\([2-9]{1}\d{1}\)) [5-9]\d{3}-\d{4})$/';
			break;

		case "celularSemMascara":
			$r = '/^\(?\d{2}\)?\s?\d{5}\-?\d{4}$/';
			break;

		case "comentários multi-linha":
			$r = '/^[(/*)+.+(*/)]$/';
			break;

		case "comentário js":
			$r = '/((?!:).(\/\/))*$/s';
			break;

		case "codigo_postal":
			$r = '/^[0-9]{5,5}([- ]?[0-9]{4,4})?$/';
			break;

		case "cor_hexadecimal":
			$r = '/^#(?:(?:[a-f\d]{3}){1,2})$/i';
			break;

		case "cpf":
			$r = "/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}\-[0-9]{2,2}$/";
			break;

		case "cnpj":
			$r = '/^[0-9+\/.-]{18}$/i';
			break;

		case "data":
			//'/^\d{1,2}\/\d{1,2}\/\d{4}$/'
			$r = "^[0-9]{2}/[0-9]{2}/[0-9]{4}$^";
			break;

		case "DoubleSpaces":
			$r = "/  /";
			break;

		case "email":
			$r = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
			break;
			// '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/'
			// "/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/";

		case "endereco": # alfanumerico_simbolos_e_espacos
			$r = "/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ' 0-9,.]+$/";
			break;

		case "htmlComments":
			$r = '/<!--(.|\s)*?-->/';
			break;

		case "integer":
			$r = '/^[\-+]?[0-9]+$/';
			break;

		case "ip": # v4
			$r = '^(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:[.](?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}$';
			break;

		case "JsLineComments":
			$r = '/\b(?!\:)\/\/.*\n/';
			break;

		case "letras": # Valida se a string é composta apenas de letras maiúsculas e minúsculas
			$r = "/^[a-zA-Z]+$/";
			break;

		case "letras_e_espaco":
			$r = "/^[a-zA-Z ]+$/";
			break;

		case "letras_espacos_acentos_apostrofe":
			$r = "/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ' ]+$/";
			break;

		case "LineBreaks":
			$r = "/\r|\n/";
			break;

		case "mac":
			$r = "/[0-9A-f]{2}-[0-9A-f]{2}-[0-9A-f]{2}-[0-9A-f]{2}-[0-9A-f]{2}-[0-9A-f]{2}/";
			break;

		default: $r = padrao2($padrao);
	}

	return $r;
}

function padrao2 ($padrao)
{
	switch ($padrao) {

		case "natural": # Is a Natural number	(0,1,2,3, etc.)
			$r = '/^[0-9]+$/';
			break;

		case "numeric":
			$r = '/^[\-+]?[0-9]*\.?[0-9]+$/';
			break;
		case "Tabs":
			$r = "/	/";
			break;

		case "telefone":
			$r = "/^\(?\d{2}\)?\s?\d{4}\-?\d{4}$/";
			break;

		case "url":
			$r = '/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i';
			break;

		default: $r = false;
	}

	return $r;
}
