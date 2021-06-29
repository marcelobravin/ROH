<?php
			/**
			 * _log_operacoes
			 * @package grimoire/modelos
			 * @version 29-06-2021 09:15:29
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
					"Field"   => "acao",
					"Type"    => "char(1)",
					"Null"    => "NO",
					"Key"     => "",
					"Default" => "",
					"Extra"   => ""
				);
			
				$campos[3] = array(
					"Field"   => "tabela",
					"Type"    => "varchar(50)",
					"Null"    => "NO",
					"Key"     => "",
					"Default" => "",
					"Extra"   => ""
				);
			
				$campos[4] = array(
					"Field"   => "objetoId",
					"Type"    => "int(11)",
					"Null"    => "NO",
					"Key"     => "",
					"Default" => "",
					"Extra"   => ""
				);
			
				$campos[5] = array(
					"Field"   => "ip",
					"Type"    => "varchar(15)",
					"Null"    => "YES",
					"Key"     => "",
					"Default" => "",
					"Extra"   => ""
				);
			
				$campos[6] = array(
					"Field"   => "datahora",
					"Type"    => "timestamp",
					"Null"    => "NO",
					"Key"     => "",
					"Default" => "current_timestamp()",
					"Extra"   => "on update current_timestamp()"
				);
			
			$sql = montarCriacao($tabela, $campos);
			executar($sql);
		