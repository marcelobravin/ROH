<?php
function validarFormulario ( $post, $update=false )
{
	# valida formatos contra expressões regulares
	$mapaFormatos = array(
		'login'		=> 'email',
		'telefone'	=> 'telefone',
		'celular'	=> 'celularSemMascara',
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
	if ( PRODUCAO ) {
		$mapaTamanhos = array(
			'nome'		=> ['minimo'=>5, 'maximo'=>255],
			'endereco'	=> ['minimo'=>5, 'maximo'=>255]
		);
	} else {
		# pega os maximos e caso necessário adiciona os minimos
		include ARQUIVOS_EFEMEROS."/modelos/tamanhos_maximos-usuario.php";
		$mapaTamanhos['nome']['minimo']		= 5;
		$mapaTamanhos['endereco']['minimo']	= 5;
	}

	# limpa campos com máscara
	$post['telefone'] = removerNaoNumericos($post['telefone']);
	$post['celular'] = removerNaoNumericos($post['celular']);

	# em updates id ainda não existe, é gerado no momento do insert
	if ( !$update ) {
		removeIndicePorValor($camposObrigatorios, 'id');
	}

	# valida tudo!
	return validacao($post, $camposObrigatorios, $mapaFormatos, $mapaTamanhos);
}

function montarMensagemErro ( $erro )
{
	$erro = $erro->getMessage();

	if ( contem("Duplicate entry", $erro) ) {  # Erros possíveis

		if ( contem("for key 'cpf'", $erro) ) {
			$erro = "CPF já existe!";
		} else if ( contem("for key 'login'", $erro) ) {
			$erro = "Email já existe!";
		}

	} else {
		exibir($erro, true); # Erro desconhecido
	}

	return $erro;
}
