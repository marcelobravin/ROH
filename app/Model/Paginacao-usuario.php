<?php
function retornarCampos ()
{
	if ( !PRODUCAO ) {
		$descricao = descreverTabela('usuario');
		return filtrarArray($descricao, 'char');
	} else {
		return array(
			'login',
			'telefone',
			'nome',
			'endereco',
			'cpf'
		);
	}

}
