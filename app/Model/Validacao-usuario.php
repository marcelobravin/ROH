<?php
function validarFormulario ( $post, $update=false )
{
	# validar formato contra expressões regulares
	$mapaFormatos = array(
		'login'		=> 'email',
		'telefone'	=> 'telefone',
		'celular'	=> 'celular',
		'nome'		=> 'letras_espacos_acentos_apostrofe',
		'endereco'	=> 'endereco',
		'cpf'		=> 'cpf'
	);

	# valida preenchimento de campos NOT NULL
	if ( PRODUCAO ) {
		$camposObrigatorios = array(
			'id',
			'login',
			'senha',
			'email_confirmado',
			'celular',
			'cargo',
			'cpf',
			'criado_em',
			'criado_por',
		);
	} else {
		include ARQUIVOS_EFEMEROS."/modelos/campos_obrigatorios-usuario.php";
	}

	# valida tamanho maximo e minimo de characteres
	/* pega os maximos e caso necessário adiciona os minimos */
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
