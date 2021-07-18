<?php
		/**
			 * _log_acesso
			 * @package grimoire/modelos
			 * @version 18-07-2021 13:21:40
		*/

		$tabela = limparNomeArquivo(__FILE__);
		$campos = array();
		
			$campos[0] = array(
				"Field"		=> "id",
				"Type"		=> "int(11)",
				"Null"		=> "NO",
				"Key"		=> "PRI",
				"Default"	=> "",
				"Extra"		=> "auto_increment"
			);
		
			$campos[1] = array(
				"Field"		=> "usuarioId",
				"Type"		=> "int(11)",
				"Null"		=> "NO",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> ""
			);
		
			$campos[2] = array(
				"Field"		=> "sucesso",
				"Type"		=> "tinyint(1)",
				"Null"		=> "NO",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> ""
			);
		
			$campos[3] = array(
				"Field"		=> "ip",
				"Type"		=> "varchar(15)",
				"Null"		=> "NO",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> ""
			);
		
			$campos[4] = array(
				"Field"		=> "navegador",
				"Type"		=> "varchar(400)",
				"Null"		=> "NO",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> ""
			);
		
			$campos[5] = array(
				"Field"		=> "datahora",
				"Type"		=> "timestamp",
				"Null"		=> "NO",
				"Key"		=> "",
				"Default"	=> "current_timestamp()",
				"Extra"		=> ""
			);
		
		$sql = montarCriacao($tabela, $campos);
		executar($sql);
	