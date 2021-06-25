<?php
			/**
			 * _log_acesso
			 * @package grimoire/modelos
			 * @version 25-06-2021 10:51:23
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
					"Field"   => "usuarioId",
					"Type"    => "int(11)",
					"Null"    => "NO",
					"Key"     => "",
					"Default" => "",
					"Extra"   => ""
				);
			
				$campos[2] = array(
					"Field"   => "sucesso",
					"Type"    => "bit(1)",
					"Null"    => "NO",
					"Key"     => "",
					"Default" => "",
					"Extra"   => ""
				);
			
				$campos[3] = array(
					"Field"   => "ip",
					"Type"    => "varchar(15)",
					"Null"    => "YES",
					"Key"     => "",
					"Default" => "",
					"Extra"   => ""
				);
			
				$campos[4] = array(
					"Field"   => "navegador",
					"Type"    => "varchar(400)",
					"Null"    => "NO",
					"Key"     => "",
					"Default" => "",
					"Extra"   => ""
				);
			
				$campos[5] = array(
					"Field"   => "datahora",
					"Type"    => "timestamp",
					"Null"    => "NO",
					"Key"     => "",
					"Default" => "current_timestamp()",
					"Extra"   => "on update current_timestamp()"
				);
			
			$sql = montarCriacao($tabela, $campos);
			executar($sql);
		