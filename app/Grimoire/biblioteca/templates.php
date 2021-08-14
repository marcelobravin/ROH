<?php
/**
 * Criação de templates SQL, html, etc
 * @package grimoire/bibliotecas
 * @since 07/07/2021 12:37:48
 */

/**
 * @since 28/06/2021 09:50:48
 * @version 06/07/2021 08:31:37
 *
 * @example
 * {@link https://stackoverflow.com/questions/2162420/alter-mysql-table-to-add-comments-on-columns}
	echo criacaoTemplateTabela("hospital");
	echo "<pre>". criacaoTemplateTabela("hospital");
 */
function criacaoTemplateTabela ($nomeTabela="nova_tabela", $recriarTabela=false)
{
	$sql = "
		CREATE TABLE `{$nomeTabela}` (
			`id`				int(11)		PRIMARY KEY	AUTO_INCREMENT,

			`titulo`			char(255)	NOT NULL,
			`ativo`				tinyint(1)	NOT NULL	DEFAULT 1,

			`criado_em`			datetime	NOT NULL	DEFAULT current_timestamp(),
			`atualizado_em`		datetime 	NULL		DEFAULT NULL	ON UPDATE current_timestamp(),
			`excluido_em`		datetime	NULL		DEFAULT NULL,

			`criado_por`		int(11)		NOT NULL,
			`atualizado_por`	int(11)		NULL		DEFAULT NULL,
			`excluido_por`		int(11)		NULL		DEFAULT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=" . CHARSET . ";
	";

	if ($recriarTabela) {
		return "DROP TABLE IF EXISTS `{$nomeTabela}` " . $sql;
	}

	return $sql;
}

/**
 * Retorna instrução sql para criação da tabela de log de acesso (login)
 *
 * @package grimoire/bibliotecas/acesso.php
 *
 * @return	string
 */
function templateTabelaAcesso ()
{
	return "CREATE TABLE IF NOT EXISTS _log_acesso (
		`id_usuario`	int(11)			PRIMARY KEY AUTO_INCREMENT,
		`sucesso`		tinyint(1)		NOT NULL								COMMENT 'Flag de sucesso ou falha no processo de login',
		`ip`			varchar(15)		NOT NULL								COMMENT 'IP do usuário que realizou a operação',
		`navegador`		varchar(400)	NOT NULL								COMMENT 'Navegador e SO do usuário que realizou a operação',
		`datahora`		timestamp		NOT NULL DEFAULT current_timestamp()	COMMENT 'Momento em que foi a operação realizada'
	) ENGINE=InnoDB DEFAULT CHARSET=". CHARSET .";

		ALTER TABLE `_log_acesso`
			ADD CONSTRAINT `fk__log_acesso-usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON UPDATE CASCADE;
		COMMIT;
	";
}

/**
 * Retorna instrução sql para criação da tabela de log de operações
 *
 * @package grimoire/bibliotecas/acesso.php
 * @since 07/07/2021 12:37:48
 * @since	03-07-2021
 */
function templateTabelaOperacoes ()
{
	return "CREATE TABLE IF NOT EXISTS `_log_operacoes` (
		`id`			INT(11)			PRIMARY KEY AUTO_INCREMENT,
		`id_usuario`	INT(11)			NOT NULL								COMMENT 'Id do usuário que realizou a operação',
		`acao` 			SET('I','U','D','d') CHARACTER SET utf8 COLLATE utf8_bin
										NOT NULL								COMMENT 'I: insert\r\nU: update\r\nD: delete\r\nd: exclusão lógica',
		`tabela`		VARCHAR(50)		NOT NULL								COMMENT 'Tabela onde foi realizada a operação',
		`objetoId`		INT(11)			NOT NULL								COMMENT 'Registro que sofreu a alteração',
		`ip`			VARCHAR(15)		NOT NULL								COMMENT 'IP do usuário que realizou a operação',
		`navegador`		VARCHAR(400)	NOT NULL								COMMENT 'Navegador e SO do usuário que realizou a operação',
		`datahora`		TIMESTAMP		NOT NULL DEFAULT CURRENT_TIMESTAMP()	COMMENT 'Momento em que foi a operação realizada'
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;

		ALTER TABLE `_log_operacoes`
			ADD CONSTRAINT `fk__log_operacoes-usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON UPDATE CASCADE;
		COMMIT;
	";
}

/**
 * Registra operação nos modelos
 *
 * @package grimoire/bibliotecas/acesso.php
 * @since	03-07-2021
 */
function templateTabelaMenus ()
{
	return "CREATE TABLE IF NOT EXISTS menu (
		id			INT(11)			PRIMARY KEY AUTO_INCREMENT,
		parentId	INT(11)			NOT NULL,
		nome		VARCHAR(50)		NOT NULL,
	);";
}

/**
 * Registra operação nos modelos
 *
 * @author Giovanni
 * @package grimoire/bibliotecas/templates.php
 * @since	08/07/2021 09:31:19
 */
function procedureInicioProducao ()
{
	return "
		DELIMITER $$
			CREATE procedure inicio_producao()
			BEGIN
				DECLARE msg varchar(255);
				DECLARE vinicio datetime;

				declare EXIT HANDLER FOR 1146
				BEGIN
					CREATE table tb_inicio_producao (inicio_producao datetime);
					insert into tb_inicio_producao VALUES (CURRENT_TIMESTAMP());
				END;

				SELECT inicio_producao into vinicio FROM tb_inicio_producao;

				SET msg = concat('A produção foi iniciada em: ',vinicio);

			END$$
		DELIMITER ;
	";
}
