-- 07/09/2021 10:43:53
CREATE TABLE IF NOT EXISTS _log_operacoes (
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	id_usuario int(11) NOT NULL COMMENT 'Id do usuário que realizou a operação',
	acao set('I','U','D','X') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'I: insert
U: update
D: delete
X: exclusão lógica',
	tabela varchar(50) NOT NULL COMMENT 'Tabela onde foi realizada a operação',
	objetoId int(11) NOT NULL COMMENT 'Registro que sofreu a alteração',
	ip varchar(15) NOT NULL COMMENT 'IP do usuário que realizou a operação',
	navegador varchar(400) NOT NULL COMMENT 'Navegador e SO do usuário que realizou a operação',
	datahora timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Momento em que foi a operação realizada',
INDEX (id)
);