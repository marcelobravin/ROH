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
	'ativo'			=> isset($_POST['ativo']) ? 1 : 0,
	'titulo'		=> $_POST['titulo'],
	'criado_por'	=> $_SESSION['user']['id']
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
	$resposta = montarMensagemErro( $id ); # todo verificar
	montarRespostaPost($resposta, false, $codigo=201); # 201 Created

	voltar();
}
