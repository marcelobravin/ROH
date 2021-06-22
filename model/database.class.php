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
	function executarStmt ($stmt, $valores, $processo="U/D", $transacao=false) {

		try {
			$statement = parent::getConnection()->prepare($stmt);
			$interrogacoes = substr_count($stmt, '?');

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
	function selecionar ($tabela, $condicoes, $diretrizes="", $colunas="*") {
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
	function atualizar ($tabela, $campos, $condicoes="") {
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
	function excluir ($tabela, $condicoes="") {
		$qb = new QueryBuilder();
		$stmt = $qb->exclusaoStmt($tabela, $condicoes);
		return $this->executarStmt($stmt, $condicoes);
	}

}
