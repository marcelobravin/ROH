<?php
/**
 * Constantes de configuração do projeto
 * @package grimoire
 * @since 26/07/2015
 * @version 15/07/2021 16:05:15
 */

/**
 * Exibição de erros: user friendly ou debug
 *
 * @var string
 */
if ( $_SERVER['SERVER_NAME'] == 'localhost' ) {
	define( 'PRODUCAO', false );
} else {
	define( 'PRODUCAO', true );
}

/**
 * Dados do site
 *
 * @var string
 */
	define( 'TITULO_SITE'		, 'ROH' ); # ----------------------------------- Nome do site a ser exibido em h1 e na aba
	define( 'DESCRICAO_SITE'	, 'Relatório de ocupação Hospitalar' );
	define( 'SEPARADOR_TITULO'	, ' - ' ); # ----------------------------------- símbolo a ser usado para separar o titulo do site do título da página

	define( 'PALAVRAS_CHAVE'	, '' );
	define( 'CEP_ORIGEM'		, '08710-190' ); # ----------------------------------- símbolo a ser usado para separar o titulo do site do título da página

/**
 * Nome de diretório e subdiretórios
 *
 * @var string/bool
 */
	# o nome do diretório é case sensitive
	define( 'PROJECT_NAME'		, 'ROH'); #------------------------------------- nome da pasta que contém o projeto
	if ( PRODUCAO ) {
		define( 'PROJECT_FOLDER'	, 'PROJETOS/'. PROJECT_NAME . '/');
	} else {
		$DIR = explode('htdocs/', $_SERVER['SCRIPT_FILENAME']);
		$DIR = explode(PROJECT_NAME.'/', $DIR[1]);
		$DIR = $DIR[0];
		define( 'PROJECT_FOLDER'	, $DIR . PROJECT_NAME . '/');
	}

/**
 * Estrutura de diretório
 *
 * @var string
 */
	define( 'PROTOCOLO'			, $_SERVER['REQUEST_SCHEME'].'://' );
	define( 'BASE'				, $_SERVER['DOCUMENT_ROOT'] .'/'. PROJECT_FOLDER ); # diretório base file system
	define( 'BASE_HTTP'			, $_SERVER['HTTP_HOST'] .'/'. PROJECT_FOLDER ); # diretório base http
	define( 'ARQUIVOS_EFEMEROS'	, BASE .'_arquivos_auto_gerados' );
	define( 'GRIMOIRE'			, BASE .'app/Grimoire' );
	define( 'ARQUIVOS'			, '' );
	define( 'IMAGENS'			, '' );
	define( 'PAGINA_INICIAL'	, 'index.php' );
	define( 'USUARIO_SESSAO'	, 'user' );


/**
 * Configurações de idioma e localização
 *
 * @var string
 */
	define( 'IDIOMA'		, 'pt-BR' );
	define( 'CARACTERES'	, 'utf-8' );
	define( 'CHARSET'		, 'utf8' );
	define( 'QUEBRA_LINHA'	, "\n\r" );

	header( 'Content-Type: text/html; charset='. CARACTERES );
	setlocale( LC_TIME, 'pt_BR.'. CHARSET );
	date_default_timezone_set( 'America/Sao_Paulo' );

/**
 * Configuração do BD
 *
 * @var string/bool
 */
	$env = parse_ini_file(BASE.'.env'); #--------------------------------------- credenciais de DB
	if ( !$env ) {
		die("Arquivo .env não encontrado Verifique o nome do seu diretório do projeto");
	}
	define( 'HOST'		, $env['HOST'] );
	define( 'DBNAME'	, $env['BD'] );
	define( 'USER'		, $env['USUARIO'] );
	define( 'PASSWORD'	, $env['SENHA'] );

	define( 'DB_CHARSET', 'utf8' ); # ------------------------------------------ Conjunto de caracteres do banco de dados a ser usado na criação das tabelas.
	define( 'DB_COLLATE', 'utf8_general_ci' ); # ------------------------------- Conjunto de caracteres do banco de dados a ser usado na criação das tabelas.

	define( 'PREFIXO_TABELAS', '' );
	define( 'ORACLE'	, false );

/**
 * Segurança
 *
 * @var mixed
 */
	define( 'CODIFICAR_SENHAS'	, true ); # ------------------------------------ aplicar hash em senha
	define( 'CONTROLE_ACESSO'	, false ); # ----------------------------------- se sistema usará permissões para acesso a módulos e operações
	define( 'FORCA_BRUTA'		, 5 ); # --------------------------------------- numero de senhas incorretas para bloquear temporariamente o acesso do usuário
	define( 'TEMPO_BLOQUEIO'	, 1 ); # --------------------------------------- em minutos
	define( 'SESSAO_TTL'		, 1800 ); # ------------------------------------ em segundos

/**
 * Hotspots específicos desse projeto
 *
 * @var mixed
 */
	define( 'PAGINACAO_RPP'			, 10 ); # ---------------------------------- resultados por página
	define( 'PAGINACAO_PAE'			, 3 ); # ----------------------------------- número de páginas a exibir
	define( 'INDEXAR'				, false );
	define( 'NAVEGADOR_VELHO'		, false ); # ------------------------------- compatibilidade com navegadores 'difíceis'
	define( 'INTERNACIONALIZACAO'	, false ); # ------------------------------- esse projeto será disponível em múltiplos idiomas?
	define( 'E_COMMERCE'			, false ); # ------------------------------- esse projeto tera funcoes envolvendo frete, prazos e preços?
	define( 'MODULAR'				, true ); # -------------------------------- esse projeto utiliza segmentação dinâmica de objetos em módulos?
	define( 'EXCLUSAO_LOGICA'		, true ); # -------------------------------- esse projeto tera o campo 'excluido_por' e 'excluido_em' para gerenciar os registros de BD
	define( 'MANUTENCAO'			, false ); # ------------------------------- exibe uma mensagem em vez do sitemad

# ------------------------------------------------------------------------------ configs de smtp
	#definir envio de email em ambtst
	// ini_set('SMTP'			, $env['SMTP']			');
	// ini_set('SMTP_PORT'		, $env['SMTP_PORT']		');
	// ini_set('AUTH_USERNAME'	, $env['AUTH_USERNAME']	');
	// ini_set('AUTH_PASSWORD'	, $env['AUTH_PASSWORD']	');

# ------------------------------------------------------------------------------ paginas acessiveis apenas  a usuarios logados
$PAGINAS_EXTERNAS = [ # blacklist
	"index.php",
	"LoginController.php",
	"PasswordResetController.php",
	"PasswordUpdateController.php"
];
