<?php
/**
 * Compatibilidade com navegadores antigos
 * @package grimoire/biblioteca/opcionais
*/

/**
 * Cria comentário condicional para IE
 *
 * @param   string: versao do IE
 * @param   bool: operador de versão
 * @return  string
 */
function ie($versao="5.5000", $operador="") {

  if ($operador==true) {
    $operador = "gte";
  } else {
    $operador = "lte";
  }

  $array[] = "<!--[if $operador IE $versao]>";
  $array[] = "<![endif]-->";

  return $array;
}

/**
 * Verifica se o valor se encaixa no padrão
 *
 * @param   string
 * @return  string
 */
function navegadorVelho() {
  return '<!--[if lt IE 7]><div class="alert">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</div><![endif]-->';
}

/**
 * Gera noscript
 *
 * @param   string
 * @return  string
 *
 * @example
    echo noscript("Meu Site");
 */
function noscript($conteudo="<p class='center'>Esse site necessita que o JavaScript esteja ativado para funcionar corretamente.</p>") {
  return gerarElemento("noscript", $conteudo);
}
