<?php
		/**
		 * usuario
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
				"Field"		=> "login",
				"Type"		=> "char(60)",
				"Null"		=> "NO",
				"Key"		=> "UNI",
				"Default"	=> "",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
			$campos[2] = array(
				"Field"		=> "senha",
				"Type"		=> "char(60)",
				"Null"		=> "NO",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
			$campos[3] = array(
				"Field"		=> "email_confirmado",
				"Type"		=> "tinyint(1)",
				"Null"		=> "NO",
				"Key"		=> "",
				"Default"	=> "0",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
			$campos[4] = array(
				"Field"		=> "token",
				"Type"		=> "varchar(255)",
				"Null"		=> "YES",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
			$campos[5] = array(
				"Field"		=> "ativo",
				"Type"		=> "tinyint(1)",
				"Null"		=> "YES",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
			$campos[6] = array(
				"Field"		=> "reset",
				"Type"		=> "varchar(50)",
				"Null"		=> "YES",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
			$campos[7] = array(
				"Field"		=> "telefone",
				"Type"		=> "varchar(15)",
				"Null"		=> "YES",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
			$campos[8] = array(
				"Field"		=> "nome",
				"Type"		=> "varchar(255)",
				"Null"		=> "YES",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
			$campos[9] = array(
				"Field"		=> "endereco",
				"Type"		=> "varchar(255)",
				"Null"		=> "YES",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
			$campos[10] = array(
				"Field"		=> "cpf",
				"Type"		=> "varchar(14)",
				"Null"		=> "NO",
				"Key"		=> "UNI",
				"Default"	=> "",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
			$campos[11] = array(
				"Field"		=> "criado_em",
				"Type"		=> "datetime",
				"Null"		=> "NO",
				"Key"		=> "",
				"Default"	=> "current_timestamp()",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
			$campos[12] = array(
				"Field"		=> "atualizado_em",
				"Type"		=> "datetime",
				"Null"		=> "YES",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> "on update current_timestamp()",
				"Comment"	=> ""
			);
		
			$campos[13] = array(
				"Field"		=> "excluido_em",
				"Type"		=> "datetime",
				"Null"		=> "YES",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
			$campos[14] = array(
				"Field"		=> "criado_por",
				"Type"		=> "int(11)",
				"Null"		=> "NO",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
			$campos[15] = array(
				"Field"		=> "atualizado_por",
				"Type"		=> "int(11)",
				"Null"		=> "YES",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
			$campos[16] = array(
				"Field"		=> "excluido_por",
				"Type"		=> "int(11)",
				"Null"		=> "YES",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> "",
				"Comment"	=> ""
			);
		
	