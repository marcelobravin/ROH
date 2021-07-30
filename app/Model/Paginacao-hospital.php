<?php
function retornarCampos ()
{
	if ( !PRODUCAO ) {
		$descricao = descreverTabela('hospital');
		return filtrarArray($descricao, 'char');
	} else {
		return array(
			'titulo'
		);
	}
}
