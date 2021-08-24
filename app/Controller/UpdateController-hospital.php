<?php
include '../../app/Grimoire/core_inc.php';

require '../../app/Model/Validacao-hospital.php';

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
	'titulo'				=> $_POST['titulo'],
	'ativo'					=> isset($_POST['ativo']) ? 1 : 0,
	'cnes'					=> $_POST['cnes'],
	'cnpj'					=> removerNaoNumericos($_POST['cnpj']),
	'diretor'				=> $_POST['diretor'],
	'segundo_responsavel'	=> $_POST['segundo_responsavel'],
	'cep'					=> removerNaoNumericos($_POST['cep']),
	'endereco'				=> $_POST['endereco'],
	'bairro'				=> $_POST['bairro'],
	'cidade'				=> $_POST['cidade'],
	'uf'					=> $_POST['uf'],
	'telefone'				=> $_POST['telefone'],
	'email'					=> $_POST['email'],

	'atualizado_por'		=> $_SESSION['user']['id']
);

$resultado = atualizar('hospital', $campos, $condicoes);

# ------------------------------------------------------------------------------ resposta
if ( is_numeric($resultado) ) {
	if ( $resultado > 0 ) {
		registrarOperacao('U', 'hospital', $_POST['id']);

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
