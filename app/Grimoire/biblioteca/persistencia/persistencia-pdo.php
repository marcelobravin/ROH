<?php
/**
 * Manipulação de arrays
 * @package	grimoire/bibliotecas
*/

/**
 * Realiza uma conexão com um BD mySql através do PDO
 * @package	grimoire/bibliotecas/persistencia-pdo.php
 * @since	05-07-2015
 * @version	09/09/2016 20:24:25
 *
 * @param	boolean
 * @param	string
 * @param	string
 * @param	string
 * @param	string
 * @return	PDO
 *
 * @uses	PDO
 */
function conectarPdo (/* $transacao=false, */ $hostname=HOST, $dbname=DBNAME, $username=USER, $password=PASSWORD)
{
	try {
		$dbh = new PDO("mysql:host={$hostname};dbname={$dbname}", $username, $password);

		if ( PRODUCAO ) {
			$dbh->setAttribute(PDO::ATTR_ERRMODE	, PDO::ERRMODE_SILENT);
		} else {
			$dbh->setAttribute(PDO::ATTR_ERRMODE	, PDO::ERRMODE_EXCEPTION);
		}

		// $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== add this line
		// $dbh->setAttribute(PDO::ATTR_ORACLE_NULLS	, PDO::NULL_EMPTY_STRING);

		$dbh->exec("SET CHARACTER SET utf8"); //	return all sql requests as UTF-8

		#if ( $transacao )
			#$dbh->beginTransaction(); # apenas em tabelas innoDB {http://pt.stackoverflow.com/questions/41672/quais-as-diferen%C3%A7as-entre-myisam-e-innodb}

	} catch (PDOException $e) {
		echo $e->getMessage();
	}
	return $dbh;
}

/**
 * Escreve o conteúdo em um arquivo
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @param	string
 * @param	string
 * @param	bool	Conservar conteúdo, append
 *
 * @return	object
 *
 * @example
	cabecalho_download_csv("nome_arquivo_" . date("Y-m-d") . ".csv");
	echo array_para_csv($array);
*/
function conectar ()
{
	$connection = new PDO(
		"mysql:host=". HOST .";dbname=". DBNAME .";charset=". CHARSET, USER, PASSWORD,
		array(
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET ". CHARSET
		)
	);

	if ( PRODUCAO ) {
		$connection->setAttribute(PDO::ATTR_ERRMODE	, PDO::ERRMODE_SILENT);
	} else {
		$connection->setAttribute(PDO::ATTR_ERRMODE	, PDO::ERRMODE_EXCEPTION);
	}

	#$connection->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
	// ? $connection->exec("SET CHARACTER SET ". CHARSET); // return all sql requests as UTF-8

	return $connection;
}

/**
 * Escreve o conteúdo em um arquivo
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @param	string
 * @param	string
 * @param	bool	Conservar conteúdo, append
 *
 * @return	object
 *
 * @example
	cabecalho_download_csv("nome_arquivo_" . date("Y-m-d") . ".csv");
	echo array_para_csv($array);
*/
function conexaoPersistente ()
{
	try {
		$connection = new PDO(
			"mysql:host=". HOST .";dbname=". DBNAME .";charset=". CHARSET, USER, PASSWORD,
			array(
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET ". CHARSET,
				PDO::ATTR_PERSISTENT => true
			)
		);

		if ( PRODUCAO ) {
			$connection->setAttribute(PDO::ATTR_ERRMODE	, PDO::ERRMODE_SILENT);
		} else {
			$connection->setAttribute(PDO::ATTR_ERRMODE	, PDO::ERRMODE_EXCEPTION);
		}

		return $connection;
	} catch (Exception $e) {
		die("Unable to connect: " . $e->getMessage());
	}
}
/**
 * Executa um comando no BD
 * @package	grimoire/bibliotecas/persistencia-pdo.php
 * @version	05-07-2015
 * @version	17/09/2016 19:02:44
 *
 * @param	string query a ser executada
 * @return	int/array/int
 */
function executarOLD ($qry)
{
	$con = conectarPdo();
	$stmt = $con->prepare($qry);
	$stmt -> execute();

	$qry = trim($qry);
	$processo = strtoupper($qry[0]); # Identifica o primeiro caracter da query

	switch ( $processo ) {
		case 'I': # INSERT
			$retorno = $con->lastInsertId();
			break;
		case 'S': # SELECT
			$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
			break;
		default: # UPDATE/DELETE
			$retorno = $stmt->rowCount();
	}

	return $retorno;
}

/**
 * Executa um comando no BD
 * @package	grimoire/bibliotecas/persistencia-pdo.php
 * @since	05-07-2015
 * @version	06/07/2021 09:04:44
 *
 * @param	string	query a ser executada
 *
 * @example
	$sql = "
		SELECT
			c.id					categoria_id,
			c.titulo				categoria_nome,
			c.legenda				categoria_legenda,
			c.ativo					categoria_ativo,

			'-',

			e.categoria_id			elemento_categoria_id,
			e.titulo				elemento_nome,
			e.id					elemento_id,

			'--',

			m.elemento_id			meta_elemento_id,
			m.quantidade			meta_quantidade,
			m.ativo					meta_ativo,
			m.hospital_id			meta_hospital_id,
			m.id					meta_id,

			'---',

			r.meta_id				resultado_meta_id,
			r.resultado				resultado,
			r.mes					mes,
			r.justificativa			justificativa,
			r.justificativa_aceita	justificativa_aceita,
			r.id					resultado_id

			-- c.*,
			-- '||',
			-- e.*,
			-- '||',
			-- m.*,
			-- '||',
			-- r.*
		FROM
			categoria	c,
			elemento	e

			LEFT OUTER JOIN (meta m)
				ON m.elemento_id		= e.id
				AND m.hospital_id		= {$_GET['hospital']}
			LEFT OUTER JOIN (resultado r)
				ON r.meta_id			= m.id
				AND r.mes				= {$in_mesAtual}

		WHERE
			e.categoria_id = c.id

		ORDER BY
			c.titulo,
			e.titulo
	";

	$matriz = executar( $sql );
 */
function executar ($sql)
{
	$qry = trim($sql);
	$processo = strtoupper($qry[0]); # Identifica o primeiro caracter da query
	return executarStmt($sql, array(), $processo);
}

function executarSequencia ($sqls)
{
	$resultado = array();
	foreach ($sqls as $s) {
		$resultado[] = executar($s);
	}
	return $resultado;
}

/**
 * Executa statement via PDO
 * @package	grimoire/bibliotecas/persistencia.php
 * @since	05-07-2015
 * @version	10-06-2021
 *
 * @param	string
 * @return	int/array
 *
 * @uses	persistencia.php->conPdo()
*/
function executarStmt ($stmt, $valores=array(), $processo="U/D")
{
	try {
		$conn = conectar();
		$statement = $conn->prepare($stmt);
		$interrogacoes = substr_count($stmt, '?');

		if (is_array($valores)) {

			$valores = array_values($valores);

			for ($i=0; $i < $interrogacoes; $i++) {
				$statement->bindParam($i+1, $valores[$i]); // dá pra colocar verificação por tipo e tamanho // https://www.php.net/manual/pt_BR/pdo.constants.php
			}

			$statement->execute($valores);
		} else {
			$statement->execute();
		}

		switch ( $processo ) {
			case 'I': $retorno = $conn->lastInsertId(); # ---------------------- INSERT
				break;
			case 'S': $retorno = $statement->fetchAll(PDO::FETCH_ASSOC); # ----- SELECT
				break;
			default : $retorno = $statement->rowCount(); # --------------------- UPDATE/DELETE
		}

		desconectar($conn, $statement);

		return $retorno;
	} catch (PDOException $e) {
		return $e;
	}
}

/**
 * Retorna um registro pelo seu id
 * @package	grimoire/bibliotecas/persistencia-pdo.php
 * @version	05-07-2015
 *
 * @param	string
 * @return	bool
 *
 * @uses	$_SERVER
 */
function localizarPorId ($sql, $id)
{
	$con = conectarPdo();
	$qry = $con->prepare($sql);
	$qry -> bindParam(':id', $id, PDO::PARAM_INT);
	$qry -> execute();

	$return = $qry->fetch(PDO::FETCH_ASSOC);
	$con = null;
	return $return;
}

/**
 * Escreve o conteúdo em um arquivo
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @param	string
 * @param	string
 * @param	bool	Conservar conteúdo, append
 *
 * @return	bool
 *
 * @example
	cabecalho_download_csv("nome_arquivo_" . date("Y-m-d") . ".csv");
	echo array_para_csv($array);
*/
/*
$values = array(
	'login' => $_POST['login'],
	'senha' => hashPassword($_POST['senha'])
);
echo "Inserido registro número:". inserir('usuarios', $values);
//*/
function inserir ($tabela, $campos)
{
	try {
		$stmt = insercaoStmt($tabela, $campos);
		return executarStmt($stmt, $campos, 'I');
	} catch (PDOException $e) {
		throw new PDOException( $e->getMessage() );
	} catch (Exception $e) {
		return $e->getMessage();
	}
}

/**
 * Retorna um vetor de registros da tabela desejada
 * @package	grimoire/bibliotecas/persistencia-pdo.php
 * @since	05-07-2015
 * @version	15/07/2021 11:37:26
 *
 * @param	string
 * @param	array
 * @param	string
 * @param	string
 *
 * @return	array
 *
 * @example
	$condicoes = array(
		'login' => $_POST['login']
		, 'senha' => hashPassword($_POST['senha'])
	);
	$user = selecionar('usuarios', $condicoes);
	exibir($user);
 */
function selecionar ($tabela, $condicoes=array(), $diretrizes="", $colunas="*")
{
	$stmt = selecaoStmt($tabela, $condicoes, $diretrizes, $colunas);
	return executarStmt($stmt, $condicoes, 'S');
}

/**
 * Retorna um registro da tabela desejada
 * @package	grimoire/bibliotecas/persistencia-pdo.php
 * @since	05-07-2015
 * @version	15/07/2021 11:37:26
 *
 * @param	string
 * @param	array
 * @param	string
 * @param	string
 *
 * @return	array
 */
function localizar ($tabela, $condicoes=array(), $diretrizes="", $colunas="*")
{
	$stmt = selecaoStmt($tabela, $condicoes, $diretrizes, $colunas);
	$res = executarStmt($stmt, $condicoes, 'S');

	if ( empty( $res ) ) {
		return array();
	}

	return $res[0];
}

/**
 * Escreve o conteúdo em um arquivo
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @param	string
 * @param	string
 * @param	bool	Conservar conteúdo, append
 *
 * @return	bool
 *
 * @example
	$campos = array(
		'login' => 'Joel',
		'senha' => 'senha'
	);
	$condicoes = array(
		'id'	 => 56
		// ,
		// 'login'=> 'joe'
	);
	echo "Registros alterados: ". atualizar('usuarios', $campos, $condicoes);
*/
function atualizar ($tabela, $campos, $condicoes=array())
{
	$stmt = atualizacaoStmt($tabela, $campos, $condicoes);

	$condicoes = array_values($condicoes);
	foreach ($condicoes as $valor) {
		$campos[] = $valor;
	}

	return executarStmt($stmt, $campos);
}

/**
 * Escreve o conteúdo em um arquivo
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @param	string
 * @param	string
 * @param	bool	Conservar conteúdo, append
 *
 * @return	bool
 *
 * @example
	$condicoes = array(
		// 'id'	 => 51
		'login'=> 'joel'
	);
	echo "Registros excluídos: ". excluir('usuarios', $condicoes);
*/
function excluir ($tabela, $condicoes="")
{
	$stmt = exclusaoStmt($tabela, $condicoes);
	return executarStmt($stmt, $condicoes);
}

/**
 * Monta query para inserção de registros
 * @package grimoire/bibliotecas/sql.php
 * @since	05-07-2015
 * @version 10-06-2021
 *
 * @param	string
 * @param	array/string
 * @return	string
 *
 * @uses		persistencia.php->executar()
 * @example
	echo $sql = insercaoStmt("usuarios", array("nome"=>"jose"));
*/
function insercaoStmt ($tabela, $campos)
{
	$valores	= array();
	$atributos	= array();

	if ( is_array($campos) ) {
		foreach ($campos as $indice => $valor) {
			$atributos[] = "`$indice`";
			$valores[]	= "?";
		}
	}

	$atributos	= implode(", ", $atributos);
	$valores	= implode(", ", $valores);

	return "INSERT INTO `$tabela` ($atributos) VALUES ($valores)";
}

/**
 * Monta query com prepared statement para seleção de registros
 * @package	grimoire/bibliotecas/sql.php
 * @since	05-07-2015
 * @version	12/07/2021 11:27:42
 *
 * @param	string				nome da tabela onde será realizada a busca
 * @param	string/array/int	criterios de busca da consulta
 * @param	null/string		diretrizes complementares
 * @param	string				campos que serão retornados
 * @return	string				query de seleção
 * @example
		echo $sql = montarSelecao("tabela");
		echo $sql = montarSelecao("tabela", "nome='ze' AND sobrenome='maluco'");
		echo $sql = montarSelecao("tabela", "nome='ze' OR sobrenome='maluco'", "LIMIT1", "nome");
*/
function selecaoStmt ($tabela, $criterios="", $diretrizes="", $colunas="*")
{
	if ( is_array($colunas) ) {
		$colunas = implode(", ", $colunas);
	}

	$sql = "SELECT $colunas FROM $tabela";

	if ( !empty($criterios) ) {
		$sql .= " WHERE ";
		if (is_array($criterios)) {
			$sql .= implode("=? AND ", array_keys($criterios)) ."=?";
		} else if (is_numeric($criterios)) {
			$sql .= "id=?"; # -------------- PK da tabela deve chamar id
		} else {
			$sql .= $criterios;# <<<<<<<<<<< VERIFICAR linha abaixo quanto a binds
		}
	}

	if ( strlen($diretrizes) > 0 ) {
		$sql .= " $diretrizes";
	}

	return $sql;
}

/**
 * Monta query com prepared statement para atualização de registros
 *
 * @package grimoire/bibliotecas/sql.php
 * @since	05-07-2015
 * @version 11-06-2021
 *
 * @paramstring
 * @return	bool
 *
 * @uses	persistencia.php->executar()
 * @uses	sql.php->atualizacao()
 * @example
	$usuario2 = array('id'=>'3', 'nome'=>'Décio Carvalho', 'email'=>'1@2', 'sexo'=>'masculino');
	exibir($sql = atualizacao("tb_usuarios", $usuario2));
	//echo $sql = atualizacao("tabela", array("nome"=>"Jose"), "id=1");
	//echo $sql = atualizacao("tabela", array("nome"=>"Jose"));
	//echo $sql = atualizacao("tabela", array("nome"=>"Jose"), 4);
*/
function atualizacaoStmt ($tabela, $campos, $condicoes="")
{
	$sql = "\nUPDATE $tabela SET\n ";
	$x = array();
	$y = array();

	if ( is_array($campos) ) {
		foreach ($campos as $indice => $valor) {
			$x[] = "$indice=?\n";
		}
	} else {
		$x = $campos;
	}

	$sql .=	implode(", ", $x);

	if ( is_array($condicoes) ) {
		foreach ($condicoes as $indice => $valor) {
			$y[] = "$indice=?\n";
		}
	} else {
		$y = $condicoes;
	}

	if ( !empty($condicoes) ) {
		$sql .= "WHERE\n". implode(" AND ", $y);
	}

	return $sql;
}

/**
 * Monta query com prepared statement para exclusão de registros
 *
 * @package grimoire/bibliotecas/sql.php
 * @since	05-07-2015
 * @version 11-06-2021
 *
 * @paramstring
 * @return	bool
 *
 * @uses	persistencia.php->executar()
 * @uses	sql.php->atualizacao()
 * @example
	$usuario2 = array('id'=>'3', 'nome'=>'Décio Carvalho', 'email'=>'1@2', 'sexo'=>'masculino');
	exibir($sql = atualizacao("tb_usuarios", $usuario2));
	//echo $sql = atualizacao("tabela", array("nome"=>"Jose"), "id=1");
	//echo $sql = atualizacao("tabela", array("nome"=>"Jose"));
	//echo $sql = atualizacao("tabela", array("nome"=>"Jose"), 4);
*/
function exclusaoStmt ($tabela, $condicoes="")
{
	$sql = "DELETE FROM $tabela ";
	$y = array();

	if ( is_array($condicoes) ) {
		foreach ($condicoes as $indice => $valor) {
			$y[] = "$indice=?\n";
		}
	} else {
		$y = $condicoes;
	}

	if ( !empty($condicoes) ) {
		$sql .= "WHERE\n". implode(" AND ", $y);
	}

	return $sql;
}

/**
 * Escreve o conteúdo em um arquivo
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @param	string
 * @param	string
 * @param	bool	Conservar conteúdo, append
 *
 * @return	bool
 *
 * @example
	cabecalho_download_csv("nome_arquivo_" . date("Y-m-d") . ".csv");
	echo array_para_csv($array);
*/
function desconectar (&$connection, &$statement)
{
	$statement->closeCursor();
	// $connection->query('KILL CONNECTION_ID()');

	$statement = null;
	$connection = null;
}

/**
 * Escreve o conteúdo em um arquivo
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @param	string
 * @param	string
 * @param	bool	Conservar conteúdo, append
 *
 * @return	bool
 *
 * @example
	cabecalho_download_csv("nome_arquivo_" . date("Y-m-d") . ".csv");
	echo array_para_csv($array);
*/
/*
aplicável apenas a sqls sem interrogações
*/
function transacao ( $sqls=array() )
{
	try {
		$con = conexaoPersistente();
		$con->beginTransaction();

		foreach ( $sqls as $sql) {
			$stmt = $con->prepare($sql);
			$stmt->execute();
		}

		$con->commit();
		desconectar($con, $stmt);
		return true;

	} catch (Exception $e) {
		$con->rollBack();
		desconectar($con, $stmt);
		return false;
	}
}

/**
 * Escreve o conteúdo em um arquivo
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @param	string
 * @param	string
 * @param	bool	Conservar conteúdo, append
 *
 * @return	bool
 *
 * @example
	cabecalho_download_csv("nome_arquivo_" . date("Y-m-d") . ".csv");
	echo array_para_csv($array);
*/
/**
 *@example
	# 1 ------------------------------------------------------------------------ Inicio
	$conP = iniciarTransacao();

	# 2 ------------------------------------------------------------------------ Operações
	$c = array(
		'usuarioId'	=> '1',
		'sucesso'	=> '1',
		'ip'		=> '1',
		'navegador'	=> '1',
		'datahora'	=> agora()
	);

	$sql = insercao('_log_acesso', $c);
	$statement = operacaoSequencial($conP, $sql);
	$id = $conP->lastInsertId();

	$p = array(
		'usuarioId'		=> '1',
		'acao'			=> '1',
		'tabela'		=> $id,
		'objetoId'		=> '1',
		'ip'			=> '1',
		'navegador'		=> '1',
		'datahora'		=> agora()
	);

	$sql = insercao('_log_operacoes', $p);
	$statement = operacaoSequencial($conP, $sql);
	$id2 = $conP->lastInsertId();

	# 3 ------------------------------------------------------------------------ Fim
	$sucesso = positivo($id) && positivo($id2);
	encerrarTransacao($conP, $statement, $sucesso);
*/
function iniciarTransacao ()
{
	$con = conexaoPersistente();
	$con->beginTransaction();
	return $con;
}

/**
 * Escreve o conteúdo em um arquivo
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @param	string
 * @param	string
 * @param	bool	Conservar conteúdo, append
 *
 * @return	bool
 *
 * @example
	cabecalho_download_csv("nome_arquivo_" . date("Y-m-d") . ".csv");
	echo array_para_csv($array);
*/
function encerrarTransacao ( $con, $stmt, $sucesso=true)
{
	if ( $sucesso ) {
		$con->commit();
	} else {
		$con->rollBack();
	}

	desconectar($con, $stmt);
}

/**
 * Escreve o conteúdo em um arquivo
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @param	string
 * @param	string
 * @param	bool	Conservar conteúdo, append
 *
 * @return	bool
 *
 * @example
	cabecalho_download_csv("nome_arquivo_" . date("Y-m-d") . ".csv");
	echo array_para_csv($array);
*/
function operacaoSequencial ($conP, $sql)
{
	$statement = $conP->prepare($sql);
	$statement->execute();

	return $statement;
}
