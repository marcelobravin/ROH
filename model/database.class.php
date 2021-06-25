<?php
require_once ROOT.'model/connection.class.php';
require_once ROOT.'model/queryBuilder.class.php';
// require '../../config.php';

class Database extends Connection {

	public function __construct () {
		parent::__construct(
			getenv('HOST'),
			getenv('DBNAME'),
			getenv('USER'),
			getenv('PASSWORD')
		);
	}

	function registrarLog ($acao, $tabela, $objetoId) {

		$values = array(
			'usuarioId'	=> $_SESSION['user']['id'],
			'acao'		=> $acao,
			'tabela'	=> $tabela,
			'objetoId'	=> $objetoId
			// 'ip'		=> $x
		);
		$this->inserir('_log_operacoes', $values, false);
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
	function executarStmt ($sql, $valores, $processo="U/D", $transacao=false) {

		try {
			$statement = parent::getConnection()->prepare($sql);
			$interrogacoes = substr_count($sql, '?');

			$valores = array_values($valores);

			for ($i=0; $i<$interrogacoes; $i++) {
				$statement->bindParam($i+1, $valores[$i]); // dá pra colocar verificação por tipo e tamanho // https://www.php.net/manual/pt_BR/pdo.constants.php
			}
			$statement->execute($valores);

			switch ( $processo ) {
				case 'I': $retorno = parent::getConnection()->lastInsertId(); #- INSERT
					break;
				case 'S': $retorno = $statement->fetchAll(PDO::FETCH_ASSOC); #-- SELECT
					break;
				default : $retorno = $statement->rowCount(); #------------------ UPDATE/DELETE
			}

			if ( !$transacao ) {
				$statement->closeCursor();
				$statement = null;
				# fechar conexao
			}

			return $retorno;

		} catch (PDOException $e) {
			throw new Exception( $e->getMessage() );
		}
	}

	// namespace '/sjdklasjdl';
	/*
	$values = array(
		'login' => $_POST['login'],
		'senha' => hashPassword($_POST['senha'])
	);
	echo "Inserido registro número:". inserir('usuarios', $values);
	//*/
	function inserir ($tabela, $campos) {
		$qb = new QueryBuilder();

		try {
			$stmt = $qb->insercaoStmt($tabela, $campos);
			return $this->executarStmt($stmt, $campos, 'I');
		} catch (PDOException $e) {
			throw new Exception( $e->getMessage() );
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/*
	$condicoes = array(
		'login' => $_POST['login']
		, 'senha' => hashPassword($_POST['senha'])
	);
	$user = selecionar('usuarios', $condicoes);
	p($user);
	//*/
	function selecionar ($tabela, $condicoes=array(), $diretrizes="", $colunas="*") {
		$qb = new QueryBuilder();
		$stmt = $qb->selecaoStmt($tabela, $condicoes, $diretrizes, $colunas);
		return $this->executarStmt($stmt, $condicoes, 'S');
	}

	/*
	$campos = array(
		'login' => 'Joel',
		'senha' => 'senha'
	);
	$condicoes = array(
		'id'   => 56
		// ,
		// 'login'=> 'joe'
	);
	echo "Registros alterados: ". atualizar('usuarios', $campos, $condicoes);
	//*/
	function atualizar ($tabela, $campos, $condicoes) {
		$qb = new QueryBuilder();
		$stmt = $qb->atualizacaoStmt($tabela, $campos, $condicoes);

		$condicoes = array_values($condicoes);
		foreach ($condicoes as $indice => $valor) {
			$campos[] = $valor;
		}

		return $this->executarStmt($stmt, $campos);
	}

	/*
	$condicoes = array(
		// 'id'   => 51
		'login'=> 'joel'
	);
	echo "Registros excluídos: ". excluir('usuarios', $condicoes);
	//*/
	function excluir ($tabela, $condicoes) {
		$qb = new QueryBuilder();
		$stmt = $qb->exclusaoStmt($tabela, $condicoes);
		return $this->executarStmt($stmt, $condicoes);
	}

	/**
	 * Gera arquivos para recriação do BD
	 * @version 24-06-2021
	 *
	 * @param   string
	 *
	 * @uses    persistencia.php->listarTabelas()
	 * @uses    persistencia.php->descreverTabela()
	 * @uses    acesso.php->gerarModelo()
	 * @uses    acesso.php->gerarInserts()
	 *
	 * @todo    retornar confirmação de arquivos criados
	 * @todo    opcao para definir se e quais inserts serão gerados
	 */
	function mapeamentoRelacional ($dbname) {

		$sql = "SHOW FULL TABLES FROM ". $dbname;
		$tabs = $this->executarStmt($sql, array(), 'S');

		foreach ($tabs as $key => $value) {
			$d = $this->descreverTabela($value['Tables_in_'. $dbname]);
			$this->gerarModelo($value['Tables_in_'. $dbname], $d);

			$this->gerarInserts($value['Tables_in_'. $dbname]);
		}
		return true;
	}

	/**
	 * Retorna os campos de uma tabela
	 *
	 * @param   string
	 * @param   null/string
	 * @return  array
	 *
	 * @uses    persistencia.php->executar()
	 * @example
		$descricao = descreverTabela("tabela");
	*/
	function descreverTabela($tabela, $banco=null) {

		if ( is_null($banco) ) {
			$sql = "SHOW COLUMNS FROM $tabela";
			} else {
			$sql = "SHOW COLUMNS FROM $tabela FROM $banco";
		}

		return $this->executarStmt($sql, array(), 'S');
	}

	/**
	 * Gera arquivo para recriação da tabela
	 * @package grimoire/bibliotecas/arquivos.php
	 * @version 05-07-2015
	 *
	 * @param   string
	 * @param   array
	 *
	 * @uses    tempo.php->agora()
	 * @uses    arquivos.php->escrever()
	 */
	function gerarModelo($nome, $descricao, $diretorioDestino='/opt/lampp/htdocs/ROH/_arquivos_auto_gerados/modelos') {
		$campos = '';
		foreach ($descricao as $key => $value) {
			$campos .= '
				$campos['. $key .'] = array(
					"Field"   => "'. $value['Field'] .'",
					"Type"    => "'. $value['Type'] .'",
					"Null"    => "'. $value['Null'] .'",
					"Key"     => "'. $value['Key'] .'",
					"Default" => "'. $value['Default'] .'",
					"Extra"   => "'. $value['Extra'] .'"
				);
			';
		}

		$conteudo = '<?php
			/**
			 * '. $nome .'
			 * @package grimoire/modelos
			 * @version '. date("d-m-Y H:i:s") .'
			 */

			$tabela = limparNomeArquivo(__FILE__);
			'. $campos .'
			$sql = montarCriacao($tabela, $campos);
			executar($sql);
		';

		$this->escrever($diretorioDestino."/{$nome}.php", $conteudo, true);
	}

	/**
	 * Gera arquivo com os registros da tabela
	 * @package grimoire/bibliotecas/persistencia.php
	 * @since 05-07-2015
	 * @version 24-06-2021
	 *
	 * @param   string
	 *
	 * @uses    persistencia.php->executar()
	 * @uses    sql.php->insercao()
	 * @uses    GRIMOIRE."modelos/registros/"
	 */
	function gerarInserts($tabela, $diretorioDestino='/opt/lampp/htdocs/ROH/_arquivos_auto_gerados/modelos') {
		// $sql = $this->selecionar($tabela);
		$registros = $this->selecionar($tabela);
		$inserts = "";

		foreach ($registros as $key => $value) {
			$value = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $value);
			$inserts .= $this->insercao($tabela, $value);
			$inserts .= ";\n";
		}

		$this->escrever( $diretorioDestino. "/{$tabela}.sql", $inserts, true);
	}

	/**
	 * Escreve o conteúdo em um arquivo
	 *
	 * IMPORTANTE: Talvez seja necessário colocar 775 nos diretorios
	 *
	 * @package grimoire/bibliotecas/arquivos.php
	 * @since 05-07-2015
	 * @version 24-06-2021
	 *
	 * @param   string
	 * @param   string
	 * @param   bool    Conservar conteúdo, append
	 * @return  bool
	 *
	 * @example
		echo escrever("arquivo.txt", "pan");
	*/
	function escrever($arquivo, $conteudo, $sobreescrever=false) {

		if ( !$sobreescrever ) {
			if ( file_exists($arquivo) )
				$conteudo = file_get_contents($arquivo) . $conteudo;
		}
		file_put_contents($arquivo, $conteudo);
	}

	/**
	 * Insere um registro na tabela
	 * @package grimoire/bibliotecas/sql.php
	 * @version 05-07-2015
	 *
	 * @param   string
	 * @param   array/string
	 * @return  string
	 *
	 * @uses    persistencia.php->executar()
	 * @example
		//echo $sql = montarInsercao("usuarios", array("nome"=>"jose"));
	*/
	function insercao($tabela, $campos) {
		$sql       = "";
		$valores   = array();
		$atributos = array();

		if (is_array($campos)) {
			foreach ($campos as $indice => $valor) {
				$valor = str_replace("'", "&apos;", $valor);
				if (is_array($valor)) {
					$temp  = insercao($valor, $indice, $tabela);
					$sql[] = $temp[0];
				} else if (!is_numeric($indice)) {
					$atributos[] = "`$indice`";
					$valores[]   = "'$valor'";
				}
			}
		}

		$atributos = implode(", ", $atributos);
		$valores   = implode(", ", $valores);
		$sql     = "INSERT INTO `$tabela` ($atributos) VALUES ($valores)";

		return $sql;
	}

}
