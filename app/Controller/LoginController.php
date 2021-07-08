<?php
include '../../app/Grimoire/core_inc.php';

if ( login($_POST['login'], $_POST['senha']) ) {
	header("Location: ../../index.php");
} else {
	echo '<p>Dados incorretos.</p>';
}
?>

<p>
	<a href="../../index.php">voltar</a>
</p>
