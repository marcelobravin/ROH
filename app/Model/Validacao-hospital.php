<?php
function validarFormulario ( $post, $update=false )
{
	# valida preenchimento de campos NOT NULL
	$camposObrigatorios = array(
		'titulo'=> $post['titulo']
	);

	# validar formato contra expressões regulares
	$mapaFormatos = array(
		'titulo'	=> 'letras_espacos_acentos_apostrofe_numeros' # todo aceitar numeros
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
	$erro = $erro[2];

	if ( contem("Duplicate entry", $erro) ) {

		if ( contem("for key 'cnes'", $erro) ) {
			$erro = "Já existe um estabelecimento cadastrado para este CNES.<br>Por Favor, verifique se o valor informado está correto";
		} else if ( contem("for key 'cnpj'", $erro) ) {
			$erro = "Já existe um estabelecimento cadastrado para este CNPJ.<br>Por favor, verifique se o valor informado está correto.";
		}

	} else {
		exibir($erro, true); # Erro deconhecido
	}

	return $erro;
}
