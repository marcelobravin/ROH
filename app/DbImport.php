<?php
include '../config.php';

# remover antes de colocar em produção !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
require ROOT.'/model/database.class.php';



# se for diferente dá problema no banco
define( "DBNAME"	, $env['DBNAME'] ); // Conjunto de caracteres do banco de dados a ser usado na criação das tabelas.
define( "DB_CHARSET", "utf8" ); // Conjunto de caracteres do banco de dados a ser usado na criação das tabelas.
define( "DB_COLLATE", "utf8_general_ci" ); // Conjunto de caracteres do banco de dados a ser usado na criação das tabelas.
# pegar dinamicamente
#define( "DIRETORIO", "/opt/lampp/htdocs/ROH/_arquivos_auto_gerados" ); // Conjunto de caracteres do banco de dados a ser usado na criação das tabelas.
define( "DIRETORIO", ROOT. "/_arquivos_auto_gerados" ); // Conjunto de caracteres do banco de dados a ser usado na criação das tabelas.



// popularTabelas(DIRETORIO ."/modelos/*.sql");


//*
if ( inicializarSistema() )
	echo "Importação de BD realizada com sucesso!";
else {
	echo "Erro ao importar BD";
}
//*/



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
function inicializarSistema() {
	criarBanco(); # adicionar if exists

	// if (false) {
		gerarTabelas(DIRETORIO ."/modelos/*.php");
		// popularTabelas(DIRETORIO ."/modelos/registros/*.sql");
		popularTabelas(DIRETORIO ."/modelos/*.sql");
		// if (false/* GERAR_HTACCESS */)
			// gerarHtaccess();
	// }

	// redirecionar();
	return true;
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
function criarBanco() {
	// $db = new Database();
	// $conn = $db->executarStmt($sql, array(), 'S'); # SSSSSSSSSSSSSSSSSSSSSSSSSSS

	$env = parse_ini_file(ROOT.".env");

	$host = $env['HOST'];
	$db = $env['DBNAME'];
	$user = $env['USER'];
	$root_password = $env['PASSWORD'];

	// $user = 'newuser';
	// $pass = 'newpass';
	$sql = 'CREATE DATABASE '. DBNAME .' DEFAULT CHARACTER SET '. DB_CHARSET .' COLLATE '. DB_COLLATE .';';

	try {
		$dbh = new PDO("mysql:host=$host", $user, $root_password);

		$dbh->exec($sql)
		or die(print_r($dbh->errorInfo(), true));
		// $dbh->exec("CREATE DATABASE `$db`;
		// 	CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';
		// 	GRANT ALL ON `$db`.* TO '$user'@'localhost';
		// 	FLUSH PRIVILEGES;")
		// or die(print_r($dbh->errorInfo(), true));
	} catch (PDOException $e) {
		die("DB ERROR: " . $e->getMessage());
	}

	// executar($sql);

	return true;
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
function gerarTabelas($diretorio) {
	$modelos = glob($diretorio);

	foreach ($modelos as $modelo) {
		include($modelo);
	}
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
//popularTabelas();
function popularTabelas($diretorio) {
	$modelos = glob($diretorio);

	foreach ($modelos as $modelo) {
	  $sqls = file_get_contents($modelo);
	  $sqls = explode(";\n", $sqls);
	  foreach ($sqls as $key => $sql) {
		// echo $sql. "<br>";
		if (!empty($sql)) {
		  try {
			// executar($sql);
			$db = new Database();
			$db->executarStmt($sql, array(), 'I'); # SSSSSSSSSSSSSSSSSSSSSSSSSSS
			// $db = new Database();
			// $conn = $db->executarStmt($sql, array(), 'S'); # SSSSSSSSSSSSSSSSSSSSSSSSSSS
			// $conn = executar($sql); # SSSSSSSSSSSSSSSSSSSSSSSSSSS
		  } catch (Exception $e) {
			// exibir($e);
			// echo('<pre>');
			// print_r($e);
			// echo('</pre>');
		  }
		}
	  }
	}
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
function redirecionar($destino=false, $descartarParametros=false) {

	if ($destino==false) { // Define como destino a página anterior
	  $url = $_SERVER['HTTP_REFERER'];
	} elseif($destino==null) { // Define como destino a página atual
	  if ($descartarParametros) {
		$url = explode("?", $_SERVER['PHP_SELF']);
		$url = $url[0];
	  } else {
		$url = $_SERVER['PHP_SELF'];
	  }
	} else {
	  $url = $destino; // Define como destino a página solicitada
	}

	// Redireciona para a página solicitada
	if (!headers_sent()) {
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
function limparNomeArquivo($arquivo, $separador="/") {
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
function montarCriacao($tabela, $atributos, $drop=false) {
	$tamanho   = sizeof($atributos);
	$identacao = "	";
	$sql	   = "";
	if ($drop == true) {
	  $sql .= "DROP TABLE IF EXISTS $tabela;\n";
	}

	$sql .= "CREATE TABLE IF NOT EXISTS $tabela (\n";
	$sql .= $identacao;
	$sql .= "id INT(11) PRIMARY KEY AUTO_INCREMENT,\n";
	//$i = 1;
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
 * @return  int/array/int
 *
 * @todo
 *   arrumar select single ou usar localizar para single
 *   arrumar create, drop, alter
 */
function executar($qry) {
	$db = new Database();
	$db->executarStmt($qry, array(), 'S'); # SSSSSSSSSSSSSSSSSSSSSSSSSSS
}
