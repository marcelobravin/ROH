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
 * @param	string	Padrão
 * @return	string	Expressão regular OU string vazia
 */
function padrao ($padrao)
{
	switch ($padrao) {

		case "alfa": # letras minúsculas
			return "/^([a-z])+$/i";

		case "alfanumerico":
			return "/^([a-z0-9])+$/i";

		case "alfanumerico_e_espacos":
			return "/^([a-zA-Z0-9 ])+$/i";

		case "alpha_dash": # Alpha-numeric with underscores and dashes
			return "^([-a-z0-9_-])+$/i";

		case "alpha_space":
			return "/^([a-z ])+$/i";

		/**
		 * Valid Base64
		 *
		 * Tests a string for characters outside of the Base64 alphabet
		 * as defined by RFC 2045 {@link http://www.faqs.org/rfcs/rfc2045}
		 */
		case "base64":
			return '/[^a-zA-Z0-9\/\+=]/';

		case "cep":
			return "^[0-9]{5}-[0-9]{3}$^";

		case "celular":
			return '/^(\(11\) (9\d{4})-\d{4})|((\(1[2-9]{1}\)|\([2-9]{1}\d{1}\)) [5-9]\d{3}-\d{4})$/';

		case "comentários multi-linha":
			return '/^[(/*)+.+(*/)]$/';

		case "cpf":
			return "/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}\-[0-9]{2,2}$/";
			//$re = preg_match("^([0-9]){3}\.([0-9]){3}\.([0-9]){3}-([0-9]){2}$^", $cpf);

		case "cnpj":
			return '/^[0-9+\/.-]{18}$/i';

		case "data":
			return "^[0-9]{2}/[0-9]{2}/[0-9]{4}$^";

		case "email":
			return "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
			// return "/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/";

		case "endereco": # alfanumerico_simbolos_e_espacos
			return "/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ' 0-9,.]+$/";

		case "integer":
			return '/^[\-+]?[0-9]+$/';

		case "ip": # v4
			return '^(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:[.](?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}$';
			// return "^([0-9]){1,3}.([0-9]){1,3}.([0-9]){1,3}.([0-9]){1,3}$^";

		case "letras": # Valida se a string é composta apenas de letras maiúsculas e minúsculas
			return "/^[a-zA-Z]+$/";

		case "letras_e_espaco":
			return "/^[a-zA-Z ]+$/";

		case "letras_espacos_acentos_apostrofe":
			return "/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ' ]+$/";

		case "mac":
			return "/[0-9A-f]{2}-[0-9A-f]{2}-[0-9A-f]{2}-[0-9A-f]{2}-[0-9A-f]{2}-[0-9A-f]{2}/";

		case "natural": # Is a Natural number	(0,1,2,3, etc.)
			return '/^[0-9]+$/';

		case "numeric":
			return '/^[\-+]?[0-9]*\.?[0-9]+$/';

		case "url":
			return '/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i';
			// return "|^http(s)?://[a-z0-9-]+(\.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";
			// return '(https?|ftp):\/\/)|www\.)(([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)|localhost|([a-zA-Z0-9\-]+\.)*[a-zA-Z0-9\-]+\.(com|net|org|info|biz|gov|name|edu|[a-zA-Z][a-zA-Z]))(:[0-9]+)?((\/|\?)[^ "]*[^ ,;\.:">)])?

	}

	return false;
}
