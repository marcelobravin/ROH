<?php
include 'config.php';

# remover antes de colocar em produção !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
#require ROOT.'app/model/database.class.php'; # linux
require 'app/model/database.class.php';


$env = parse_ini_file(ROOT.".env");


# pegar dinamicamente
#define( "DIRETORIO", "/opt/lampp/htdocs/roh/_arquivos_auto_gerados" ); # linux
define( "DIRETORIO", ROOT."_arquivos_auto_gerados" );



if ( inicializarSistema() )
	echo "Importação de BD realizada com sucesso!";
else
	echo "Erro ao importar BD";


################################################################################
/**
 * Prepara o ambiente para execução do projeto
 * @package grimoire/bibliotecas/acesso.php
 * @since 05-07-2015
 * @version 24-06-2021
 *
 * @uses	persistencia.php->criarBanco()
 * @uses	persistencia.php->gerarTabelas()
 * @uses	persistencia.php->popularTabelas()
 * @uses	persistencia.php->gerarHtaccess()
 * @uses	acesso.php->redirecionar()
 *
 * @todo
 * colocar parametro $producao que trunca tabelas e realiza inserts básicos
 */
function inicializarSistema ()
{
	// if ( !criarBanco() )
	criarBanco();
		// throw new Exception( 'Erro: criarBanco()');

	if ( !gerarTabelas(DIRETORIO ."/modelos/*.php") )
		throw new Exception( 'Erro: gerarTabelas()');


	if ( !popularTabelas(DIRETORIO ."/modelos/*.sql") )
		throw new Exception( 'Erro: popularTabelas()');


	return true;
	// if (false/* GERAR_HTACCESS */)
		// gerarHtaccess();

}

/**
 * Cria um BD com o nome definido nas configurações
 * @package grimoire/bibliotecas/persistencia.php
 * @since 05-07-2015
 * @version 24-06-2021
 *
 * @param   string
 *
 * @uses	configuracoes.php->DBNAME
 * @uses	configuracoes.php->DB_CHARSET
 * @uses	configuracoes.php->DB_COLLATE
 * @uses	persistencia.php->conectar
 * @example
	criarBanco();
 */
function criarBanco ()
{
	$sql = 'CREATE DATABASE IF NOT EXISTS '. DBNAME .' DEFAULT CHARACTER SET '. DB_CHARSET .' COLLATE '. DB_COLLATE .';';

	try {
		$dbh = new PDO("mysql:host=".HOST, USER, PASSWORD);
		return $dbh->exec($sql);
	} catch (PDOException $e) {
		die("DB ERROR: " . $e->getMessage());
	}
}

/**
 * Cria tabelas no BD conforme arquivos no diretório modelos
 * @package grimoire/bibliotecas/arquivos.php
 * @since 05-07-2015
 * @version 25-06-2021
 *
 * @uses	GRIMOIRE."modelos/"
 * @example
	gerarTabelas();
 */
function gerarTabelas ($diretorio)
{
	$modelos = glob($diretorio);

	foreach ($modelos as $modelo) {
		include($modelo);
	}

	return true;
}

/**
 * Realiza inserções nas tabelas
 * @package grimoire/bibliotecas/acesso.php
 * @since 05-07-2015
 * @version 24-06-2021
 *
 * @uses	GRIMOIRE."modelos/"
 * @uses	persistencia.php->executar()
 */
function popularTabelas ($diretorio)
{
	$modelos = glob($diretorio);

	foreach ($modelos as $modelo) {

		$sqls = file_get_contents($modelo);
		$sqls = explode(";\n", $sqls);

		foreach ($sqls as $key => $sql) {

			if ( !empty($sql) ) {
				try {
					$db = new Database(); ###################################### transaction
					$db->executarStmt($sql, array(), 'S'); # SSSSSSSSSSSSSSSSSSSSSSSSSSS
				} catch (Exception $e) {
					echo('<pre>');
					print_r($e->getMessage());
					echo('</pre>');
				}
			}
		}
	}

	return true;
}

/**
 * Redireciona para página solicitada via php (se possível) ou javascript
 * @package grimoire/bibliotecas/acesso.php
 * @since 05-07-2015
 * @version 24-06-2021
 *
 * @param   bool/null/string
 * @param   bool
 *
 * @uses	$_SERVER
 */
function redirecionar ($destino=false, $descartarParametros=false)
{
	if ( $destino==false ) { // Define como destino a página anterior
		$url = $_SERVER['HTTP_REFERER'];
	} elseif ( $destino==null ) { // Define como destino a página atual
		if ( $descartarParametros ) {
			$url = explode("?", $_SERVER['PHP_SELF']);
			$url = $url[0];
		} else {
			$url = $_SERVER['PHP_SELF'];
		}
	} else {
		$url = $destino; // Define como destino a página solicitada
	}

	// Redireciona para a página solicitada
	if ( !headers_sent() ) {
		header('Location: ' . $url);
	} else {
		echo '<script type="text/javascript">window.location=\'' . $url . '\';</script>';
		echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0; URL='". $url ."'\">";
	}
	exit;
}

/**
 * Retorna o nome de uma página sem a extensão
 *
 * @package grimoire/bibliotecas/arquivos.php
 * @version 05-07-2015
 *
 * @param   string
 * @return  string
 * @todo	limparNomePagina
 */
# function limparNomeArquivo ($arquivo, $separador="/") # linux
function limparNomeArquivo ($arquivo, $separador="\\") # windows
{
	$arquivo = explode($separador, $arquivo);
	$arquivo = end($arquivo);
	$arquivo = str_replace(".php", "", $arquivo);
	return $arquivo;
}

/**
 * Monta o sql de criação de uma tabela
 * @package grimoire/bibliotecas/sql.php
 * @version 05-07-2015
 *
 * @param   string
 * @param   array
 * @param   bool
 * @return  string
 *
 * @example
	$campos[] = array('nome'=> 'nome', 'tipo' => 'varchar(50)');
	$campos[] = array('nome'=> 'idade', 'tipo' => 'int(3)', 'nulo' => true);
	$campos[] = array('nome'=> 'dataNascimento', 'tipo' => 'date', 'nulo' => true);
	$campos[] = array('nome'=> 'cpf', 'tipo' => 'int(9)');
	$campos[] = array('nome'=> 'dataCadastro', 'tipo' => 'datetime');
	$campos[] = array('nome'=> 'sexo', 'tipo' => 'boolean');
	$sql = montarCriacao("usuarios", $campos);
	exibir ($sql);

	//usuarioId | acao | objetoTipo | objetoId | data/hora
	$campos[] = array('nome'=> 'usuarioId', 'tipo' => 'int(11)');
	$campos[] = array('nome'=> 'acao', 'tipo' => 'char');
	$campos[] = array('nome'=> 'tabela', 'tipo' => 'varchar(50)');
	$campos[] = array('nome'=> 'objetoId', 'tipo' => 'int(11)');
	$campos[] = array('nome'=> 'datahora', 'tipo' => 'datetime');
	$sql = montarCriacao("log", $campos);
	exibir($sql);
 * @todo
	corrigir nome dos indices conforme padrão mysql
 */
function montarCriacao ($tabela, $atributos, $drop=false)
{
	$tamanho	= sizeof($atributos);
	$identacao	= "	";
	$sql		= "";

	if ($drop == true)
		$sql .= "DROP TABLE IF EXISTS $tabela;\n";

	$sql .= "CREATE TABLE IF NOT EXISTS $tabela (\n";
	$sql .= $identacao;
	$sql .= "id INT(11) PRIMARY KEY AUTO_INCREMENT,\n";

	foreach ($atributos as $valor) {
		if ($valor['Field'] != 'id') {
			$sql .= $identacao;
			$sql .= $valor['Field'] . " " . strtoupper($valor['Type']);
			if ($valor['Null'] == "NO") {
				$sql .= " NOT NULL";
			}
			$sql .= ",\n";
		}
	}
	$sql .= "INDEX (id)";
	$sql .= "\n);";

	return $sql;
}

/**
 * Executa um comando no BD
 * @package grimoire/bibliotecas/persistencia-pdo.php
 * @since 05-07-2015
 * @version 17/09/2016 19:02:44
 *
 * @param   string query a ser executada
 */
function executar ($sql)
{
	$db = new Database();
	$db->executarStmt($sql, array(), 'S'); # SSSSSSSSSSSSSSSSSSSSSSSSSSS
}
