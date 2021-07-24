<?php
include '../../app/Grimoire/core_inc.php';

require '../../app/Model/Validation-hospital.php';

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
		$_SESSION['mensagem']		= "Atualizado o registro número: ". $_POST['id'];
		$_SESSION['mensagemClasse']	= "sucesso";
		registrarOperacao('U', 'hospital', $_POST['id']);
	} else if ( $resultado == 0 ) {
		# clicou atualizar sem adicionar nenhuma alteração
		$_SESSION['mensagem']		= "Nenhuma alteração realizada!";
		$_SESSION['mensagemClasse']	= "erro";
	}

} else { # --------------------------------------------------------------------- erros
	$_SESSION['mensagemClasse'] = "erro";
	montarMensagemErro( $resultado );
}

voltar();
