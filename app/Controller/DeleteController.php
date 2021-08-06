<?php
include '../../app/Grimoire/core_inc.php';


# verifica se modulo existe
$whiteList = array( #colocar em configs?
	'usuario',
	'hospital'
);

if ( !in_array($_GET['modulo'], $whiteList) ) {
	$_SESSION['mensagem'] = "Módulo inválido";
	$_SESSION['mensagemClasse'] = "erro";
	voltar();
}





# verifica dependências do objeto a ser excluído
if ( temDependencias($_GET['modulo'], $_GET['id']) ) { # ----------------------- exclusão lógica

	$exclusaoLogica = exclusaoLogica($_GET['modulo'], $_GET['id']);

	if ( $exclusaoLogica == 1 ) {
		registrarOperacao('d', $_GET['modulo'], $_GET['id']);

		$resposta = "Registro de {$_GET['modulo']} número {$_GET['id']} excluído com sucesso!";
		montarRespostaPost($resposta, true, $codigo=201); # 201 Created
	} else {
		$resposta = "Erro ao excluir o registro do módulo {$_GET['modulo']} número: ". $_GET['id'];
		montarRespostaPost($resposta, false, $codigo=201); # 201 Created
	}

} else { # --------------------------------------------------------------------- exclusão permanente

	$exclusao = excluir($_GET['modulo'], ['id'=>$_GET['id']] );

	if ( $exclusao == 1 ) {
		registrarOperacao('D', $_GET['modulo'], $_GET['id']);

		$resposta = "Registro de {$_GET['modulo']} número {$_GET['id']} apagado com sucesso!";
		montarRespostaPost($resposta, true, $codigo=201); # 201 Created
	} else {
		$resposta = "Erro ao apagar o registro do módulo {$_GET['modulo']} número: ". $_GET['id'];
		montarRespostaPost($resposta, false, $codigo=201); # 201 Created
	}

}

voltar();
