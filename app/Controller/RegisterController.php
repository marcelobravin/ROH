<?php
include '../../config.php';

require '../../model/database.class.php';
require '../../model/security.class.php';

$sec	= new Security();
$db		= new Database();

$values = array(
	'login' => $_POST['login'],
	'senha' => $sec->criptografar($_POST['senha'])
);
$id = $db->inserir('usuarios', $values);



if (is_numeric($id) && $id > 0) {
	$_SESSION['mensagem'] = "Inserido registro número:". $id;
	header('Location: ../../list.php');
	exit;
} else {

	if ( contem("Duplicate entry 'login' for key 'login'", $id) ) {
		echo "Login já existe!";
	}
}

/**
 * Verifica se a string contém o trecho solicitado
 * @package grimoire/bibliotecas/texto.php
 * @version 05-07-2015
 * @version 15-06-2021
 *
 * @param	string
 * @param	string
 * @return	bool
 */
function contem($agulha, $palheiro) {
	if ( strpos($palheiro, $agulha) !== false )
		return true;

		return false;
}

?>

<p>
	<a href="../../list.php">voltar</a>
</p>
