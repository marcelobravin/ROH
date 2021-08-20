<?php
verificarManutencao();

// server should keep session data for AT LEAST 1 hour
ini_set('session.gc_maxlifetime', SESSAO_TTL);

configurarExibicaoErros(PRODUCAO);
# ------------------------------------------------------------------------------ inicio
iniciarSessao();
define( "LOGADO", !empty($_SESSION[USUARIO_SESSAO]) );

if ( LOGADO ) {
	verificarTempoAtividadeSessao();
}

$MODULOS = array('hospital', 'usuario');

# bloqueia usuários não logados nas páginas internas
bloquearAcesso($PAGINAS_EXTERNAS);

# inicialização dos dados da página para serem sobrescritos conforme necessário
$PAGINA = array(
	'titulo'	=> TITULO_SITE,
	'subtitulo'	=> DESCRICAO_SITE,
	'endereco'	=> paginaAtual()
	// 'separador'	=> SEPARADOR_TITULO
);

ob_start();
$page = ob_get_contents();

if ( !PRODUCAO && !isset($_GET['requisicaoAjax']) ) { # não exibe cronometro para não atrapalhar retorno json
	$c1 = new Clock(); # inicia cronometro
	include BASE."app/Grimoire/biblioteca/desenvolvimento/acoes.php";
	// $c1->mark(); # retorna tempo; # quebra favicon por ter uma saida antes do head
	# atribuir a uma variável que é exibida dentro do html
}
