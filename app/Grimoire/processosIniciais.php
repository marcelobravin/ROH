<?php
// limitador();
session_start();
define( "LOGADO", !empty($_SESSION['user']) ); #logado($indice='usuario');

if ( MANUTENCAO )
	die("Página em manutenção! Volte novamente mais tarde");


if ( LOGADO )
	condenarSessao(SESSAO_TTL);


$MODULOS = array('hospital', 'usuario');

# ------------------------------------------------------------------------------ actions
if ( !PRODUCAO ) {

	/* $c1 = new Clock(); */ // inicia cronometro

	include "app\Grimoire\biblioteca\desenvolvimento\acoes.php";
	/* $c1->mark(); */ // retorna tempo
}


# bloqueia usuários não logados nas páginas internas
$paginasExternas = [ # blacklist
	"index.php",
	"LoginController.php",
	"PasswordResetController.php",
	"PasswordUpdateController.php"
];

bloquearAcesso($paginasExternas);

# inicialização dos dados da página para serem sobrescritos conforme necessário
$PAGINA = array(
	'titulo'	=> TITULO_SITE,
	'subtitulo'	=> DESCRICAO_SITE,
	'endereco'	=> paginaAtual()
	// 'separador'	=> SEPARADOR_TITULO
);


/* ob_start(); */
// $page = ob_get_contents();
