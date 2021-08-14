<?php
include '../../app/Grimoire/core_inc.php';

require '../../app/Model/Validacao-usuario.php';

# ------------------------------------------------------------------------------ validacao
$errosFormulario = validarFormulario($_POST, true); # definições vem do modelo
if ( !empty($errosFormulario) ) {
	montaRespostaValidacao($errosFormulario);
	voltar();
}

# ------------------------------------------------------------------------------ operacao
$condicoes = array(
	'id' => $_POST['id']
);

$campos = array(
	// 'login'			=> $_POST['email'],
	// 'senha'			=> criptografar($_POST['cpf']),
	'ativo'			=> isset($_POST['ativo']) ? 1 : 0,
	'telefone'		=> removerNaoNumericos($_POST['telefone']),
	'celular'		=> removerNaoNumericos($_POST['celular']),
	'cargo'			=> $_POST['cargo'],
	'nome'			=> $_POST['nome'],
	'endereco'		=> $_POST['endereco'],
	'cpf'			=> $_POST['cpf'],

	'atualizado_por'=> $_SESSION['user']['id']
);

$resultado = atualizar('usuario', $campos, $condicoes);

# ------------------------------------------------------------------------------ resposta
if ( is_numeric($resultado) ) {
	if ( $resultado > 0 ) {
		registrarOperacao('U', 'usuario', $_POST['id']);

		$resposta = "Atualizado o registro número: ". $_POST['id'];
		montarRespostaPost($resposta, true, $codigo=201); # 201 Created
	} else if ( $resultado == 0 ) {
		# clicou atualizar sem adicionar nenhuma alteração
		$resposta = "Nenhuma alteração realizada!";
		montarRespostaPost($resposta, "info", $codigo=201); # 201 Created
	}

} else { # --------------------------------------------------------------------- erros
	$resposta = montarMensagemErro( $resultado );
	montarRespostaPost($resposta, false, $codigo=201); # 201 Created
}

voltar();
