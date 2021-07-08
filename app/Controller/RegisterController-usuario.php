<?php
include '../../app/Grimoire/core_inc.php';

$values = array(
	'login'			=> $_POST['login'],
	'senha'			=> criptografar($_POST['senha']),
	'criado_por'	=> $_SESSION['user']['id']
);
$id = inserir('usuario', $values);


if (is_numeric($id) && $id > 0) {
	$_SESSION['mensagem'] = "Inserido registro número: ". $id;
	$_SESSION['mensagemClasse'] = "sucesso";
} else {

	if ( contem("Duplicate entry", $id) ) {
		$_SESSION['mensagem'] = "Login já existe!";

	} else {
		echo('<pre>');
		print_r($id);
		echo('</pre>');
	}

	$_SESSION['mensagemClasse'] = "erro";
}

header('Location: ../../lista.php?modulo=usuario');
