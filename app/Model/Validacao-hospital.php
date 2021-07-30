<?php
function validarFormulario ( $post, $update=false )
{
	# valida preenchimento de campos NOT NULL
	$camposObrigatorios = array(
		'titulo'=> $post['titulo']
	);

	# validar formato contra expressões regulares
	$mapaFormatos = array(
		'titulo'	=> 'letras_espacos_acentos_apostrofe'
	);

	# valida tamanho maximo e minimo de characteres
	$mapaTamanhos = array(
		'titulo'	=> ['minimo'=>5, 'maximo'=>255]
	);

	if ( $update ) {
		$camposObrigatorios['id'] = $post['id'];
	}

	# valida tudo!
	return validacao($post, $camposObrigatorios, $mapaFormatos, $mapaTamanhos);
}

function montarMensagemErro ( $erro )
{
	$erro = $erro->getMessage();

	# tentou atualizar o login para um repetido
	if ( contem("Duplicate entry", $erro) ) {
		die("erro"); ###########################################################
	} else {
		exibir($erro);
	}
}
