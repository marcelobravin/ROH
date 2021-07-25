<?php
		/**
		 * hospital
		 * @package	grimoire/modelos
		 * @version	25-07-2021 18:11:18
		*/
		
			$campos[0] = array(
				"Field"		=> "id",
				"Type"		=> "int(11)",
				"Null"		=> "NO",
				"Key"		=> "PRI",
				"Default"	=> "",
				"Extra"		=> "auto_increment",
				"Comment"	=> ""
			);
		
			$campos[1] = array(
				"Field"		=> "titulo",
				"Type"		=> "char(255)",
				"Null"		=> "NO",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
			$campos[2] = array(
				"Field"		=> "ativo",
				"Type"		=> "tinyint(1)",
				"Null"		=> "YES",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
			$campos[3] = array(
				"Field"		=> "criado_em",
				"Type"		=> "datetime",
				"Null"		=> "NO",
				"Key"		=> "",
				"Default"	=> "current_timestamp()",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
			$campos[4] = array(
				"Field"		=> "atualizado_em",
				"Type"		=> "datetime",
				"Null"		=> "YES",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> "on update current_timestamp()",
				"Comment"	=> ""
			);
		
			$campos[5] = array(
				"Field"		=> "excluido_em",
				"Type"		=> "datetime",
				"Null"		=> "YES",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
			$campos[6] = array(
				"Field"		=> "criado_por",
				"Type"		=> "int(11)",
				"Null"		=> "NO",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
			$campos[7] = array(
				"Field"		=> "atualizado_por",
				"Type"		=> "int(11)",
				"Null"		=> "YES",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
			$campos[8] = array(
				"Field"		=> "excluido_por",
				"Type"		=> "int(11)",
				"Null"		=> "YES",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
	