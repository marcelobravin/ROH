<?php
include '../../app/Grimoire/core_inc.php';

require '../../app/Model/Validation-user.php';


$formularioValido = xxx ($_POST);


if ( !empty($formularioValido) ) {
	echo('<pre>');
	print_r($formularioValido);
	echo('</pre>');
	exit;
}



// $errosBloqueantes = array();
// foreach ($camposObrigatorios as $i => $v) {
// 	// echo $i;
// 	foreach ($validacao as $i2 => $v2) {

// 		foreach ($v2 as $i3 => $v3) {

// 			if ($i == $v3["campo"])
// 				$errosBloqueantes[] = $i;
// 		}
// 	}

// }


// if ( !empty($errosBloqueantes) ) {
// 	echo('<pre>');
// 	print_r($errosBloqueantes);
// 	echo('</pre>');
// 	exit;
// }











$values = array(
	'login'			=> $_POST['login'],
	'senha'			=> criptografar($_POST['senha']),
	'criado_por'	=> $_SESSION['user']['id']
);
$id = inserir('usuario', $values);


if (is_numeric($id) && $id > 0) {
	$_SESSION['mensagem'] = "Inserido registro número: ". $id;
	$_SESSION['mensagemClasse'] = "sucesso";

	registrarOperacao('I', 'usuario', $id);

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
