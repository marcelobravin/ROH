<?php
	/**
		* resultado
		* @package grimoire/modelos
		* @version 07-07-2021 07:37:38
	*/

	$tabela = limparNomeArquivo(__FILE__);
	
		$campos[0] = array(
			"Field"		=> "id",
			"Type"		=> "int(11)",
			"Null"		=> "NO",
			"Key"		=> "PRI",
			"Default"	=> "",
			"Extra"		=> "auto_increment"
		);
	
		$campos[1] = array(
			"Field"		=> "meta_id",
			"Type"		=> "int(11)",
			"Null"		=> "NO",
			"Key"		=> "",
			"Default"	=> "",
			"Extra"		=> ""
		);
	
		$campos[2] = array(
			"Field"		=> "resultado",
			"Type"		=> "int(3)",
			"Null"		=> "NO",
			"Key"		=> "",
			"Default"	=> "",
			"Extra"		=> ""
		);
	
		$campos[3] = array(
			"Field"		=> "justificativa",
			"Type"		=> "text",
			"Null"		=> "YES",
			"Key"		=> "",
			"Default"	=> "",
			"Extra"		=> ""
		);
	
		$campos[4] = array(
			"Field"		=> "justificativa_aceita",
			"Type"		=> "tinyint(1)",
			"Null"		=> "NO",
			"Key"		=> "",
			"Default"	=> "0",
			"Extra"		=> ""
		);
	
		$campos[5] = array(
			"Field"		=> "criado_em",
			"Type"		=> "datetime",
			"Null"		=> "NO",
			"Key"		=> "",
			"Default"	=> "current_timestamp()",
			"Extra"		=> ""
		);
	
		$campos[6] = array(
			"Field"		=> "criado_por",
			"Type"		=> "int(11)",
			"Null"		=> "NO",
			"Key"		=> "",
			"Default"	=> "",
			"Extra"		=> ""
		);
	
	$sql = montarCriacao($tabela, $campos);
	executar($sql);
	