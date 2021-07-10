<?php
		/**
			* _log_acesso
			* @package grimoire/modelos
			* @version 10-07-2021 16:45:01
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
				"Extra"		=> "on update current_timestamp()"
			);
		
		$sql = montarCriacao($tabela, $campos);
		executar($sql);
	