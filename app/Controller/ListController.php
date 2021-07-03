<?php
require ROOT.'/app/model/database.class.php';

$db  = new Database();

$condicoes = array(
	// 'login' => $_POST['login']
);
$users = $db->selecionar('usuario', $condicoes);
