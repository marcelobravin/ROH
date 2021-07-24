<?php
/**
 * Internacionalização de termos
 * @package grimoire/opcionais
*/

/**
 * Exibe termo da página atual conforme idioma selecionado
 *
 * @todo   transformar em arquivos em JSON
 * @param  string
 * @return bool
 *
 * @uses   $paginaAtual.php
 * @uses   $_SESSION['idiomaSelecionado']
 * @uses   IDIOMA
 * @example
    i('nome');
 */
function i ($termoSolicitado)
{
  GLOBAL $termos;
  empty($_SESSION['idiomaSelecionado'])
    ? $idiomaSelecionado = IDIOMA // pega do navegador ou SO e insere na sessão
    : $idiomaSelecionado = $_SESSION['idiomaSelecionado'];

  /* if (!file_exists($PAGINA.php)) cria */
  $pagina_atual = limparNomeArquivo(__FILE__);

  include_once "internacionalizacao/". $pagina_atual .".php";
  echo $termos[$termoSolicitado][$idiomaSelecionado];
  // echo "termos[$termoSolicitado][$idiomaSelecionado]";
  // exibir($termos);
  // echo $termoSolicitado;
  // echo $idiomaSelecionado;;
}

/**
 * Identifica o idioma do usuário
 * @package grimoire/bibliotecas/acesso.php
 * @version 05-07-2015
 *
 * @uses		$_SERVER
 */
function identificarIdioma ()
{
	foreach (explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']) as $lang) {
		$pattern = '/^(?P<primarytag>[a-zA-Z]{2,8})'.
		'(?:-(?P<subtag>[a-zA-Z]{2,8}))?(?:(?:;q=)'.
		'(?P<quantifier>\d\.\d))?$/';

		$splits = array();

		printf("Lang:,,%s''\n", $lang);
		if (preg_match($pattern, $lang, $splits)) {
			print_r($splits);
		} else {
			echo "\nno match\n";
		}
	}
}

/*
erros possiveis
    encontrar arquivo
    converter para json
*/
function getTermsMap ($jsonFilePath)
{
    $file = file_get_contents($jsonFilePath);
    if ( !$file ) {
	return "Erro ao localizar conteúdo";
    }

    $json = json_decode($file, true);
    if ( $json ) {
	return $json;
    }

    return "Erro ao converter conteúdo";
}

function getFoodList ($language=null)
{
    if ($language==null) {
	$language = $_SESSION['selectedLanguage'];
    }

    $terms = getTermsMap('assets/lists/foods.json');
    return $terms[$language];
}

function defineDefaultLanguage ()
{

	// Conserves session language
	if ( array_key_exists('selectedLanguage', $_SESSION) ) {

		// priorize parameter language
		if ( !empty($_GET['idioma']) ) {
		$_SESSION['selectedLanguage'] = $_GET['idioma'];
		}

	} else {
		$_SESSION['selectedLanguage'] = 'en-US';
	}

	// Default in case of null
	if ( empty($_SESSION['selectedLanguage']) ) {
		$_SESSION['selectedLanguage'] = 'en-US';
	}

	$idioma = '';
	switch ( $_SESSION['selectedLanguage']) {
		case 'AR':    $idioma = 'arabe';
		break;
		case 'DE':    $idioma = 'alemao';
		break;
		case 'en-US': $idioma = 'ingles';
		break;
		case 'ES':    $idioma = 'espanhol';
		break;
		case 'FR':    $idioma = 'frances';
		break;
		case 'JP':    $idioma = 'japones';
		break;
		case 'pt-BR': $idioma = 'portugues';
		break;
		case 'RU':    $idioma = 'russo';
		break;
	}
}

/**
 * Retorna a internacionalizacao solicitada de um termo
 * @package grimoire/bibliotecas/opcionais.php
 * @since   05-07-2015
 * @version 27/04/2020 18:46:46
 *
 * @param   string
 * @param   string/null
 * @return  string
 *
 * @uses    terms.json
	erros possiveis:
	erros recebidos de getTermsMap
	termos inválido
	# echo translate('espacoParaIniciar')
 */
function translate ($term,/* $addQuotes=true, */$language=null, $map ='assets/lists/terms.json')
{
    if ( $language == null )
		$language = $_SESSION['selectedLanguage'];

    $terms = getTermsMap($map);

    if ( !empty($terms[$term][$language]) ) {
		$text = $terms[$term][$language];
    } else {
		$text = "[termo não encontrado]";
    }

    // if ($addQuotes) {
    //     $text = "'{$text}'";
    // }
    return $text;
}

function sanitizeText( $string )
{
    $string = str_replace('\\n', ' ', $string);
    $string = str_replace("\\'", "'", $string);
    return $string;
}


/**
 * Retorna a variação solicitada de um termo
 * @package grimoire/bibliotecas/opcionais.php
 * @since 05-07-2015
 * @version 10/09/2016 01:00:17
 *
 * @param   string
 * @param   string
 * @return  string
 *
 * @uses    TERMOS
 *
 * @todo    separar arquivo de termos
 */
function termo($termo, $variacao) {

	switch ($termo) {

		case 'pronome_tratamento':
		switch ($variacao) {
			case 'm': return "Sr.";
			case 'f': return "Sra.";
		}

	}
}
