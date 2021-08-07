<?php
/**
 * Erros
*/
if ( !isset($_GET['modulo']) ) {
	die("modulo invalido");
}

if ( !isset($_GET['codigo']) ) {
	die("codigo invalido");
}

/**
 * Kocalização do objeto
*/
define('MODULO', $_GET['modulo']);
$condicoes = array(
	'id' => $_GET['codigo']
);
$obj = localizar(MODULO, $condicoes);

if ( empty($obj) ) {
	die("Objeto não encontrado");
}

/**
 * Submodulos
*/
if (PRODUCAO) {
	$PAGINA['submodulo']= 'public/views/forms/'.MODULO.'-atualizacao.php';
} else {
	$PAGINA['submodulo']= '_arquivos_auto_gerados/views/'.MODULO.'-atualizacao.php';
}
