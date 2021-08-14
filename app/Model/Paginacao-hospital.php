<?php
function retornarCampos ()
{
	if ( PRODUCAO ) {
		return array(
			'titulo'
		);
	} else {
		$descricao = descreverTabela('hospital');
		return filtrarArray($descricao, 'char');
	}
}
