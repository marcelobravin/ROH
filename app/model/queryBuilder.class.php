<?php
require_once 'connection.class.php';

class QueryBuilder {

	/**
	 * Monta query para inserção de registros
	 * @package grimoire/bibliotecas/sql.php
	 * @since	05-07-2015
	 * @version 10-06-2021
	 *
	 * @param   string
	 * @param   array/string
	 * @return  string
	 *
	 * @uses    persistencia.php->executar()
	 * @example
		echo $sql = insercaoStmt("usuarios", array("nome"=>"jose"));
	*/
	function insercaoStmt ($tabela, $campos) {
		$sql		= "";
		$valores	= array();
		$atributos	= array();

		if ( is_array($campos) ) {
			foreach ($campos as $indice => $valor) {
				$atributos[] = "`$indice`";
				$valores[]   = "?";
			}
		}

		$atributos	= implode(", ", $atributos);
		$valores	= implode(", ", $valores);
		$sql		= "INSERT INTO `$tabela` ($atributos) VALUES ($valores)";

		return $sql;
	}

	/**
	 * Monta query com prepared statement para seleção de registros
	 * @package	grimoire/bibliotecas/sql.php
	 * @since	05-07-2015
	 * @version	10-06-2021
	 *
	 * @param	string				nome da tabela onde será realizada a busca
	 * @param	string/array/int	criterios de busca da consulta
	 * @param	null/string			diretrizes complementares
	 * @param	string				campos que serão retornados
	 * @return	string				query de seleção
	 *
	 * @example
		echo $sql = montarSelecao("tabela");
		echo $sql = montarSelecao("tabela", "nome='ze' AND sobrenome='maluco'");
		echo $sql = montarSelecao("tabela", "nome='ze' OR sobrenome='maluco'", "LIMIT1", "nome");
	*/
	function selecaoStmt ($tabela, $criterios="", $diretrizes="", $colunas="*") {

		$sql = "SELECT $colunas FROM $tabela";

		if ( !empty($criterios) ) {
			$sql .= " WHERE ";
			if (is_array($criterios))			$sql .= implode("=? AND ", array_keys($criterios)) ."=?";
			else if (is_numeric($criterios))	$sql .= "id=?"; # -------------- PK da tabela deve chamar id
			else								$sql .= $criterios;# <<<<<<<<<<< VERIFICAR linha abaixo quanto a binds
		}

		if ( strlen($diretrizes) > 0 )			$sql .= " $diretrizes";

		return $sql;
	}

	/**
	 * Monta query com prepared statement para atualização de registros
	 *
	 * @package	grimoire/bibliotecas/sql.php
	 * @since	05-07-2015
	 * @version	11-06-2021
	 *
	 * @param	string
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
	function atualizacaoStmt ($tabela, $campos, $condicoes="") {

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

		$sql .=  implode(", ", $x);

		if ( is_array($condicoes) ) {
			foreach ($condicoes as $indice => $valor) {
				$y[] = "$indice=?\n";
			}
		} else {
			$y = $condicoes;
		}

		if ( !empty($condicoes) )
			$sql .= "WHERE\n". implode(" AND ", $y);

		return $sql;
	}

	/**
	 * Monta query com prepared statement para exclusão de registros
	 *
	 * @package	grimoire/bibliotecas/sql.php
	 * @since	05-07-2015
	 * @version	11-06-2021
	 *
	 * @param	string
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
	function exclusaoStmt ($tabela, $condicoes="") {

		$sql = "DELETE FROM $tabela ";
		$y = array();

		if ( is_array($condicoes) ) {
			foreach ($condicoes as $indice => $valor) {
				$y[] = "$indice=?\n";
			}
		} else {
			$y = $condicoes;
		}

		if ( !empty($condicoes) )
			$sql .= "WHERE\n". implode(" AND ", $y);

		return $sql;
	}
}
