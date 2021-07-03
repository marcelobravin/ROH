<?php
// include '../../config.php';
include '../../app/Grimoire/core_inc.php';


require '../../app/model/database.class.php';

$db = new Database();

$condicoes = array(
	'login' => $_POST['login']
);
$user = $db->selecionar('usuario', $condicoes);


if ( empty($user) ) {
	echo '<p>Dados incorretos.</p>';
} else {
	$user = $user[0];
	$ip = identificarIP();
	$browser = getBrowser();

	bloquearForcaBruta($user['id'], $db);

	if ( password_verify($_POST['senha'], $user['senha']) ) {
		$acesso = registrarAcesso($user['id'], $ip, $browser, 1);
		$stm = $db->getConnection()->prepare($acesso);
		$stm->execute();

		verificarTempoAtividadeSessao();
		unset($user['senha']);
		$_SESSION['user'] = $user;

		# TODO: apagar logs de erro deste usuário

		header("Location: ../../index.php");
		exit;
	} else {
		$falhaAcesso = registrarAcesso($user['id'], $ip, $browser, 0);
		$stm = $db->getConnection()->prepare($falhaAcesso);
		$stm->execute();
		echo '<p>Dados incorretos.</p>';

/*
		echo "<br>";
		// hora atual
		echo date('h:i:s') . "\n";
		// espera dois segundos
		usleep(1000000);
		// de volta!
		echo date('h:i:s') . "\n";
*/
	}
}

echo date('h:i:s') . "\n"; // hora atual
echo "<br>";
usleep(1000000); // espera dois segundos
echo date('h:i:s') . "\n"; // de volta!

?>

<p>
	<a href="../../index.php">voltar</a>
</p>
