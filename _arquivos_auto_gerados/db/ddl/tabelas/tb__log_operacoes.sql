-- 13-08-2021 15:14:54
CREATE TABLE IF NOT EXISTS _log_operacoes (
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	id_usuario INT(11) NOT NULL COMMENT 'Id do usuário que realizou a operação',
	acao SET('I','U','D','D') NOT NULL COMMENT 'I: insert
U: update
D: delete
d: exclusão lógica',
	tabela VARCHAR(50) NOT NULL COMMENT 'Tabela onde foi realizada a operação',
	objetoId INT(11) NOT NULL COMMENT 'Registro que sofreu a alteração',
	ip VARCHAR(15) NOT NULL COMMENT 'IP do usuário que realizou a operação',
	navegador VARCHAR(400) NOT NULL COMMENT 'Navegador e SO do usuário que realizou a operação',
	datahora TIMESTAMP NOT NULL DEFAULT current_timestamp() COMMENT 'Momento em que foi a operação realizada',
INDEX (id)
);