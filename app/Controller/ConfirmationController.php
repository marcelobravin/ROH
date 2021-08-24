<?php
	include '../../app/Grimoire/core_inc.php';

	if ( enviarEmailConfirmacao() ) {
		$resposta = "Email enviado para o usuário {$_GET['id']} com sucesso!";
		montarRespostaPost($resposta, true, $codigo=201); # 201 Created
		voltar();
	} else {
		# todo corrigir
		echo "Erro ao enviar email para o usuário: ({$user['login']}) ". $_GET['id'];
		echo '<p><a href="../../lista.php?modulo=usuario">Voltar</a></p>';

		if ( !PRODUCAO ) { /* em ambiente de teste exibir conteúdo do email */
			echo "<hr>";
			echo $assunto;
			echo "<br>";
			echo $body;
			exit;
		}
	}
