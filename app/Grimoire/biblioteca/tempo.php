<?php
/**
 * Manipulação de tempo e datas
 * @package	grimoire/bibliotecas
*/

/**
 * Cria constantes para tempo em segundos
 * @package	grimoire/bibliotecas/tempo.php
 * @since 09/09/2016
 *
 * @return	void
 */
function defineTempo ()
{
	define( "SECOND"	, 1 );
	define( "MINUTE"	, 60 );
	define( "HOUR"		, 3600 );
	define( "DAY"		, 86400 );
	define( "WEEK"		, 604800 );
	define( "MONTH"		, 2592000 );
	define( "YEAR"		, 31536000 );
}

/**
 * Retorna o timestamp atual
 * @package	grimoire/bibliotecas/tempo.php
 * @since	05-07-2015
 *
 * @param	bool
 * @return	string
 */
function agora ($padraoBrasileiro=false)
{
	if ( !$padraoBrasileiro ) {
		return date("Y-m-d H:i:s");
	} else {
		return date("d-m-Y H:i:s");
	}
}

/**
 * Retorna o timestamp atual sem separadores
 * @package	grimoire/bibliotecas/tempo.php
 * @since	16/07/2018 16:49:07
 *
 * @param	bool
 * @return	string
 */
function agoraLimpo ($timestamp=false)
{
	if ( $timestamp ) {
		return date("YmdHis");
	} else {
		return date("Ymd");
	}
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
	echo apos(20151104, 20151130);
*/
function apos ( $dataInicial, $dataAlvo="" )
{
	if ( empty($dataAlvo) ) {
		$dataAlvo = hoje();
	}

	if ( $dataAlvo >= $dataInicial) {
		return true;
	}

	return false;
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
	echo antes(20151130, 20151130);
*/
function antes ( $dataFinal, $dataAlvo="" )
{
	if ( empty($dataAlvo) ) {
		$dataAlvo = hoje();
	}

	if ( $dataAlvo <= $dataFinal ) {
		return true;
	}

	return false;
}

/**
 * Calcula a idade
 * @package	grimoire/bibliotecas/tempo.php
 * @since	05-07-2015
 *
 * @param	string
 * @return	bool
 */
function calcularIdade ($dataNascimento)
{
	$dataNascimento = str_replace("-", "", $dataNascimento);
	$hoje = date("Ymd");
	$diferenca = $hoje - $dataNascimento;
	return intval($diferenca / 10000);
}

/**
 * Converte data de formato americano para brasileiro e vice-versa de forma compacta
 * @package	grimoire/bibliotecas/tempo.php
 * @since	05-07-2015
 *
 * @param	string
 * @param	bool
 * @return	string
 */
function converterData ($data, $br=true)
{
	if ($br) {
		$separadorAntigo	= "-";
		$separador			= "/";
	} else {
		$separadorAntigo	= "/";
		$separador			= "-";
	}

	$data = explode($separadorAntigo, $data);
	$data = $data[2] . $separador . $data[1] . $separador . $data[0];
	return $data;
}

/**
 * Coloca nos moldes timestamps
 * @package	grimoire/bibliotecas/tempo.php
 * @since	05-07-2015
 *
 * @param	string
 * @param	bool
 * @return	string
 */
function converterTimestamp ($data, $br=true)
{
	if ($br) {
		$separadorAntigo = "-";
		$separador			 = "/";
	} else {
		$separadorAntigo = "/";
		$separador			 = "-";
	}

	$data = explode($separadorAntigo, $data);
	$horario = explode(' ', $data[2]);
	$dataFinal = $horario[0] . $separador . $data[1] . $separador . $data[0];
	$dataFinal .= " ". $horario[1];
	return $dataFinal;
}

/**
 * Retorna uma array com a diferença entre duas datas
 * @package	grimoire/bibliotecas/tempo.php
 * @since	05-07-2015
 *
 * @param	string
 * @return	bool
 */
function dateDifference ($startDate, $endDate)
{
	$startDate = strtotime($startDate);
	$endDate	 = strtotime($endDate);
	if ($startDate === false || $startDate < 0 || $endDate === false || $endDate < 0 || $startDate > $endDate) {
		return false;
	}
	$years		= date('Y', $endDate) - date('Y', $startDate);
	$endMonth	= date('m', $endDate);
	$startMonth = date('m', $startDate);
	// Calculate months
	$months		 = $endMonth - $startMonth;
	if ($months <= 0) {
		$months += 12;
		$years--;
	}
	if ($years < 0) {
		return false;
	} // acho q dá pra tirar isso! =D
	// Calculate the days
	$offsets = array();
	if ($years > 0) {
		$offsets[] = $years . (($years == 1) ? ' year' : ' years');
	}
	if ($months > 0) {
		$offsets[] = $months . (($months == 1) ? ' month' : ' months');
	}
	$offsets = empty($offsets) ? '+' . implode(' ', $offsets) : 'now';
	$days	= $endDate - strtotime($offsets, $startDate);
	$days	= date('z', $days);

	return array(
		$years,
		$months,
		$days
	);
}

/**
 * Retorna número de dias de intervalo entre duas datas
 * @package	grimoire/bibliotecas/tempo.php
 * @since	05-07-2015
 *
 * @param	string
 * @return	bool
 *
 * @example
		echo days_diff("12-12-2001", "12-12-2011");
		echo days_diff("01-08-2013", null, false);
		echo days_diff(null, "01-09-2013");
 */
function days_diff ($date_ini=null, $date_end=null, $round=true)
{
// Se vazios seta datas como a data de agora
	if (empty($date_ini)) {
		$date_ini = time();
	}
	else {
		$date_ini = strtotime($date_ini);
	}

	if (empty($date_end)) {
		$date_end = date("d-m-Y");
	}
	else {
		$date_end = strtotime($date_end);
	}

	$date_diff = ($date_end - $date_ini) / 86400;

	if ($round)
		$date_diff = floor($date_diff);// arredonda pra dias

	return $date_diff;
}

/**
 * Retorna número de dias de intervalo entre duas datas
 * @package	grimoire/bibliotecas/tempo.php
 * @since	05-07-2015
 *
 * @param	string
 * @return	bool
 *
 * @example
		echo days_diff("12-12-2001", "12-12-2011");
		echo days_diff("01-08-2013", null, false);
		echo days_diff(null, "01-09-2013");
 */
function descartarHorario ($timestamp, $ptBr=true)
{
	$fragmentos = explode(' ', $timestamp);
	if ($ptBr) {
		return $fragmentos[0];
	}
	else {
		return $fragmentos[1];
	}
}

/**
 * Calcula a diferença de tempo entre duas datas
 * @package	grimoire/bibliotecas/tempo.php
 * @since	05-07-2015
 *
 * @param	string
 * @param	string
 * @return	string
 *
 * @example
		$data1 = '2006-07-22 12:27:00';
		$data2 = '2006-07-23 12:20:00';
		echo diferenca($data1, $data2);
 */
function diferenca ($data1, $data2)
{
	$unix_data1 = strtotime($data1);
	$unix_data2 = strtotime($data2);

	$nHoras	 = ($unix_data2 - $unix_data1) / 3600;
	$nMinutos = (($unix_data2 - $unix_data1) % 3600) / 60;
	$nSegundos = (($unix_data2 - $unix_data1) % 3600) % 60;

	# Ás vezes arredonda errado

	$nHoras = explode(".", $nHoras);
	$nHoras = $nHoras[0];

	$nMinutos = explode(".", $nMinutos);
	$nMinutos = $nMinutos[0];

	if ($nMinutos < 10) {
		$nMinutos = "0". $nMinutos;
	}

	if ($nSegundos < 10) {
		$nSegundos = "0". $nSegundos;
	}

	return "$nHoras:$nMinutos:$nSegundos";
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
#http://php.net/manual/en/dateinterval.format.php
/*echo diferenca( $c['data'] )->format('%d days')*/
function diferenca3 ($dataInicial, $dataFinal="")
{
	if (empty($dataFinal)) {
		$dataFinal=hoje();
	}

	$data1 = new DateTime( $dataInicial );
	$data2 = new DateTime( $dataFinal );

	return $data1->diff( $data2 );
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
function diferenca2 ($dataInicial, $dataFinal="")
{
	if (empty($dataFinal)) {
		$dataFinal=hoje();
	}

	$dataInicial = str_replace("-", "", $dataInicial);
	$dataFinal = str_replace("-", "", $dataFinal);

	return $dataInicial - $dataFinal;
}

/**
 * Verifica se o valor se encaixa no padrão
 * @package	grimoire/bibliotecas/tempo.php
 * @since	05-07-2015
 *
 * @param	string
 * @return	bool
 */
function diferencaTempo ($dataInicial, $dataFinal)
{
	$x = strtotime($dataInicial) * 1000;
	$y = strtotime($dataFinal) * 1000;
	return $x - $y;
}

/**
 * Retorna a data atual
 * @package	grimoire/bibliotecas/tempo.php
 * @since	05-07-2015
 *
 * @param	bool
 * @return	string
 */
function hoje ($padraoBrasileiro=FALSE)
{
	if (!$padraoBrasileiro) {
		return date("Y-m-d");
	} else {
		return date("d-m-Y");
	}
}

/**
 * Retorna a hora atual
 * @package	grimoire/bibliotecas/tempo.php
 * @since	05-07-2015
 *
 * @param	bool
 * @return	string
 */
function hora ()
{
	return date("H:i:s");
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
/* MSB 25/11/2015 */
function horasEmMinutos ($horas)
{
	$temp = explode(":", $horas);
	$minutos = $temp[0] * 60;
	$minutos = $minutos + $temp[1];

	return $minutos;
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
function minutosEmHoras ($minutos)
{
	$horas	= intval($minutos / 60);
	$minutos = $minutos % 60;

	if ( $minutos < 10 ) {
		$minutos = '0'. $minutos;
	}

	return $horas .':'. $minutos;
}

/**
 * Verifica se o valor se encaixa no padrão
 * @package	grimoire/bibliotecas/tempo.php
 * @since	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @example
		$date = "2013-06-17 17:45";
		echo $result = nicetime($date); // 2 days ago
 */
function nicetime ($date)
{
	if (empty($date)) {
		return "No date provided";
	}
	$periods	 = array(
		"second",
		"minute",
		"hour",
		"day",
		"week",
		"month",
		"year",
		"decade"
	);
	$lengths	 = array(
		"60",
		"60",
		"24",
		"7",
		"4.35",
		"12",
		"10"
	);
	$now			 = time();
	$unix_date = strtotime($date);
	// check validity of date
	if (empty($unix_date)) {
		return "Bad date";
	}

	// is it future date or past date
	if ($now > $unix_date) {
		$difference = $now - $unix_date;
		$tense		= "ago";
	} else {
		$difference = $unix_date - $now;
		$tense		= "from now";
	}
	for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
		$difference /= $lengths[$j];
	}
	$difference = round($difference);
	if ($difference != 1) {
		$periods[$j] .= "s";
	}

	return "$difference $periods[$j] {$tense}";
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
function retornaSemestre ()
{
	$sem = date('m');
	$sem = substr($sem / 7,0,1);
	if ($sem == 0) {
		$sem = 1;
	} else {
		$sem = 2;
	}

	return($sem);
}

/**
 * Retorna data pt-BR por extenso
 * @package	grimoire/bibliotecas/tempo.php
 * @since	05-07-2015
 *
 * @param	string
 * @return	string
 *
 * @uses	tempo.php->trataMes()
 */
function trataData ($data)
{
	$data		= explode("/", $data);
	$ano		= $data[2];
	$mes		= $data[1];
	$dia		= $data[0];
	$mes		= trataMes($mes);
	$separador	= " de ";
	return $dia . $separador . $mes . $separador . $ano;
}

/**
 * Retorna dia da semana por extenso
 * @package	grimoire/bibliotecas/tempo.php
 * @since	05-07-2015
 *
 * @param	string
 * @return	bool
 */
function trataDiaSemana ($dia, $limiteCaracteres=0)
{
	$array = array(
		"Segunda-Feira",
		"Terça-Feira",
		"Quarta-Feira",
		"Quinta-Feira",
		"Sexta-Feira",
		"Sábado",
		"Domingo"
		);
	$dia = $array[$dia - 1];
// Limita quantidade de caracteres conforme parametro recebido
	if ($limiteCaracteres > 0) {
		$dia = substr($dia, 0, $limiteCaracteres);
	}

	return $dia;
}

/**
 * Retorna mês por extenso
 * @package	grimoire/bibliotecas/tempo.php
 * @since	05-07-2015
 *
 * @param	int
 * @param	int
 * @return	string
 */
function trataMes ($numeroMes, $limiteCaracteres=0)
{
	$array = array(
		"Janeiro",
		"Fevereiro",
		"Março",
		"Abril",
		"Maio",
		"Junho",
		"Julho",
		"Agosto",
		"Setembro",
		"Outubro",
		"Novembro",
		"Dezembro"
	);
	$mes = $array[intval($numeroMes)];
	// Limita quantidade de caracteres conforme parametro recebido
	if ($limiteCaracteres > 0) {
		$mes = substr($mes, 0, $limiteCaracteres);
	}

	return $mes;
}

/**
   format::(Y-m-d)
	negativo = $data1 > $data2
	positivo = $data1 < $data2
	zero = $data1 == $data2
	return numerico
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
function diferencaDatas ($data1, $data2)
{
	$hojeExplodido = explode('-', $data1);
	$hojeReordenado = $hojeExplodido[0] ."". $hojeExplodido[1] ."". $hojeExplodido[2];

	$dataXExplodido = explode('-', $data2);
	$dataXReordenado = $dataXExplodido[0] ."". $dataXExplodido[1] ."". $dataXExplodido[2];

	return $hojeReordenado - $dataXReordenado;
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
function intervaloDatas ( $dataInicial, $dataFinal, $dataAlvo="" )
{
	if ( empty($dataAlvo) ) {
		$dataAlvo = hoje();
	}

	if ( $dataAlvo >= $dataInicial && $dataAlvo <= $dataFinal ) {
		return true;
	}

	return false;
}
