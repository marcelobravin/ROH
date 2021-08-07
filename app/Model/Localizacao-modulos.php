<?php
if ( !isset($_GET['modulo']) ) {
	die("modulo invalido");
}

if ( !isset($_GET['codigo']) ) {
	die("codigo invalido");
}


define('MODULO', $_GET['modulo']);
$condicoes = array(
	'id' => $_GET['codigo']
);
$obj = localizar(MODULO, $condicoes);

if ( empty($obj) ) {
	die("Objeto não encontrado");
}
