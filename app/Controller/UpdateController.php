<?php
include '../../config.php';

require '../../model/database.class.php';

$db = new Database();

# Se usuário não alterou a senha, hasheia ela novamente
$condicoes = array(
	'id' => $_POST['id']
);


$campos = array(
	'login' => $_POST['login']
	// 'senha' => $_POST['senha']
);
$rowCount = $db->atualizar('usuarios', $campos, ['id' => $_POST['id']]);


if (is_numeric($rowCount) && $rowCount > 0) {
	$_SESSION['mensagem'] = "Atualizado o registro número:". $_POST['id'];

	$db->registrarLog('U', 'usuarios', $_POST['id']);
	header('Location: ../../lista.php?modulo=usuario');
	exit;
} else {

	# tentou atualizar o login para um repetido
	if ( contem("Duplicate entry 'login' for key 'login'", $_POST['id']) ) {
		echo "Login já existe!";
	} else {
		echo "Nenhuma alteração realizada!";
	}
}

/**
 * Verifica se a string contém o trecho solicitado
 * @package grimoire/bibliotecas/texto.php
 * @version 05-07-2015
 *
 * @param	string
 * @param	string
 * @return	bool
 */
function contem($agulha, $palheiro) {
	if (strpos($palheiro, $agulha) !== false)
		return true;
}
?>

<p>
	<a href="../../lista.php?modulo=usuario">voltar</a>
</p>
