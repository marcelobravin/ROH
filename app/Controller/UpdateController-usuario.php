<?php
include '../../app/Grimoire/core_inc.php';

require '../../app/Model/Validation-user.php';

#verifica se usuario tem permissão de editar esse registro
# verifica se esse registro é editável
// $_POST['login']='';

$errosFormulario = validarFormulario($_POST);

if ( !empty($errosFormulario) ) {
	montaMensagemValidacao($errosFormulario);
	voltar();
}

$condicoes = array(
	'id' => $_POST['id']
);

$campos = array(
	'login' => $_POST['login'], # ---------------------------------------------- não deve alterar

	'ativo'		=> $_POST['ativo'], # 1
	'telefone'	=> $_POST['telefone'], # (11) 95989-0399
	'nome'		=> $_POST['nome'], # Marcelo de Souza Bravin
	'endereco'	=> $_POST['endereco'], # Avenida Francisco Rodrigues Filho
	'cpf'		=> $_POST['cpf'] #
);

try {
	$rowCount = atualizar('usuario', $campos, $condicoes);

	if (is_numeric($rowCount) && $rowCount > 0) {
		$_SESSION['mensagem'] = "Atualizado o registro número: ". $_POST['id'];
		$_SESSION['mensagemClasse'] = "sucesso";

		registrarOperacao('U', 'usuario', $_POST['id']);

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
	voltar();
}
