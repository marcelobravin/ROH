<?php
	include '../../app/Grimoire/core_inc.php';

	$ip = identificarIP();
	$browser = identificarNavegador();

	$acesso = registroDeAcesso($ip, $browser, -1);
	executar($acesso);

	logOut();
