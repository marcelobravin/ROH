<?php
include '../../app/Grimoire/core_inc.php';

$condicoes = array(
	'id' => $_POST['id']
);

$campos = array(
	'titulo' => $_POST['titulo'],
	'ativo' => $_POST['ativo']
);

try {
	$rowCount = atualizar('hospital', $campos, $condicoes);

	if (is_numeric($rowCount) && $rowCount > 0) {
		$_SESSION['mensagem'] = "Atualizado o registro número: ". $_POST['id'];
		$_SESSION['mensagemClasse'] = "sucesso";

		registrarOperacao('U', 'hospital', $_POST['id']);

	} else {
		# clicou atualizar sem adicionar nenhuma alteração
		$_SESSION['mensagem'] = "Nenhuma alteração realizada!";
		$_SESSION['mensagemClasse'] = "erro";
	}


} catch (PDOException $e) {
	$_SESSION['mensagemClasse'] = "erro";
	if ( contem("Duplicate entry 'login' for key 'login'", $_POST['id']) ) {
		# tentou atualizar o login para um repetido
		$_SESSION['mensagem'] = "Login já existe!";
		$_SESSION['mensagemClasse'] = "erro";
	}
} finally {
	header('Location: ../../lista.php?modulo=hospital');
}
