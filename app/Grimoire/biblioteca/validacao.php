<?php
/**
 * Validação de valores e padrões de dados
 * @package	grimoire/bibliotecas
*/

/**
 * Retorna um int com o nível de diferença entre duas strings
 * @package	grimoire/bibliotecas/validacao.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	bool
 *
 * @example
	echo compararCampos($_POST['senha'], $_POST['confirmeSenha'], true);
 */
function compararCampos ($string1, $string2, $caseSensitive=true)
{
	if ($caseSensitive) {
		return strcmp($string1, $string2);
	} else {
		return strcasecmp($string1, $string2);
	}
}

/**
 * Exact Length
 * @package	grimoire/bibliotecas/validacao.php
 * @version	05-07-2015
 *
 * @access	public
 * @param string
 * @param value
 * @return	bool
 */
function exact_length ($str, $val)
{
	return (strlen($str) != $val) ? FALSE : TRUE;
}

/**
 * Minimum Length
 * @package	grimoire/bibliotecas/validacao.php
 * @version	05-07-2015
 *
 * @access	public
 * @param string
 * @param int
 * @return	bool
 */
function min_length ($str, $val)
{
	return (strlen($str) < $val) ? FALSE : TRUE;
}

/**
 * Max Length
 * @package	grimoire/bibliotecas/validacao.php
 * @version	05-07-2015
 *
 * @access	public
 * @param string
 * @param value
 * @return	bool
 */
function max_length ($str, $val)
{
	return (strlen($str) > $val) ? FALSE : TRUE;
}

function validacao ($post, $camposObrigatorios, $mapaFormatos=array(), $mapaTamanhos=array())
{
	$erros = array();

	# validações específicas
	foreach ($mapaFormatos as $i => $v) {
		if ($v == "cpf") {
			# switch ip etc, ver validacoes
			if ( !validarCPF($post[$i]) ) {
				$erros[] = "CPF inválido";
			}

			unset($camposObrigatorios[$v]);
			unset($mapaFormatos[$v]);
			unset($post[$v]);
		} else if ($v == "cnpj") {
			if ( !validarCNPJ($post[$i]) ) {
				$erros[] = "CNPJ inválido";
			}

			unset($camposObrigatorios[$v]);
			unset($mapaFormatos[$v]);
			unset($post[$v]);
		}
	}

	# validação de formato e caracteres
	$camposEmFormatoInvalidos = validarFormatos($post, $mapaFormatos);
	if ( !empty($camposEmFormatoInvalidos) ) {
		$erros["violacoes_de_formato"] = $camposEmFormatoInvalidos;
	}

	# validação de campos vazios que escaparam das validações anteriores
	$camposVazios = validarCamposObrigatorios($camposObrigatorios);
	if ( !empty($camposVazios) ) {
		$erros["campos_obrigatorios_nao_preenchidos"] = $camposVazios;
	}

	$x = validaTamanhos($mapaTamanhos, $post); # TODO testar e corrigir
	if ( !empty($x['violacoes_tamanho_minimo']) ) {
		$erros["violacoes_tamanho_minimo"] = $x['violacoes_tamanho_minimo'];
	}
	if ( !empty($x['violacoes_tamanho_maximo']) ) {
		$erros["violacoes_tamanho_maximo"] = $x['violacoes_tamanho_maximo'];
	}

	return $erros;
}

# validação de tamanhos
function validaTamanhos ($mapaTamanhos, $post)
{
	$erros = array(
		"violacoes_tamanho_minimo" => array(),
		"violacoes_tamanho_maximo" => array()
	);
	foreach ( $mapaTamanhos as $i => $v) {
		$l = isset($post[$i])
			? strlen($post[$i])
			: 0;

		if ($l > 0) { # caso um campo não obrigatorio tenha sido enviado vazio
			if ( isset($mapaTamanhos[$i]['minimo']) && $l < $mapaTamanhos[$i]['minimo'] ) {
				$erros["violacoes_tamanho_minimo"][] = array(
					'campo'		=> $i,
					'numero'	=> $mapaTamanhos[$i]['minimo']
				);
			}

			if ( $l > $mapaTamanhos[$i]['maximo'] ) {
				$erros["violacoes_tamanho_maximo"][] = array(
					'campo'		=> $i,
					'numero'	=> $mapaTamanhos[$i]['maximo']
				);
			}
		}
	}

	return $erros;
}

/**
 * Verifica se o valor se encaixa no padrão
 * @package	grimoire/bibliotecas/validacao.php
 * @version	05-07-2015
 *
 * @param	string padrao a ser testado
 * @param	string valor a ser testado
 * @return	bool
 *
 * @uses	expressoesRegulares.php->padrao()
 * @example
		echo validar('data', '31/01/2012');
 */
function validar ($padrao, $valor)
{
	$expressaoRegular = padrao($padrao);

	if ( empty($expressaoRegular) ) {
		die("Expressão regular não encontrada para:<br>{$valor} => {$padrao}");
	}

	return preg_match($expressaoRegular, $valor);
}

/**
 * Valida se os campos solicitados foram preenchidos
 * @package	grimoire/bibliotecas/validacao.php
 * @version	05-07-2015
 *
 * @param	array
 * @param	array
 *
 * @return	array
 */
function validarCamposObrigatorios ($campos)
{
	$erros = array();
	foreach ($campos as $i => $v) {
		if ( strlen($v) == 0 ) {
			$erros[] = $i;
		}
	}

	return $erros;
}

/**
 * Valida array de campos conforme array de formatos
 * @package	grimoire/bibliotecas/validacao.php
 * @since	17/07/2021 16:28:24
 *
 * @param	array
 * @param	array
 * @return	array
 *
 * @uses	validacao.php->validar()
 */
function validarFormatos ($campos, $formatos)
{
	$erros = array();

	foreach ($formatos as $i => $v) {
		if ( !empty($campos[$i]) ) {

			$validado = validar($v, $campos[$i]);
			if ( !$validado ) {
				$erros[] = [
					'campo'		=> $i,
					'padrao'	=> $v,
					'valor'		=> $campos[$i]
				];
			}
		}
	}

	return $erros;
}

/**
 * Valida CNPJ
 * @package	grimoire/bibliotecas/validacao.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	bool
 *
 * @uses	validacao.php->validar()
 * @example
		echo validarCnpj("11.111.111/1111-11");
 */
function validarCnpj ($cnpj)
{
	if (!validar("cnpj", $cnpj)) {
		return false;
	} else {
		$sinais = array("/"," ",".","-",",");
		$cnpj = str_replace($sinais,"",$cnpj);

		if (strlen($cnpj) <> 14) {
			return false;
		}
		$soma1 = ($cnpj[0] * 5) +
			($cnpj[1] * 4) +
			($cnpj[2] * 3) +
			($cnpj[3] * 2) +
			($cnpj[4] * 9) +
			($cnpj[5] * 8) +
			($cnpj[6] * 7) +
			($cnpj[7] * 6) +
			($cnpj[8] * 5) +
			($cnpj[9] * 4) +
			($cnpj[10] * 3) +
			($cnpj[11] * 2);
			$resto = $soma1 % 11;
			$digito1 = $resto < 2 ? 0 : 11 - $resto;
			$soma2 = ($cnpj[0] * 6) +
			($cnpj[1] * 5) +
			($cnpj[2] * 4) +
			($cnpj[3] * 3) +
			($cnpj[4] * 2) +
			($cnpj[5] * 9) +
			($cnpj[6] * 8) +
			($cnpj[7] * 7) +
			($cnpj[8] * 6) +
			($cnpj[9] * 5) +
			($cnpj[10] * 4) +
			($cnpj[11] * 3) +
			($cnpj[12] * 2);
		$resto = $soma2 % 11;
		$digito2 = $resto < 2 ? 0 : 11 - $resto;
		return ($cnpj[12] == $digito1) && ($cnpj[13] == $digito2);
	}
}

/**
 * Verifica se o valor se encaixa no padrão
 * @package	grimoire/bibliotecas/validacao.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	bool
 *
 * @uses	validacao.php->validar()
 * @example
		echo validarCpf("307.485.238-04"); # true
		echo validarCpf("30748523804"); # true
		echo validarCpf("111.111.111-11"); #false
 */
function validarCpf ($cpf)
{
	$sinais = array("/", " ", ".", "-", ",");
	$cpf = str_replace($sinais, "", $cpf);

	if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf) || $cpf == '01234567890') {
		return false;
	}

	// Calcula os números para verificar se o CPF é verdadeiro
	for ($t = 9; $t < 11; $t++) {
		for ($d = 0, $c = 0; $c < $t; $c++) {
			$d += $cpf[$c] * (($t + 1) - $c);
		}

		$d = ((10 * $d) % 11) % 10;
		if ($cpf[$c] != $d) {
			return false;
		}
	}

	return true;
}

/**
 * Valida data no formato dd/mm/aaaa e opcionalmente se essa ultrapassa a data mínima ou máxima
 * @package	grimoire/bibliotecas/validacao.php
 * @since	05-07-2015
 * @version	06/08/2021 08:18:44
 *
 * @param	string
 * @param	string
 * @param	string
 * @return	bool
 *
 * @uses	validacao.php->validar()
 * @example
	echo validarData("01/01/2021", "01/01/2013", "01/01/2020");
	echo validarData("01/01/2000");
*/
function validarData ($data, $dataMinima=null, $dataMaxima=null)
{
	if ( !validar("data", $data) ) {
		return false;
	} else {
		if (
			!empty($dataMinima) && days_diff($data, $dataMinima) > 0
			||
			!empty($dataMaxima) && days_diff($data, $dataMaxima) < 0 )
		{
			return false;
		}
	}
	return true;
}

/**
 * Inclui e valida inscrição estadual
 * @package	grimoire/bibliotecas/validacao.php
 * @since	05-07-2015
 * @version	24/07/2021 16:17:30
 *
 * @param	string
 * @param	string
 * @return	bool
 */
function validaIE ($ie, $uf="SP")
{
	include_once "opcionais/validacao/inscricaoEstadual.php";
	return CheckIE($ie, $uf);
}

/**
 * Verifica se o valor se encaixa no padrão
 * @package	grimoire/bibliotecas/validacao.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	bool
 *
 * @uses	validacao.php->validar()
 * @example
	echo validarIp("189.18.125.-183");
	echo validarIp("255.18.125.183");
*/
function validarIp ($ip)
{
	if (strtolower($ip) === 'unknown') {
		return false;
	}

	// generate ipv4 network address
	$ip = ip2long($ip);

	// if the ip is set and not equivalent to 255.255.255.255
	if ($ip !== false && $ip !== -1) {
		// make sure to get unsigned long representation of ip
		// due to discrepancies between 32 and 64 bit OSes and
		// signed numbers (ints default to signed in PHP)
		$ip = sprintf('%u', $ip);
		if ( rangeIp ($ip) ) {
			return false;
		}
	}

	return true;
}

// do private network range checking
function rangeIp ($ip)
{
	if (
		$ip >= 0 && $ip <= 50331647
		|| $ip >= 167772160 && $ip <= 184549375
		|| $ip >= 2130706432 && $ip <= 2147483647
		|| $ip >= 2851995648 && $ip <= 2852061183
		|| $ip >= 2886729728 && $ip <= 2887778303
		|| $ip >= 3221225984 && $ip <= 3221226239
		|| $ip >= 3232235520 && $ip <= 3232301055
		|| $ip >= 4294967040
	) {
		return true;
	}

	return false;
}

/**
 * Valida senha criptografada
 * @package	grimoire/bibliotecas/validacao.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	bool
 *
 * @example
		$user_input = 'mypassword';
		$password = '$1$lr0.Kr0.$q3XbIJ4KV1jgyyF7sZ0VC/'; // let the salt be automatically
		// echo $password = criptografar('mypassword'); // let the salt be automatically
		echo validarSenha($user_input, $password);
 */
function validarSenha ($user_input, $password)
{
	return crypt($user_input, $password) === $password;
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
/**
 *
 * Validar nome de usuário
 * Essa regra é para permitir usuários com nome de 4 a 28 caracteres, alfanuméricos e acentuados:
 */
function validaUserName ($string = "userNaME4234432_")
{
	return preg_match('/^[a-z\d_]{4,28}$/i', $string);
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
/**
 *
 * Números telefônicos
 * Essa regra é para validar números de telefone, e os números devem ser escritos da seguinte maneira (###)###-####:
 */
function validaNumeroTelefonicos ($string = "(032)555-5555")
{
	return preg_match('/^(\(?[2-9]{1}[0-9]{2}\)?|[0-9]{3,3}[-. ]?)[ ][0-9]{3,3}[-. ]?[0-9]{4,4}$/', $string);
}

/**
 * Permite utilizar números no seguinte formato: xxxxx e xxxxx-xxxx
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
function validaCodigoPostal ($string = "55324-4324")
{
	return validar("CodigoPostal", $string);
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
/**
 *
 * Cores Hexadecimais
 * Você também pode verificar valores hexadecimais em suas 2 formas, a normal e a abreviada: (#333, 333, #333333 o 333333) com o símbolo # opcional
 */
function validaCoresHexadecimais ($string = "#666666")
{
	return validar("hexadecimal", $string);
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
/**
 *
 * Datas
 * Um formato de data típico MM/DD/YYYY e sua validação é a seguinte:
*/
function validaData ($string = "10/15/2007")
{
	return validar("data", $string);
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
function url ($param)
{
	return filter_var( $param, FILTER_VALIDATE_URL );
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
function tamanhoMaximo ($param, $maxlength)
{
	return strlen($param) > $maxlength;
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
function tamanhoMinimo ($param, $minlength)
{
	return strlen($param) > $minlength;
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
function dataValida ($date, $format = 'Y-m-d')
{
	$d = DateTime::createFromFormat($format, $date);
	return !empty($d) ? 1 : 0;
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
function verificarDataMaior ($data1, $data2)
{
	return strtotime($data1) > strtotime($data2);
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
function verificarDataMenor ($data1, $data2)
{
	return strtotime($data1) < strtotime($data2);
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
function verificarDataIgual ($data1, $data2)
{
	return strtotime($data1) == strtotime($data2);
}

/**
 * Ensures an ip address is both a valid IP and does not fall within
 * a private network range.
 */

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
function isEmail ($param)
{
	return filter_var( $param, FILTER_VALIDATE_EMAIL);
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
function montaRespostaValidacao ($errosFormulario)
{
	$resposta = "Erro no preenchimento do formulário!";

	foreach ($errosFormulario as $i => $v) {
		if ( is_numeric($i)) {
			$resposta .= "<br>-".$v;
		} else {
			switch ( $i ) {
				case "violacoes_de_formato" :
					foreach ($v as $v2) {
						$resposta .= "<br>-".$v2['campo']. " contém caracteres inválidos";
					}
					break;
				case "campos_obrigatorios_nao_preenchidos" :
					foreach ($v as $v2) {
						$resposta .= "<br>-".$v2. " é obrigatório";
					}
					break;
				case "violacoes_tamanho_minimo" :
					foreach ($v as $v2) {
						$resposta .= "<br>-".$v2['campo']. " não pode ter menos de {$v2['numero']} caracteres";
					}
					break;

				case "violacoes_tamanho_maximo" :
					foreach ($v as $v2) {
						$resposta .= "<br>-".$v2['campo']. " não pode ter mais de {$v2['numero']} caracteres";
					}
					break;

				default:
			}
		}
	}

	montarRespostaPost($resposta, false, 201); # 201 Created
}
