<?php
include '../../app/Grimoire/core_inc.php';

$values = array(
	'titulo'		=> $_POST['titulo'],
	'criado_por'	=> $_SESSION['user']['id'],
	'ativo'			=> $_POST['ativo']
);
$id = inserir('hospital', $values);


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

header('Location: ../../lista.php?modulo=hospital');
