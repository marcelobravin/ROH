<?php
/**
 * Funções para criação de tabelas e arquivos em ambiente de desenvolvimento
 * @package	grimoire/bliblioteca/opcionais
*/

/**
 * Cria um BD com o nome definido nas configurações
 * @package	grimoire/bibliotecas/persistencia.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @param	string
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
 * Registra acesso ao banco
 * @package	grimoire/bibliotecas/acesso.php
 * @since	05-07-2015
 * @version	07/07/2021 12:37:48
 *
 * @param	string
 * @return	bool
 *
 * @uses	acesso.php->identificarIP()
 * @uses	persistencia.php->executar()
 * @example
		gravarLog(1, "U", "produto", 15);
		gravaLog("15", "C/R/U/D", "produto", "29");
 */
function criarTabelaLog ()
{
	$sql = templateTabelaLog();
	executar($sql);
}

/**
 * Comprime múltiplos arquivos de um extensão em um único arquivo opcionalmente minificado
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @version	05-07-2015
 *
 * @param	array
 * @param	string: js/css
 * @param	bool
 * @return	string: nome do arquivo gerado
 *
 * @uses	arquivos.php->minimizarArquivo()
 * @uses	arquivos.php->limparNomeArquivo2()
 * @uses	arquivos.php->escrever()
 * @uses	$_SERVER
 * @example
	$listaScripts = array(
		'js/valid/validaInscricaoEstadual.js',
		'js/jQuantity.js',
		'js/jValidation.js'
	);

	comprimir($listaScripts, "js");
 */
function comprimir ($listaArquivos, $tipo="js", $minimizar=true)
{
	$conteudo = "";
	foreach ($listaArquivos as $value) {
		$conteudo .= file_get_contents(ARQUIVOS."/".$value);
	}

	if ($minimizar) {
		$conteudo = minimizarArquivo($conteudo);
	}

	$pagina = limparNomeArquivo($_SERVER['PHP_SELF']);
	$arquivoGerado = "arquivos/{$tipo}/minimizados/{$pagina}.{$tipo}";

	$conteudo = "
		$(document).ready(function(){
			$conteudo
		});
	";

	escrever($arquivoGerado, $conteudo, true);
	return $arquivoGerado;
}


/**
 * Retorna os campos de uma tabela
 *
 * @since	05-07-2015
 * @version	23/07/2021 11:48:16
 *
 * @param	string
 * @param	bool
 * @param	null/string
 * @return	array
 *
 * @uses	persistencia.php->executar()
 *
 * @example
		$descricao = descreverTabela("tabela");
 */
function descreverTabela ($tabela, $full=false, $banco=null)
{
	if ( $full ) {
		$sql = "SHOW FULL COLUMNS FROM $tabela";
	} else {
		$sql = "SHOW COLUMNS FROM $tabela";
	}

	if ( !is_null($banco) ) {
		$sql .= " FROM $banco";
	}

	return executar($sql);
}

/**
 * Gera arquivos para recriação do BD
 * @since	05-07-2015
 * @version	20/07/2021 11:57:50
 *
 * @uses	persistencia-pdo.php->conectarPdo()
 * @uses	persistencia.php->descreverTabela()
 * @uses	acesso.php->gerarModelo()
 * @uses	acesso.php->gerarInserts()
 */
function exportarBD ()
{
	$sql = "SHOW FULL TABLES FROM ". DBNAME;
	$tabelas = executar($sql);

	foreach ($tabelas as $t) {
		$d = descreverTabela($t['Tables_in_'. DBNAME], true);
		$sql = montarCriacao($t['Tables_in_'. DBNAME], $d);

		escrever(ARQUIVOS_EFEMEROS."/db/ddl/tabelas/tb_{$t['Tables_in_'. DBNAME]}.sql", $sql, true);

		gerarInserts($t['Tables_in_'. DBNAME]);

		$sqls = gerarFKs($t['Tables_in_'. DBNAME]); # TODO retirar geração e ao exportar mandar as em uso

		if ( !empty($sqls['INSERT']) ) {
			$content = $sqls['ALTER TABLE'];

			$content .= "\n\n";
			$content .= concatenar2($sqls['INSERT']);
			escrever(ARQUIVOS_EFEMEROS."/db/ddl/fks_{$t['Tables_in_'. DBNAME]}.sql", $content, true);
		}
	}

	$c = exportarConstraints();
	registrartUQs($c['uqs']);

	return true;
}

function exportarUQs ($db=DBNAME)
{
	# Use the information_schema.key_column_usage table to get the fields in each one of those constraints:
	$sqlKeyColumns = "SELECT *
		FROM information_schema.key_column_usage
		WHERE constraint_schema = '{$db}'
			AND constraint_name != 'PRIMARY'";

	return executar($sqlKeyColumns);
}

function exportarFKs ($db=DBNAME)
{
	# Use the information_schema.table_constraints table to get the names of the constraints defined on each table:
	$sqlConstraints = "SELECT *
		FROM information_schema.table_constraints
		WHERE constraint_schema = '{$db}'
			AND constraint_type = 'FOREIGN KEY'";

	return executar($sqlConstraints);
}

function gerarFKs ($tabela)
{
	$sql = "ALTER TABLE `{$tabela}` ENGINE = InnoDB;";

	$t = descreverTabela($tabela);

	$sql2 = array();
	foreach ($t as $v) {

		if ( comecaCom("id_", $v['Field']) ) {
			$tab = explode('_', $v['Field']);
			$sql2[] = criacaoFK($tabela, $tab[1]);
		}
	}

	return array(
		'ALTER TABLE'	=> $sql,
		'INSERT'		=> $sql2
	);
}

/**
 * Gera arquivo .htaccess
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @version	05-07-2015
 *
 * @return	bool
 */
function gerarHtaccess ()
{
	$SITE['url'] = "URL";

	$conteudo = '
	AddDefaultCharset '. CARACTERES .'
	AddCharset '. CARACTERES .' .atom .css .js .json .rss .vtt .xml

	# The following header ensures that browser will **only** connect to
	# your server via HTTPS, regardless of what users type in the address bar.

	# <IfModule mod_headers.c>
	#	Header set Strict-Transport-Security max-age=16070400;
	# </IfModule>

	<IfModule mod_rewrite.c>
		RewriteEngine On
		# Use UTF-8 encoding for anything served text/plain or text/html

		RewriteRule ^home/?$ http://localhost/sites/canabella/index.php [NC,L]

		<FilesMatch "\.(htm|html|css|js)$">
			AddDefaultCharset '. strtoupper(CARACTERES) .'
		</FilesMatch>

		ErrorDocument 400 '. $SITE['url'] .'http://localhost/sites/canabella/404.php
		ErrorDocument 401 '. $SITE['url'] .'http://localhost/sites/canabella/404.php
		ErrorDocument 403 '. $SITE['url'] .'http://localhost/sites/canabella/404.php
		ErrorDocument 404 '. $SITE['url'] .'http://localhost/sites/canabella/404.php
		ErrorDocument 500 '. $SITE['url'] .'http://localhost/sites/canabella/404.php
	</IfModule>

	# ----------------------------------------------------------------------
	# A little more security
	# ----------------------------------------------------------------------

	# To avoid displaying the exact version number of Apache being used, add the
	# following to httpd.conf (it will not work in .htaccess):
	# ServerTokens Prod

	# "-Indexes" will have Apache block users from browsing folders without a
	# default document Usually you should leave this activated, because you
	# shouldnt allow everybody to surf through every folder on your server (which
	# includes rather private places like CMS system folders).
	<IfModule mod_autoindex.c>
		Options -Indexes
	</IfModule>

	# Block access to "hidden" directories or files whose names begin with a
	# period. This includes directories used by version control systems such as
	# Subversion or Git.
	<IfModule mod_rewrite.c>
		RewriteCond %{SCRIPT_FILENAME} -d [OR]
		RewriteCond %{SCRIPT_FILENAME} -f
		RewriteRule "(^|/)\." - [F]
	</IfModule>

	# Block access to backup and source files. These files may be left by some
	# text/html editors and pose a great security danger, when anyone can access
	# them.
	<FilesMatch "(\.(bak|config|dist|fla|inc|ini|log|psd|sh|sql|swp)|~)$">
		Order allow,deny
		Deny from all
		Satisfy All
	</FilesMatch>
	';

	return escrever(ARQUIVOS_EFEMEROS ."/.htaccess", $conteudo, true);
}

/**
 * Gera arquivo .env de exemplo, conectável ao localhost
 *
 * @package	grimoire/bibliotecas/arquivos.php
 * @version	05-07-2015
 *
 * @return	bool
 */
function gerarEnv ()
{
	$conteudo = "HOST=localhost\nBD=db_relatorio_ocupacao_hospitalar\nUSUARIO=root\SENHA=\nPORT=3306";
	return escrever(ARQUIVOS_EFEMEROS ."/.env", $conteudo, true);
}

function getDirectoryFiles ($path='.')
{
	$rii = new RecursiveIteratorIterator( new RecursiveDirectoryIterator($path) );

	$files = array();
	foreach ($rii as $file) {
		if ( $file->isDir() ) {
			continue;
		}
		$files[] = $file->getPathname();
	}

	return $files;
}

function generateMinified ($file, $dir=ARQUIVOS_EFEMEROS)
{
	$minifiedContent = minify($file);
	$pieces = explode('/', $file);
	$length = count($pieces)-1;
	$fileName = $pieces[$length];
	file_put_contents($dir. $fileName, $minifiedContent);
}

/**
 * Linha marcada pode remover urls:
 * https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
*/
function minify ($file)
{
	$contents = file_get_contents($file);
	return minifyContent($contents);
}

/**
 * Linha marcada pode remover urls:
 * https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
*/
function minifyContent ($contents)
{
	$contents = removeHtmlComments($contents);
	$contents = removeDoubleSpaces($contents);
	$contents = removeBlockComments($contents);
	$contents = removeJsLineComments($contents); // ! se estiver em uma linha remove tudo
	$contents = removeLineBreaks($contents);
	$contents = removeEspacoEsimbolo($contents);
	$contents = removeTabs($contents);
	return $contents;
}

function registerProjectFiles ()
{
	$allFiles = registerMapDirectory(BASE, 'ALL');

	$total_lines = 0;
	$total_chars = 0;
	foreach ($allFiles as $i => $v) {
		if ( preg_match('/^\\.\\\\\.git/', $v) ) { // remove os arquivos do diretorio .git da listagem
			unset($allFiles[$i]);
		} else {
			$total_lines += countLines($v);
			$total_chars += countCharacters($v);
		}
	}

	registerCharNumber($total_lines, $total_chars);
	return true;
}

function registerCharNumber ($total_lines, $total_chars)
{
	$jsonDir	= ARQUIVOS_EFEMEROS.'/listas/_projectSize.json';

	$content = array(
		'total_lines' => $total_lines,
		'total_chars' => $total_chars
	);
	file_put_contents($jsonDir, json_encode($content) );
}

// segmentar com getJson
function getProjectFiles ()
{
	$jsonDir = ARQUIVOS_EFEMEROS.'/listas/_projectSize.json';

	$content	= file_get_contents($jsonDir);
	$content	= json_decode($content);

	$allFiles	= getMapDirectory('ALL', 'assets\lists\temp\_');

	return array(
		'allFiles'		=> $allFiles
		, 'total_lines' => $content->total_lines
		, 'total_chars' => $content->total_chars
	);
}

function assetPipeline ($js=true, $css=true, $imgs=true)
{
	if ( $css ) {
		$cssFiles = getDirectoryFiles(BASE.'public/css');
		foreach ($cssFiles as $v) {
			if ( preg_match('/\.css$/', $v) ) {
				generateMinified($v, ARQUIVOS_EFEMEROS.'/minified/');
			}
		}
	}

	if ( $js ) {
		$jsFiles = getDirectoryFiles(BASE.'public/scripts');
		foreach ($jsFiles as $v) {
			if ( preg_match('/\.js$/', $v) ) {
				generateMinified($v, ARQUIVOS_EFEMEROS.'/minified/');
			}
		}
	}

	if ( $imgs ) {
		$iconFiles = getDirectoryFiles(BASE.'public/images/icons');
		imageGrouper( $iconFiles );
	}

	return true;
}

function getDirectorySize ($path)
{
	$bytestotal = 0;
	$path = realpath($path);
	if($path!==false && $path!='' && file_exists($path)){
		foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object){
			$bytestotal += $object->getSize();
		}
	}
	return $bytestotal;
}

/**
 *
 */
function registerMapDirectory ($path, $fileName)
{
	$jsonDir = ARQUIVOS_EFEMEROS.'/listas/_';

	try {
		$files = getDirectoryFiles($path);

		foreach ($files as $key => $value) {
			if (strpos($value, '.git') > 0 ) {
				unset($files[$key]);
			}
		}
		file_put_contents($jsonDir. $fileName.'.json', json_encode($files));
		return $files;
	} catch (Exception $e) {
		reportError($e, '0101');
		return array();
	}
}

function getMapDirectory ($fileName, $jsonDir=ARQUIVOS_EFEMEROS.'/listas/_')
{
	try {
		$path = $jsonDir. $fileName.'.json';
		$files = file_get_contents($path);
		$files = json_decode($files);
		return $files;
	} catch (Exception $e) {
		reportError($e, '0101'); // ? //////////////////////////////////////////
		return array();
	}
}

function getDirectoryTree ($dir = '.')
{
	$files = scandir($dir);
	$filesReturn = array();

	foreach ($files as $key => $value) {
		$criteriosExclusao = array(
			"."
			, ".."
			, '.git'
			, '.gitattributes'
			, '.gitignore'
		);

		if ( !in_array($value, $criteriosExclusao) ) {
			$pathToFile = $dir . DIRECTORY_SEPARATOR . $value;
			if ( is_dir($pathToFile) ) {
				$filesReturn[$value] = getDirectoryTree($pathToFile);
			} else {
				$filesReturn[$key] = $value;
			}
		}
	}
	return $filesReturn;
}

function buildTree ($DT, $lv=0)
{
	$resposta = '';
	$indentacao = '';
	for ($i=0; $i<$lv ; $i++) {
		$indentacao .= '|	';
	}

	if ( is_array($DT) ) {
		$k = 0;
		foreach ($DT as $key => $value) {
			$dirSymbol = '├── '; # middle

			$k++;
			if ( is_array($value) ) {
				$resposta .= $indentacao . $dirSymbol . $key;
				$resposta .= ' ('.count($value).')';
				$resposta .= PHP_EOL;
				$resposta .= buildTree($value, $lv+1);
			} else {
				if ($key-1 == count($DT) ) {
					$dirSymbol = '└── '; # last
				}

				$resposta .= $indentacao . $dirSymbol . $value;
				$resposta .= PHP_EOL;
			}
		}
	}

	return $resposta;
}

function generateSiteMap ($dir=ARQUIVOS_EFEMEROS.'/listas/_', $fileName='siteMap')
{
	$DT = getDirectoryTree(BASE);
	$fileTree = buildTree($DT);
	file_put_contents($dir. $fileName.'.txt', $fileTree);
	return $fileTree;
}

function countLines ($file)
{
	$linecount = 0;
	$handle = fopen($file, "r");
	while ( !feof($handle) ) {
		$linecount++;
	}

	fclose($handle);

	return $linecount;
}

function countCharacters ($file)
{
	$charcount = 0;
	$handle = fopen($file, "r");
	while ( !feof($handle) ) {
		$line = fgets($handle);
		$charcount += strlen($line);
	}

	fclose($handle);

	return $charcount;
}

/**
 * Altera permissão de acesso de um arquivo
 * @package	grimoire/bibliotecas/acesso.php
 * @version	05-07-2015
 *
 * @param	string
 * @param	int
 *
 * @example
		chmod ("/somedir/somefile", 2);
 */
function alterarPermissao ($arquivo, $permissao=0)
{
	switch ($permissao) {
		case 1: $codigo = 0644; # Escrita e leitura para o proprietario, leitura para todos os outros
			break;
		case 2: $codigo = 0755; # Tudo para o proprietario, leitura e execucao para os outros
			break;
		case 3: $codigo = 0750; # Tudo para o proprietario, leitura e execucao para o grupo do prop
			break;

		default: $codigo = 0600; # Escrita e leitura para o proprietario, nada ninguem mais
	}

	chmod($arquivo, $codigo);
}

/**
 * Altera permissão de acesso de um arquivo recursivamente
 * @package	grimoire/bibliotecas/acesso.php
 * @version	05-07-2015
 *
 * @param	string
 *
 * @example
		chmod ("/somedir/somefile", 2);
 */
function chmod_r($path, $permission=0777) {
	$dir = new DirectoryIterator($path);
	foreach ($dir as $item) {
		chmod($item->getPathname(), $permission);
		if ($item->isDir() && !$item->isDot()) {
			chmod_r($item->getPathname());
		}
	}
}

/**
 * Gera arquivo com os registros da tabela
 *
 * @param	string
 *
 * @uses	persistencia.php->executar()
 * @uses	sql.php->insercao()
 * @uses	GRIMOIRE."modelos/registros/"
 */
function gerarInserts ($tabela)
{
	$sql = selecao($tabela);
	$con = conectarPdo();
	$qry = $con->prepare($sql);
	$qry -> execute();

	$registros = $qry->fetchAll(PDO::FETCH_ASSOC);
	$con = null;

	$inserts = "";
	foreach ($registros as $value) {
		$value = str_replace(array("\r\n", "\r", "\n", "\t", '	', '		', '		'), '', $value);
		$inserts .= insercao($tabela, $value);
		$inserts .= ";\n";
	}

	escrever(ARQUIVOS_EFEMEROS."/db/dml/registros/{$tabela}.sql", $inserts, true);
}

/**
 * Realiza multiplas inserções
 * @package	grimoire/bibliotecas/instalacao.php
 * @since	28/06/2021 11:52:15
 *
 * @param	string
 * @param	array
 *
 * @example
	$matriz = array(
		array ("criado_por"=> 1, "titulo" => "Equipe"),
		array ("criado_por"=> 1, "titulo" => "Internação"),
		array ("criado_por"=> 1, "titulo" => "Ambulatório"),
		array ("criado_por"=> 1, "titulo" => "Consultas ambulatoriais"),
		array ("criado_por"=> 1, "titulo" => "Procedimentos e cirurgias ambulatoriais"),
		array ("criado_por"=> 1, "titulo" => "SADT"),
		array ("criado_por"=> 1, "titulo" => "Atenção domiciliar")
	);

	insercaoMatricial('categoria', $matriz);
*/
function insercaoMatricial ($tabela, $matriz)
{
	foreach ($matriz as $obj) {
		echo inserir($tabela, $obj);
		br();
	}
}

/**
 * Prepara o ambiente para execução do projeto
 * @package	grimoire/bibliotecas/acesso.php
 * @since	05-07-2015
 * @version	25/07/2021 11:00:34
 *
 * @uses	persistencia.php->criarBanco()
 * @uses	persistencia.php->importarRegistros()
 */
function importarBD ()
{
	criarBanco();

	if ( !importarRegistros(ARQUIVOS_EFEMEROS ."/db/ddl/tabelas/*.sql") ) {
		die( 'Erro: importarTabelas()');
	}

	if ( !importarRegistros(ARQUIVOS_EFEMEROS ."/db/ddl/constraints_*.sql") ) {
		die( 'Erro: importarConstraints()');
	}

	if ( !importarRegistros(ARQUIVOS_EFEMEROS ."/db/dml/registros/*.sql") ) {
		die( 'Erro: importarRegistros()');
	}

	return true;
}

/**
 * Realiza inserções nas tabelas
 * @package	grimoire/bibliotecas/acesso.php
 * @since	05-07-2015
 * @version	24-06-2021
 *
 * @uses	GRIMOIRE."modelos/"
 * @uses	persistencia.php->executar()
 */
function importarRegistros ($diretorio)
{
	$modelos = glob($diretorio);

	foreach ($modelos as $m) {

		$sqls = file_get_contents($m);
		$sqls = explode(";\n", $sqls);

		foreach ($sqls as $sql) {

			if ( !empty($sql) ) {
				try {
					echo $sql;
					br();
					executar($sql);
				} catch (Exception $e) {
					echo '<pre>';
					print_r($e->getMessage());
					echo '</pre>';
				}
			}
		}
	}

	return true;
}

/**
 * Monta o sql de criação de uma tabela conforme descricao em array
 * @package	grimoire/bibliotecas/sql.php
 * @since	05-07-2015
 * @version	16/07/2021 22:11:59
 *
 * @param	string
 * @param	array
 * @param	bool
 * @return	string
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
 */
function montarCriacao ($tabela, $atributos, $drop=false)
{
	$identacao = "	";
	$sql = "";

	if ($drop) {
		$sql .= "DROP TABLE IF EXISTS $tabela;\n";
	}

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

			if ($valor['Default'] != "") {
				$sql .= " DEFAULT ".$valor['Default'];
			}

			if ($valor['Extra'] != "") {
				$sql .= " ".$valor['Extra'];
			}

			if ($valor['Comment'] != "") {
				$sql .= " COMMENT '".$valor['Comment']."'";
			}


			$sql .= ",\n";
		}
	}
	$sql .= "INDEX (id)";
	$sql .= "\n);";

	return $sql;
}

function exportarConstraints ($db=DBNAME)
{
	$fks = exportarFKs($db); # fks existentes no BD
	$uqs = exportarUQs($db);

	return array(
		'fks' => $fks,
		'uqs' => $uqs
	);
}

function converterUQs ($uqs)
{
	$tabelas = array();
	foreach ($uqs as $v) {
		$tabelas[$v['TABLE_NAME']][] = $v['COLUMN_NAME'];
	}

	$t = array_keys( $tabelas );
	$alters = "";
	if ( !empty($t) ) {
		$alters = "-- ".agora( IDIOMA=='pt-BR' )."\n";
		foreach ($t as $v) {
			$alters .= "ALTER TABLE `{$v}` ADD UNIQUE KEY `{$v}_uq` (";
			$alters .= implode(", ", $tabelas[$v]);
			$alters .= ");\n";
		}
	}

	return $alters;
}

function registrartUQs ($uqs, $db=DBNAME)
{
	$alters = converterUQs($uqs);
	escrever(ARQUIVOS_EFEMEROS."/db/ddl/uniques-{$db}.sql", $alters, true);
}
