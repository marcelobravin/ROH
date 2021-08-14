<?php
function retornarCampos ()
{
	if ( PRODUCAO ) {
		return array(
			'login',
			'telefone',
			'nome',
			'endereco',
			'cpf'
		);
	} else {
		$descricao = descreverTabela('usuario');
		return filtrarArray($descricao, 'char');
	}

}
