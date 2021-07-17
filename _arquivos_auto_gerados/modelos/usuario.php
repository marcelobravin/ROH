<?php
		/**
			 * usuario
			 * @package grimoire/modelos
			 * @version 16-07-2021 22:07:14
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
				"Field"		=> "login",
				"Type"		=> "char(60)",
				"Null"		=> "NO",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> ""
			);
		
			$campos[2] = array(
				"Field"		=> "senha",
				"Type"		=> "char(60)",
				"Null"		=> "NO",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> ""
			);
		
			$campos[3] = array(
				"Field"		=> "email_confirmado",
				"Type"		=> "tinyint(1)",
				"Null"		=> "NO",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> ""
			);
		
			$campos[4] = array(
				"Field"		=> "token",
				"Type"		=> "varchar(255)",
				"Null"		=> "YES",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> ""
			);
		
			$campos[5] = array(
				"Field"		=> "ativo",
				"Type"		=> "tinyint(1)",
				"Null"		=> "YES",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> ""
			);
		
			$campos[6] = array(
				"Field"		=> "reset",
				"Type"		=> "varchar(50)",
				"Null"		=> "YES",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> ""
			);
		
			$campos[7] = array(
				"Field"		=> "telefone",
				"Type"		=> "varchar(15)",
				"Null"		=> "YES",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> ""
			);
		
			$campos[8] = array(
				"Field"		=> "nome",
				"Type"		=> "varchar(255)",
				"Null"		=> "YES",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> ""
			);
		
			$campos[9] = array(
				"Field"		=> "endereco",
				"Type"		=> "varchar(255)",
				"Null"		=> "YES",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> ""
			);
		
			$campos[10] = array(
				"Field"		=> "cpf",
				"Type"		=> "varchar(14)",
				"Null"		=> "NO",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> ""
			);
		
			$campos[11] = array(
				"Field"		=> "criado_em",
				"Type"		=> "datetime",
				"Null"		=> "NO",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> ""
			);
		
			$campos[12] = array(
				"Field"		=> "atualizado_em",
				"Type"		=> "datetime",
				"Null"		=> "YES",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> ""
			);
		
			$campos[13] = array(
				"Field"		=> "excluido_em",
				"Type"		=> "datetime",
				"Null"		=> "YES",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> ""
			);
		
			$campos[14] = array(
				"Field"		=> "criado_por",
				"Type"		=> "int(11)",
				"Null"		=> "NO",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> ""
			);
		
			$campos[15] = array(
				"Field"		=> "atualizado_por",
				"Type"		=> "int(11)",
				"Null"		=> "YES",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> ""
			);
		
			$campos[16] = array(
				"Field"		=> "excluido_por",
				"Type"		=> "int(11)",
				"Null"		=> "YES",
				"Key"		=> "",
				"Default"	=> "",
				"Extra"		=> ""
			);
		
		$sql = montarCriacao($tabela, $campos);
		executar($sql);
	