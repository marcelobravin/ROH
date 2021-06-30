<?php
			/**
			 * usuarios
			 * @package grimoire/modelos
			 * @version 30-06-2021 12:44:42
			 */

			$tabela = limparNomeArquivo(__FILE__);
			
				$campos[0] = array(
					"Field"   => "id",
					"Type"    => "int(11)",
					"Null"    => "NO",
					"Key"     => "PRI",
					"Default" => "",
					"Extra"   => "auto_increment"
				);
			
				$campos[1] = array(
					"Field"   => "login",
					"Type"    => "char(60)",
					"Null"    => "NO",
					"Key"     => "",
					"Default" => "",
					"Extra"   => ""
				);
			
				$campos[2] = array(
					"Field"   => "senha",
					"Type"    => "char(60)",
					"Null"    => "NO",
					"Key"     => "",
					"Default" => "",
					"Extra"   => ""
				);
			
				$campos[3] = array(
					"Field"   => "email_confirmado",
					"Type"    => "tinyint(1)",
					"Null"    => "NO",
					"Key"     => "",
					"Default" => "",
					"Extra"   => ""
				);
			
				$campos[4] = array(
					"Field"   => "token",
					"Type"    => "varchar(255)",
					"Null"    => "YES",
					"Key"     => "",
					"Default" => "",
					"Extra"   => ""
				);
			
				$campos[5] = array(
					"Field"   => "ativo",
					"Type"    => "tinyint(1)",
					"Null"    => "NO",
					"Key"     => "",
					"Default" => "",
					"Extra"   => ""
				);
			
				$campos[6] = array(
					"Field"   => "reset",
					"Type"    => "varchar(50)",
					"Null"    => "YES",
					"Key"     => "",
					"Default" => "",
					"Extra"   => ""
				);
			
				$campos[7] = array(
					"Field"   => "criado_em",
					"Type"    => "timestamp",
					"Null"    => "NO",
					"Key"     => "",
					"Default" => "current_timestamp()",
					"Extra"   => "on update current_timestamp()"
				);
			
				$campos[8] = array(
					"Field"   => "atualizado_em",
					"Type"    => "timestamp",
					"Null"    => "NO",
					"Key"     => "",
					"Default" => "0000-00-00 00:00:00",
					"Extra"   => ""
				);
			
			$sql = montarCriacao($tabela, $campos);
			executar($sql);
		