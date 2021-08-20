<?php
require 'app/Grimoire/core_inc.php';

if ( LOGADO ) {
	$PAGINA['titulo']		= "Home";
	$PAGINA['subtitulo']	= "Página Inicial";
	$PAGINA['endereco']		= "home.php";

	include "public/views/frames/frameset.php";
} else {
	$PAGINA['subtitulo']	= "Login";
	$PAGINA['endereco']		= "login.php";
	$omitirMenu = true;

	include "public/views/frames/frameset.php";
}


/*
$x= executar("SET FOREIGN_KEY_CHECKS=0");
exibir($x);

ativacaoConstraints(0);

if ( !importarRegistros(ARQUIVOS_EFEMEROS ."/db/dml/registros/_log_operacoes.sql") ) {
	die( 'Erro: importarRegistros()');
}

$x= executar("SET FOREIGN_KEY_CHECKS=0");
exibir($x);
 */

/*
INSERT INTO `elemento` (`id`, `id_categoria`, `titulo`, `ativo`, `criado_em`, `atualizado_em`, `excluido_em`, `criado_por`, `atualizado_por`, `excluido_por`) VALUES ('36', '7', 'Radiologia', '1', '2021-07-06 10:35:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '0', '0')
36

INSERT INTO `hospital` (`id`, `titulo`, `ativo`, `cnes`, `cnpj`, `diretor`, `segundo_responsavel`, `endereco`, `cep`, `telefone`, `email`, `criado_em`, `atualizado_em`, `excluido_em`, `criado_por`, `atualizado_por`, `excluido_por`) VALUES ('1', 'Novo Hospital', '1', '0', '0', '', '', '', '0', '', '', '2021-08-10 14:48:43', '2021-08-13 15:34:46', '', '1', '', '')
*/
