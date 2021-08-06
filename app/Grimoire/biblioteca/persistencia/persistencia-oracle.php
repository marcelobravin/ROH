<?php
/**
 * Biblioteca de expressões regulares
 * @package grimoire/bibliotecas
*/

/**
 * Retorna o navegador do usuário
 * @package grimoire/bibliotecas/persistencia-oracle.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	bool
 */
function contemAcesso($usuario, $url){
	$conexao = conectar();

	$sql = "select *
				from usuario_aplicacao	ua
					, aplicacao					ap
					, usuario						u
			where ua.cd_aplicacao		= ap.cd_aplicacao
				and ua.cd_usuario			= u.cd_usuario
				and u.nm_usuario				= :USUARIO
				and ap.ds_url_aplicacao = :URL";

	$stmt = oci_parse($conexao, $sql);
	oci_bind_by_name($stmt, 'USUARIO', $usuario, 20, SQLT_CHR);
	oci_bind_by_name($stmt, 'URL', $url, 4000, SQLT_CHR);

	if(oci_execute($stmt) && oci_fetch_all($stmt, $result) > 0){
		return TRUE;
	}

	return FALSE;
}

/**
 * Retorna o navegador do usuário
 * @package grimoire/bibliotecas/persistencia-oracle.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	bool
 *
 * @uses		$_SERVER
 */
function executar($sql) {
	$cConexao = conectar();
	$statement = oci_parse($cConexao, $sql);

	oci_execute($statement, OCI_NO_AUTO_COMMIT);
	$resposta = array();
	while ( $rows = oci_fetch_assoc($statement)) {
		$resposta[] = $rows;
	}

	oci_close($cConexao);

	return $resposta;
}

/**
 * Retorna o navegador do usuário
 * @package grimoire/bibliotecas/persistencia-oracle.php
 * @version 06-07-2015
 *
 * @param	string
 * @return	bool
 *
 * @uses		$_SERVER
	$x = selecionar("vestibular_ciee", "EMAIL='marcelo.bravin@gmail.com'");
	exibir($x);
 */
function selecionar($tabela, $criterios="", $diretrizes=null, $campos=null) {
	$sql = selecao(PREFIXO_TABELAS . $tabela, $criterios, $diretrizes, $campos);
	$cConexao = conectar();
	$statement = oci_parse($cConexao, $sql);

	oci_execute($statement, OCI_NO_AUTO_COMMIT);
	$resposta = array();
	while ( $rows = oci_fetch_assoc($statement)) {
		$resposta[] = $rows;
	}

	oci_close($cConexao);

	if ( count($resposta)==1 ) {
		$resposta = $resposta[0];
	}

	return $resposta;
}

/**
 * Retorna o navegador do usuário
 * @package grimoire/bibliotecas/persistencia-oracle.php
 * @version 06-07-2015
 *
 * @param	string
 * @return	bool
 *
 * @uses		$_SERVER
	$x = listar("vestibular_ciee");
	exibir($x);
 */
function listar($tabela, $criterios="", $diretrizes=null, $campos=null) {
	$sql = selecao(PREFIXO_TABELAS . $tabela, $criterios, $diretrizes, $campos);
	$cConexao = conectar();
	$statement = oci_parse($cConexao, $sql);

	oci_execute($statement, OCI_NO_AUTO_COMMIT);
	$resposta = array();
	while ( $rows = oci_fetch_assoc($statement)) {
		$resposta[] = $rows;
	}

	oci_close($cConexao);

	return $resposta;
}

/**
 * Retorna o navegador do usuário
 * @package grimoire/bibliotecas/persistencia-oracle.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	bool
 *
 * @uses		$_SERVER
	$x = selecionar("vestibular_ciee", "EMAIL='a@a'");
	exibir( $x );
	$x['TREINEIRO'] = 'N';
	unset($x['EMAIL']);

	$resposta = atualizar("vestibular_ciee", $x, "EMAIL='a@a'");
	exibir( $resposta );
 */
function atualizar($tabela, $objeto, $condicao="") {
	$sql = atualizacao(PREFIXO_TABELAS . $tabela, $objeto, $condicao);
	$cConexao = conectar();
	$statement = oci_parse($cConexao, $sql);

	if ( oci_execute($statement, OCI_NO_AUTO_COMMIT) ) {
		oci_commit($cConexao);
		$resposta = array(
			"status" => "OK",
			"msg" => "Registro atualizado com sucesso!"
		);
	} else {
		oci_rollback($cConexao);
		$resposta = array(
			"status" => "ERRO",
			"msg" => utf8_encode("Erro ao atualizar o registro!")
		);
	}

	$json = json_encode($resposta);
	$cConexao = null;
	return $json;
}

/**
 * Retorna o navegador do usuário
 * @package grimoire/bibliotecas/persistencia-oracle.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	bool
 *
 * @uses		$_SERVER
	$post = array(
			'RG' => '1234567890',
			'EMAIL' => 'marcelo.bravin@gmail.com',
			'CELULAR' => '123',
			'TELEFONE' => '123',
			'CAMPUS' => 'SP',
			'CURSO_SV' => '4983',
			'DATA_PROVA' => '24-JUN-15',
			'NUM_INSCRICAO' => '0123456',
			'TREINEIRO' => 'N',
			'SYSDATE_LOG' => '29-MAY-15',
			'HORARIO' => '0830',
			'IDT_TIPO_PROVA' => 'E',
			'IDT_FORMULARIO' => 'PROVA_ELETRONICA'
	);
	$resposta = inserir('vestibular_ciee', $post);
	exibir($reposta);
 */
function inserir($tabela, $campos) {
	$sql = insercao(PREFIXO_TABELAS . $tabela, $campos);
	$sql = str_replace("`", "", $sql); # Correção para ORACLE
	$cConexao = conectar();
	$statement = oci_parse($cConexao, $sql);

	if ( oci_execute($statement, OCI_NO_AUTO_COMMIT) ) {
		oci_commit($cConexao);

		$resposta = selecionar($tabela, "", "", "MAX(ID)");
	} else {
		oci_rollback($cConexao);
		$resposta = array(
			"status" => "ERRO",
			"msg" => utf8_encode("Erro ao inserir o registro!")
		);
	}

	$cConexao = null;
	return $resposta;
}

/**
 * Retorna o navegador do usuário
 * @package grimoire/bibliotecas/persistencia-oracle.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	bool
 *
 * @uses		$_SERVER
	excluir("tabela");
	echo excluir("vestibular_ciee", "EMAIL='marcelo.bravin@gmail.com'");
 */
function excluir($tabela, $condicao) {

	echo $sql = exclusao(PREFIXO_TABELAS . $tabela, $condicao);
	$cConexao = conectar();
	$statement = oci_parse($cConexao, $sql);

	if ( oci_execute($statement, OCI_NO_AUTO_COMMIT) ) {
		oci_commit($cConexao);
		$resposta = array(
			"status" => "OK",
			"msg" => "Registro excluído com sucesso!"
		);
	} else {
		oci_rollback($cConexao);
		$resposta = array(
			"status" => "ERRO",
			"msg" => utf8_encode("Erro ao excluir o registro!")
		);
	}

	$json = json_encode($resposta);
	$cConexao = null;
	return $json;
}

/**
 * Retorna o navegador do usuário
 * @package grimoire/bibliotecas/persistencia-oracle.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	bool
 *
 * @uses		$_SERVER
	$banco = visualizarBanco();
	exibir($banco);
 */
function visualizarBanco() {
	$tabelas = listarTabelas();
	foreach ($tabelas as $value) {
		$colunas = listarColunas($value['TABLE_NAME']);
	}
	return array(
		'tabelas' => $tabelas,
		'colunas' => $colunas
	);
}

/**
 * Retorna uma lista de tabelas do BD
 * @package grimoire/bibliotecas/persistencia-oracle.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	array
 *
 * @uses		$_SERVER
	$tabelas = listarTabelas();
	exibir($tabelas);
 */
function listarTabelas($campos="*") {
	$sql = "SELECT {$campos} FROM all_tables";
	return executar($sql);
}

/**
 * Retorna o navegador do usuário
 * @package grimoire/bibliotecas/persistencia-oracle.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	bool
 *
 * @uses		$_SERVER
	$colunas = listarColunas('VESTIBULAR_CIEE');
	exibir($colunas);
 */
function listarColunas($tabela, $campos="*") {
	$sql = "SELECT {$campos} FROM user_tab_cols WHERE table_name = '{$tabela}'";
	return executar($sql);
}
