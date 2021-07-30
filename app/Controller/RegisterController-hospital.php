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
if ( is_numeric($id) && $id > 0 ) {
	$_SESSION['mensagem'] = "Inserido registro número: ". $id;
	$_SESSION['mensagemClasse'] = "sucesso";

	registrarOperacao('I', 'hospital', $id);
	redirecionar(PROTOCOLO . ROOT_HTTP."formulario-atualizacao.php?modulo=hospital&codigo={$id}");

# ------------------------------------------------------------------------------ erros
} else {
	$_SESSION['mensagemClasse'] = "erro";
	montarMensagemErro( $id );
	voltar();
}
