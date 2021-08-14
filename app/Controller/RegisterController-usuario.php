<?php
include '../../app/Grimoire/core_inc.php';

require '../../app/Model/Validacao-usuario.php';

# ------------------------------------------------------------------------------ validacao
bloquearRequisicoesInvalidas($_POST, "formulario-cadastro.php?modulo=usuario");

# ------------------------------------------------------------------------------ validacao
$errosFormulario = validarFormulario($_POST);
if ( !empty($errosFormulario) ) {
	montaRespostaValidacao($errosFormulario);
	voltar();
}

# ------------------------------------------------------------------------------ operacao
$values = array(
	'login'			=> $_POST['login'],
	'senha'			=> criptografar($_POST['cpf']),
	'ativo'			=> isset($_POST['ativo']) ? 1 : 0,
	'telefone'		=> removerNaoNumericos($_POST['telefone']),
	'celular'		=> removerNaoNumericos($_POST['celular']),
	'cargo'			=> isset($_POST['cargo']) ? $_POST['cargo'] : 0,
	'nome'			=> $_POST['nome'],
	'endereco'		=> $_POST['endereco'],
	'cpf'			=> $_POST['cpf'],

	'criado_por'	=> $_SESSION['user']['id']
);

$id = inserir('usuario', $values);

# ------------------------------------------------------------------------------ resposta
if ( positivo($id) ) {
	registrarOperacao('I', 'usuario', $id);

	$resposta = "Inserido registro número: ". $id;
	montarRespostaPost($resposta, true, $codigo=201); # 201 Created

	redirecionar(PROTOCOLO . BASE_HTTP."formulario-atualizacao.php?modulo=usuario&codigo={$id}");

	# ------------------------------------------------------------------------------ erros
} else {
	$resposta = montarMensagemErro( $id );
	montarRespostaPost($resposta, false, $codigo=201); # 201 Created

	voltar();
}
