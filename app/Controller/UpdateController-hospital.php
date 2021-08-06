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
	'ativo'		=> isset($_POST['ativo']) ? 1 : 0,
	'titulo'	=> $_POST['titulo']
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
		montarRespostaPost($resposta, "", $codigo=201); # 201 Created
	}

} else { # --------------------------------------------------------------------- erros
	$resposta = montarMensagemErro( $resultado );
	montarRespostaPost($resposta, false, $codigo=201); # 201 Created
}

voltar();
