<?php
include '../../config.php';

require '../../model/database.class.php';
require '../../model/security.class.php';

$db = new Database();

# Se usuário não alterou a senha, hasheia ela novamente
$condicoes = array(
	'id' => $_POST['id']
);
$userRegistered = $db->selecionar('usuarios', $condicoes);
$userRegistered = $userRegistered[0];

$sec = new Security();
if ($_POST['senha'] != $userRegistered['senha'])
	$_POST['senha'] = $sec->criptografar($_POST['senha']);


$campos = array(
	'login' => $_POST['login'],
	'senha' => $_POST['senha']
);

$rowCount = $db->atualizar('usuarios', $campos, ['id' => $_POST['id']]);







if (is_numeric($rowCount) && $rowCount > 0) {
	$_SESSION['mensagem'] = "Atualizado o registro número:". $_POST['id'];
	header('Location: ../../list.php');
	exit;
} else {

	# tentou atualizar o login para um repetido
	if ( contem("Duplicate entry 'login' for key 'login'", $_POST['id']) ) {
		echo "Login já existe!";
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
	<a href="../../list.php">voltar</a>
</p>
