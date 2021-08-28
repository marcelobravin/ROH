<?php
include '../../app/Grimoire/core_inc.php';

if ( !login($_POST['login'], $_POST['senha']) ) {
	$resposta = "Credenciais de acesso inválidas";
	montarRespostaPost($resposta, false, $codigo=201); # 201 Created
}

redirecionar();
