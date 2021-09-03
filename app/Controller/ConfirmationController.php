<?php
	include '../../app/Grimoire/core_inc.php';

	if ( !isset($_GET['id']) ) {
		die("Id não definido!");
	}

	$email = enviarEmailConfirmacao($_GET['id']);
	if ( $email['envio'] ) {
		$resposta = "Email enviado para o usuário {$_GET['id']} com sucesso!";
		montarRespostaPost($resposta, true, $codigo=201); # 201 Created
		voltar();
	} else {
		echo "Erro ao enviar email para o usuário: ". $_GET['id'];
		echo '<p><a href="../../lista.php?modulo=usuario">Voltar</a></p>';

		if ( !PRODUCAO ) { /* em ambiente de teste exibir conteúdo do email */
			echo "<hr>";
			echo $email['assunto'];
			echo "<br>";
			echo $email['body'];
			exit;
		}
	}
