<?php
		/**
		 * resultado
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
				"Field"		=> "id_meta",
				"Type"		=> "int(11)",
				"Null"		=> "NO",
				"Key"		=> "MUL",
				"Default"	=> "",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
			$campos[2] = array(
				"Field"		=> "resultado",
				"Type"		=> "int(3)",
				"Null"		=> "NO",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
			$campos[3] = array(
				"Field"		=> "mes",
				"Type"		=> "tinyint(2)",
				"Null"		=> "NO",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
			$campos[4] = array(
				"Field"		=> "ano",
				"Type"		=> "int(4)",
				"Null"		=> "NO",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
			$campos[5] = array(
				"Field"		=> "justificativa",
				"Type"		=> "text",
				"Null"		=> "YES",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
			$campos[6] = array(
				"Field"		=> "justificativa_aceita",
				"Type"		=> "tinyint(1)",
				"Null"		=> "NO",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
			$campos[7] = array(
				"Field"		=> "criado_em",
				"Type"		=> "datetime",
				"Null"		=> "NO",
				"Key"		=> "",
				"Default"	=> "current_timestamp()",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
			$campos[8] = array(
				"Field"		=> "criado_por",
				"Type"		=> "int(11)",
				"Null"		=> "NO",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
	