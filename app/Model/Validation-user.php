<?php
function validarFormulario ( $post, $update=false )
{
	# valida preenchimento de campos NOT NULL
	$camposObrigatorios = array(
		// 'nome'		=> '',
		// 'endereco'		=> '',

		'login'	=> $post['login'],
		'cpf'	=> $post['cpf']
	);


	# validar formato contra expressões regulares
	$mapaFormatos = array(
		'login'		=> 'email',
		'telefone'	=> 'celular',
		'nome'		=> 'letras_e_espaco',
		'endereco'	=> 'endereco',
		'cpf'		=> 'cpf'
	);

	# valida tamanho maximo e minimo de characteres
	$mapaTamanhos = array(
		'nome'		=> ['minimo'=>5, 'maximo'=>255],
		'endereco'	=> ['minimo'=>5, 'maximo'=>255]
	);

	if ( $update )
		$camposObrigatorios['id'] = $post['id'];

	# valida tudo!
	return validacao($post, $camposObrigatorios, $mapaFormatos, $mapaTamanhos);
}
