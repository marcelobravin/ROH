<?php
require ROOT.'/model/database.class.php';

$db  = new Database();

$condicoes = array(
	// 'login' => $_POST['login']
);
$users = $db->selecionar('usuarios', $condicoes);
