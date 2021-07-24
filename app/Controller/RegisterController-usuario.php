<?php
include '../../app/Grimoire/core_inc.php';

require '../../app/Model/Validation-user.php';

# ------------------------------------------------------------------------------ validacao
$errosFormulario = validarFormulario($_POST);
if ( !empty($errosFormulario) ) {
	montaRespostaValidacao($errosFormulario);
	voltar();
}

# ------------------------------------------------------------------------------ operacao
$values = array(
	'ativo'			=> isset($_POST['ativo']) ? 1 : 0,
	'login'			=> $_POST['login'],
	'senha'			=> criptografar($_POST['cpf']),
	'cpf'			=> $_POST['cpf'],
	'criado_por'	=> $_SESSION['user']['id']
);
$id = inserir('usuario', $values);

# ------------------------------------------------------------------------------ resposta
if ( is_numeric($id) && $id > 0 ) {
	$_SESSION['mensagem'] = "Inserido registro número: ". $id;
	$_SESSION['mensagemClasse'] = "sucesso";

	registrarOperacao('I', 'usuario', $id);
	redirecionar(PROTOCOLO . ROOT_HTTP."formulario-atualizacao.php?modulo=usuario&codigo={$id}");

# ------------------------------------------------------------------------------ erros
} else {
	$_SESSION['mensagemClasse'] = "erro";
	montarMensagemErro( $id );
	voltar();
}
