<?php
/**
 * Construção de paginação e gerenciamento de parametros
 * @package grimoire/biblioteca
*/

/**
 * Verifica se um site está no ar
 * @package grimoire/bibliotecas/ws.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	bool
 */
# depende de CURL habilitado
function curl_info ( $url )
{
	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL			, $url );
	curl_setopt( $ch, CURLOPT_HEADER		, 1);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 ); // return the transfer as a string
	curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 1 );
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
	curl_setopt( $ch, CURLOPT_NOBODY		, true); // make sure you only check the header

	curl_exec( $ch );
	return curl_getinfo($ch, CURLINFO_HTTP_CODE);
}

/**
 * Verifica se um site está no ar
 * @package grimoire/bibliotecas/ws.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	bool
 */
function testarSite ( $url )
{
	$headers = @get_headers($url);
	$cod = substr($headers[0], 9, 3);

	if ($cod>=200 && $cod<400) {
		return true;
	}
	#################################
		#mto lento...
		// $http_code = curl_info( $url );
		// // if( $info['http_code'] >= 200 && $info['http_code'] < 300 ) {
		// if( $http_code >= 200 && $http_code < 300 ) {

		// // if( $info['http_code']==200 ) {
		//	 return true;
		// }

		// return false;
	#################################
}

/**
 * Retorna o endereço associado ao CEP solicitado
 * @package grimoire/bibliotecas/ws.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	array
 */
/*
 *	Função de busca de Endereço pelo CEP
 *	-	 Desenvolvido Felipe Olivaes para ajaxbox.com.br
 *	-	 Utilizando WebService de CEP da republicavirtual.com.br
 */
function busca_cep ( $cep )
{
	$resultado = @file_get_contents('http://republicavirtual.com.br/web_cep.php?cep='.urlencode($cep).'&formato=query_string');
	if(!$resultado){
		$resultado = "&resultado=0&resultado_txt=erro+ao+buscar+cep";
	}
	parse_str($resultado, $retorno);
	return $retorno;
}
