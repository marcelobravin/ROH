<?php
function validarFormulario ( $post, $update=false )
{
	# valida preenchimento de campos NOT NULL
	$camposObrigatorios = array(
		'cpf'	=> $post['cpf']
	);

	# validar formato contra expressões regulares
	$mapaFormatos = array(
		'login'		=> 'email',
		'telefone'	=> 'celular',
		'nome'		=> 'letras_espacos_acentos_apostrofe',
		'endereco'	=> 'endereco',
		'cpf'		=> 'cpf'
	);

	# valida tamanho maximo e minimo de characteres
	$mapaTamanhos = array(
		'nome'		=> ['minimo'=>5, 'maximo'=>255],
		'endereco'	=> ['minimo'=>5, 'maximo'=>255]
	);

	if ( $update ) {
		$camposObrigatorios['id'] = $post['id'];
	} else {
		$camposObrigatorios['login'] = $post['login'];
	}

	# valida tudo!
	return validacao($post, $camposObrigatorios, $mapaFormatos, $mapaTamanhos);
}

function montarMensagemErro ( $erro )
{
	$erro = $erro->getMessage();

	if ( contem("Duplicate entry", $erro) ) {

		if ( contem("for key 'cpf'", $erro) ) {
			$erro = "CPF já existe!";
		} else if ( contem("for key 'login'", $erro) ) {
			$erro = "Email já existe!";
		}

	} else {
		exibir($erro, true); # Erro deconhecido
	}

	return $erro;
}
