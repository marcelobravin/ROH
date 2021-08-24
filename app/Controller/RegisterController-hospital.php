<?php
include '../../app/Grimoire/core_inc.php';

require '../../app/Model/Validacao-hospital.php';

# ------------------------------------------------------------------------------ validacao
$errosFormulario = validarFormulario($_POST);
if ( !empty($errosFormulario) ) {
	montaRespostaValidacao($errosFormulario);
	voltar();
}

# ------------------------------------------------------------------------------ operacao
$values = array(
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
	'email	'				=> $_POST['email'],

	'criado_por'			=> $_SESSION['user']['id']
);
$id = inserir('hospital', $values);

# ------------------------------------------------------------------------------ resposta
if ( positivo($id) ) {
	registrarOperacao('I', 'hospital', $id);

	$resposta = "Inserido registro número: ". $id;
	montarRespostaPost($resposta, true, $codigo=201); # 201 Created

	redirecionar("formulario-atualizacao.php?modulo=hospital&codigo={$id}");

# ------------------------------------------------------------------------------ erros
} else {
	$resposta = montarMensagemErro( $id );
	montarRespostaPost($resposta, false, $codigo=201); # 201 Created

	voltar();
}
