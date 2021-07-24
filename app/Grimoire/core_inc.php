<?php
/**
 * GRIMOIRE
 * @package grimoire
 * @subpackage grimoire/biblioteca
 *
 * Biblioteca de funções procedurais para agilização de tarefas
 * rotineiras de desenvolvimento web, como criação de elementos
 * html, criação de instruções sql, validação de dados, etc.
 *
 * @category Microframework
 * @since quarta-feira, 29 de maio de 2013, 12:11:54
 * @version 06/09/2016 (@see versao.txt)
 * @author Marcelo de Souza Bravin <marcelo.bravin@gmail.com>
 * @author Henrique Rodrigues da Costa <h.rodrigues.ti@gmail.com>
 * @access public
 * @license Open Source - MIT License : {@link: http://www.opensource.org/licenses/mit-license.php}
 * Redistributions of files must retain the above copyright notice.
*/

# Componentes
require("configuracoes.php");					// constantes desse projeto

# ------------------------------------------------------------------------------ FUNÇÕES UNIVERSAIS
require("biblioteca/acesso.php");				// controle de acesso
require("biblioteca/arquivos.php");				// manipulação de arquivos
//require("biblioteca/cores.php");				// geração e conversão de cores
require("biblioteca/email.php");				// construção e envio de emails
require("biblioteca/expressoesRegulares.php");	// repositório de expressões regulares
require("biblioteca/formularios.php");			// geração automatica de formularios do CMS
require("biblioteca/html.php");					// criação de elementos html
require("biblioteca/imagens.php");				// manipulação de imagens
//require("biblioteca/javascript.php");			// criação de javascripts
require("biblioteca/numeros.php");				// funções matemáticas
require("biblioteca/paginacao.php");			// construção de paginação e gerenciamento de parametros get
require("biblioteca/seguranca.php");			// segurança e controle de acesso
require("biblioteca/snippets.php");				// atalhos para criação de elementos html
require("biblioteca/sql.php");					// criação de instruções SQL
require("biblioteca/tempo.php");				// manipulação de tempo e datas
require("biblioteca/templates.php");			// templates para cricao
require("biblioteca/texto.php");				// manipulação de strings
require("biblioteca/validacao.php");			// Validação de valores e padrões de dados
require("biblioteca/vetores.php");				// manipulação de arrays
require("biblioteca/ws.php");					// acesso a sites externos

# ------------------------------------------------------------------------------ FUNÇÕES OPCIONAIS
if ( ORACLE )
	require("biblioteca/persistencia/persistencia-oracle.php");	// conexão com BD e execução de instruções SQL no Oracle
else
	require("biblioteca/persistencia/persistencia-pdo.php");	// conexão com BD e execução de instruções SQL no MySql via PDO

if ( INTERNACIONALIZACAO )
	require("biblioteca/opcionais/internacionalizacao.php");	// funções para tradução e seleção de idiomas

if ( E_COMMERCE )
	require("biblioteca/opcionais/eCommerce.php");				// funções para lojas virtuais

if ( !PRODUCAO ) {
	require("biblioteca/desenvolvimento/debug.php");					// Funções para debugging
	require("biblioteca/desenvolvimento/instalacao.php");				// Funções para criação de tabelas e exportação/importação de registros
}

# ------------------------------------------------------------------------------ exibição de erros
if ( PRODUCAO ) {
	ini_set('display_errors'		, 0);
	ini_set('display_startup_errors', 0);
} else {
	ini_set('display_startup_errors', 1);
	ini_set('display_errors'		, TRUE);
	ini_set('error_reporting'		, E_ALL);
	error_reporting(E_ALL);
	// error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR );
}

require("processosIniciais.php");
