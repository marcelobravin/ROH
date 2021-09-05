<?php

use Svg\Tag\Line;

include '../../app/Grimoire/core_inc.php';

require '../../app/Model/Validacao-usuario.php';

# ------------------------------------------------------------------------------ validacao
bloquearRequisicoesInvalidas($_POST, "formulario-cadastro.php?modulo=usuario");
# ------------------------------------------------------------------------------ validacao
$errosFormulario = validarFormulario($_POST, false);
if ( !empty($errosFormulario) ) {
	montaRespostaValidacao($errosFormulario);
	// voltar();
	voltarJS();
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

	'criado_por'	=> $_SESSION[USUARIO_SESSAO]['id']
);
$id = inserir('usuario', $values);

# ------------------------------------------------------------------------------ sucesso
if ( positivo($id) ) {
	enviarEmailConfirmacao($id);

	registrarOperacao('I', 'usuario', $id);

	$resposta = "Inserido registro número: ". $id;
	montarRespostaPost($resposta, true, $codigo=201); # 201 Created

	redirecionar("formulario-atualizacao.php?modulo=usuario&codigo={$id}");
}

# ------------------------------------------------------------------------------ erros
$resposta = montarMensagemErro( $id );
montarRespostaPost($resposta, false, $codigo=201); # 201 Created

voltarJS();
