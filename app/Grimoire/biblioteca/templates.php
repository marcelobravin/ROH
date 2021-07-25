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
	echo criacaoTemplateTabela("hospital");
	echo "<pre>". criacaoTemplateTabela("hospital");
 */
function criacaoTemplateTabela ($nomeTabela="nova_tabela", $recriarTabela=false)
{
	#PRIMARY KEY AUTO_INCREMENT, adicionar linha inline
	//COMMENT 'string'
	//colocar linha acima nas colunas e tabelas
	// https://stackoverflow.com/questions/2162420/alter-mysql-table-to-add-comments-on-columns

	$sql = "
		CREATE TABLE `{$nomeTabela}` (
			`id`				int(11)		NOT NULL,

			`titulo`			char(255)	NOT NULL,
			`ativo`				tinyint(1)	NOT NULL	DEFAULT 1,

			`criado_em`			datetime	NOT NULL	DEFAULT current_timestamp(),
			`atualizado_em`		datetime 	NULL		DEFAULT NULL	ON UPDATE current_timestamp(),
			`excluido_em`		datetime	NULL		DEFAULT NULL,

			`criado_por`		int(11)		NOT NULL,
			`atualizado_por`	int(11)		NULL		DEFAULT NULL,
			`excluido_por`		int(11)		NULL		DEFAULT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=" . CHARSET . ";

		-- Índices para tabela `{$nomeTabela}`
		ALTER TABLE `{$nomeTabela}`
		ADD PRIMARY KEY (`id`),
		ADD KEY `id` (`id`);

		-- AUTO_INCREMENT de tabela `{$nomeTabela}`
		ALTER TABLE `{$nomeTabela}`
		MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
		COMMIT;
	";

	if ($recriarTabela)
		return "DROP TABLE IF EXISTS `{$nomeTabela}` " . $sql;

	return $sql;
}

/**
 * Retorna instrução sql para criação da tabela de log de acesso (login)
 *
 * @package grimoire/bibliotecas/acesso.php
 * @since 07/07/2021 12:37:48
 *
 * @return	string
 */
function templateTabelaLog ()
{
	return "
		CREATE TABLE IF NOT EXISTS _log_acessos (
			id			INT(11)			PRIMARY KEY AUTO_INCREMENT,
			usuarioId	INT(11)			NOT NULL,
			acao		CHAR 			NOT NULL,
			tabela		VARCHAR(50)		NOT NULL,
			objetoId	INT(11)			NOT NULL,
			ip			VARCHAR(15),
			datahora	TIMESTAMP		NOT NULL DEFAULT CURRENT_TIMESTAMP
	);";
}

/**
 * Retorna instrução sql para criação da tabela de log de operações
 *
 * @package grimoire/bibliotecas/acesso.php
 * @since	03-07-2021
 */
function templateTabelaOperacoes ()
{
	return "CREATE TABLE IF NOT EXISTS _log_operacoes (
		id			INT(11)			PRIMARY KEY AUTO_INCREMENT,
		usuarioId	INT(11)			NOT NULL,
		acao		CHAR			NOT NULL,
		tabela		VARCHAR(50)		NOT NULL,
		objetoId	INT(11)			NOT NULL,
		ip			VARCHAR (15)	NOT NULL,
		navegador	VARCHAR(400)	NOT NULL,
		datahora	TIMESTAMP		NOT NULL DEFAULT CURRENT_TIMESTAMP
	);";
}

/**
 * Registra operação nos modelos
 *
 * @package grimoire/bibliotecas/acesso.php
 * @since	03-07-2021
 */
function templateTabelaMenus ()
{
	return "CREATE TABLE IF NOT EXISTS _log_operacoes (
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
