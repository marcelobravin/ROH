<?php
include '../../app/Grimoire/core_inc.php';

#verifica se usuario tem permissão de editar esse registro
# verifica se esse registro é editável


# valida preenchimento de campos NOT NULL
$camposObrigatorios = array(
	'id'	=> $_POST['id'], # para updates id é obrigatorio
	'login'	=> $_POST['login'],
	'cpf'	=> $_POST['cpf']
);

# valida formato dos campos
$post = $_POST;
unset($post['id']);
unset($post['ativo']);
$mapaFormatos = array(
	// 'id'		=> 'id',
	'login'		=> 'email',
	// 'ativo'		=> 'ativo',
	'telefone'	=> 'celular',
	'nome'		=> 'letras_e_espaco',
	'endereco'	=> 'alfanumerico_e_espacos',
	'cpf'		=> 'cpf'
);

validacao($camposObrigatorios, $post, $mapaFormatos);

function validacao ($camposObrigatorios, $post, $mapaFormatos)
{
	# validações específicas
	foreach ($mapaFormatos as $i => $v) {
		if ($v == "cpf") {
			if ( !validarCPF($post[$i]) )
				die("CPF inválido");

			unset($camposObrigatorios[$v]);
			unset($mapaFormatos[$v]);
			unset($post[$v]);
		}
	}

	$camposVazios = validarCamposObrigatorios($camposObrigatorios);
	if ( !empty($camposVazios) ) {
		echo('<pre>');
		echo "Campos obrigatórios que estão vazios: ";
		print_r($camposVazios);
		echo('</pre>');
		die();
	}

	$camposEmFormatoInvalidos = validarFormatos($post, $mapaFormatos);
	if ( !empty($camposEmFormatoInvalidos) ) {
		echo('<pre>');
		echo "Campos que não estão no padrão definido: ";
		print_r($camposEmFormatoInvalidos);
		echo('</pre>');
		die();
	}

	return true;
}


// echo('<pre>');
// print_r($cpfValido);
// echo('</pre>');

// if ($formato[$i] == 'cpf')		$validade = validarCpf($v);


// echo "tudo ok";
// exit;






$condicoes = array(
	'id' => $_POST['id']
);

$campos = array(
	'login' => $_POST['login'], # ---------------------------------------------- não deve alterar

	'ativo'		=> $_POST['ativo'], # 1
    'telefone'	=> $_POST['telefone'], # (11) 95989-0399
    'nome'		=> $_POST['nome'], # Marcelo de Souza Bravin
    'endereco'	=> $_POST['endereco'], # Avenida Francisco Rodrigues Filho
    'cpf'		=> $_POST['cpf'] #
);


try {
	$rowCount = atualizar('usuario', $campos, $condicoes);

	if (is_numeric($rowCount) && $rowCount > 0) {
		$_SESSION['mensagem'] = "Atualizado o registro número: ". $_POST['id'];
		$_SESSION['mensagemClasse'] = "sucesso";

		registrarOperacao('U', 'usuario', $_POST['id']);

	} else {
		# clicou atualizar sem adicionar nenhuma alteração
		$_SESSION['mensagem'] = "Nenhuma alteração realizada!";
		$_SESSION['mensagemClasse'] = "erro";
	}


} catch (PDOException $e) {
	$_SESSION['mensagemClasse'] = "erro";
	if ( contem("Duplicate entry 'login' for key 'login'", $_POST['id']) ) {
		# tentou atualizar o login para um repetido
		$_SESSION['mensagem'] = "Login já existe!";
		$_SESSION['mensagemClasse'] = "erro";
	}
} finally {
	voltar();
}
