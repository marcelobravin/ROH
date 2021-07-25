<?php
/**
 * Criação de instruções SQL
 * @package grimoire/bibliotecas
*/

/**
 * Cria instrução sql para atualização de registros
 * @package grimoire/bibliotecas/sql.php
 * @version 27/10/2016 21:42:17
 *
 * @param	string
 * @return	bool
 *
 * @uses		persistencia.php->executar()
 * @uses		sql.php->atualizacao()
 * @example
		$usuario2 = array('id'=>'3', 'nome'=>'Décio Carvalho', 'email'=>'1@2', 'sexo'=>'masculino');
		exibir($sql = atualizacao("tb_usuarios", $usuario2));
		//echo $sql = atualizacao("tabela", array("nome"=>"Jose"), "id=1");
		//echo $sql = atualizacao("tabela", array("nome"=>"Jose"));
		//echo $sql = atualizacao("tabela", array("nome"=>"Jose"), 4);
 */
function atualizacao ($tabela, $objeto, $condicao="")
{
	$sql = array();
	$campos = "";

	if (is_array($objeto)) {
		$tamanho = sizeof($objeto);
		$i = 1;
		foreach ($objeto as $indice => $valor) {

			if (!is_array($valor)) {
				$campos .= "$indice='$valor'";
				// Adiciona separador após cada atributo que não seja o último
				if ($i < $tamanho)
					$campos .= ", \n";
			} else {
				$chavePrimaria = "id='{$valor['id']}'";
				$temp = atualizacao($valor, $indice, $chavePrimaria);
				$sql[] = $temp[0];
				$tamanho--;
			}
			$i++;
		}
	} else {
		$campos = $objeto;
	}

	if (!is_array($condicao)) {
		if ($condicao > 0) {
			$condicao = "id='$condicao'"; // Se for mandado número utiliza chave primária como condição
		} else {
			$condicao = "$condicao"; // Utilizastring como condição
		}
	} else {
		$a = $condicao;
		$condicao = "";
		$tamanho = sizeof($a);
		$i=1;

		foreach ($a as $indice => $valor) {
			$condicao .= "$indice='$valor'";
			// Adiciona separador após cada atributo que não seja o último
			if ($i < $tamanho) {
				$condicao .= " AND \n";
			}
			$i++;
		}
	}

	if (!empty($condicao)) {
		$sql[] = "UPDATE $tabela SET\n $campos \nWHERE\n $condicao";
	}
	else {
		$sql[] = "UPDATE $tabela SET\n $campos";
	}

	$sql = converterString($sql);
	return $sql;
}

/**
 * Verifica se o valor se encaixa no padrão
 * @package grimoire/bibliotecas/sql.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	bool
 *
 * @uses		persistencia.php->executar()
 * @example
		//$ids = array(3, 5, 7, 9);
		//$tabelas = array('usuario', 'endereco');
		//exibir(montarExclusao($tabelas, $ids)); // Excluir n objetos e seus relacionamentos
		//exibir(montarExclusao($tabelas, "4")); // Excluir 1 objeto e seus relacionamentos
		//echo $sql = montarExclusao($tabelas, null); // Limpar tabelas
		//echo $sql = montarExclusao("usuarios", null); // Limpar uma tabela
 */

function exclusao ($tabela, $criterios="")
{
	$sql = "DELETE FROM $tabela";

	if (!empty($criterios)) {
		$sql .= " WHERE ";
		if (is_array($criterios)) {
			$count = count($criterios);
			$i = 1;
			foreach ($criterios as $key => $value) {
				$sql .= "{$key}='{$value}'";
				if ($i<$count) {
					$sql .= " AND ";
				}
				$i++;
			}
		} else {
			if (is_numeric($criterios)) {
				$sql .= "id='$criterios'";
			} else {
				$sql .= "$criterios";
			}
		}
	}

	return $sql;
}

/**
 * Insere um registro na tabela
 * @package grimoire/bibliotecas/sql.php
 * @version 05-07-2015
 *
 * @param	string
 * @param	array/string
 * @return	string
 *
 * @uses		persistencia.php->executar()
 * @example
		//echo $sql = montarInsercao("usuarios", array("nome"=>"jose"));
 */
function insercao ($tabela, $campos)
{
	$sql			= "";
	$valores	= array();
	$atributos = array();

	if (is_array($campos)) {
		foreach ($campos as $indice => $valor) {
			$valor = str_replace("'", "&apos;", $valor);
			if (is_array($valor)) {
				$temp	= insercao($valor, $indice);
				$sql[] = $temp[0];
			} else if (!is_numeric($indice)) {
				$atributos[] = "`$indice`";
				$valores[]	= "'$valor'";
			}
		}
	}

	$atributos	= implode(", ", $atributos);
	$valores	= implode(", ", $valores);
	$sql		= "INSERT INTO `$tabela` ($atributos) VALUES ($valores)";

	return $sql;
}

/**
 * Seleciona registros
 * @package grimoire/bibliotecas/sql.php
 * @version 05-07-2015
 *
 * @param	string
 * @param	string/array
 * @param	null/string
 * @return	bool
 *
 * @uses		persistencia.php->executar()
 * @example
		echo $sql = montarSelecao("tabela");
		echo $sql = montarSelecao("tabela", "nome='ze' AND sobrenome='maluco'");
		echo $sql = montarSelecao("tabela", "nome='ze' OR sobrenome='maluco'", "LIMIT1", "nome");
 */
function selecao ($tabela, $criterios="", $diretrizes=null, $campos="*")
{
	$sql = "SELECT $campos FROM $tabela";

	if ( !empty($criterios) ) {
		$sql .= " WHERE ";
		if (is_array($criterios)) {
			$sql .= implode(" AND ", $criterios);
		} else {
			if (is_numeric($criterios)) {
				$sql .= "id='$criterios'";
			} else {
				$sql .= "$criterios";
			}
		}
	}

	if (strlen($diretrizes) > 0) {
		$sql .= " $diretrizes";
	}

	return $sql;
}

/**
 * monta SQL para registro de acesso ao sistema
 * @package grimoire/bibliotecas/acesso.php
 * @since	05-07-2015
 * @version	17-06-2021
 *
 * @param	string
 * @return	bool
 *
 * @uses	acesso.php->identificarIP()
 * @uses	persistencia.php->executar()
 * @example
	gravarLog(1, "U", "produto", 15);
	registrarOperacao("15", "C/R/U/D", "produto", "29");
 */
function registroDeAcesso ($usuarioId, $ip, $browser, $sucesso=true)
{
	$browser = json_encode($browser);
	return "INSERT INTO _log_acesso (usuarioId, sucesso, ip, navegador)
		VALUES ($usuarioId, $sucesso, '$ip', '$browser')
	";
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
function exclusaoLogica ($modulo, $id)
{
	$campos = array(
		'excluido_por'	=> $_SESSION['user']['id'],
		'excluido_em'	=> agora()
	);

	return atualizar($modulo, $campos, [ 'id'=>$id ]);
}

/**
 * monta SQL para registro de acesso ao sistema
 * @package grimoire/bibliotecas/acesso.php
 * @since	05-07-2015
 * @version	17-06-2021
 *
 * @param	string
 * @return	bool
 *
 * @uses	acesso.php->identificarIP()
 * @uses	persistencia.php->executar()
 * @example
	gravarLog(1, "U", "produto", 15);
	registrarOperacao("15", "C/R/U/D", "produto", "29");
 */
function criacaoFK ($tabelaAlterada, $tabelaReferenciada)
{
	$sql = "ALTER TABLE `{$tabelaAlterada}`
		ADD CONSTRAINT `fk_{$tabelaReferenciada}`
		FOREIGN KEY (id_{$tabelaReferenciada})
		REFERENCES {$tabelaReferenciada}(id)
			ON UPDATE CASCADE ON DELETE RESTRICT;";
	return $sql;
}
