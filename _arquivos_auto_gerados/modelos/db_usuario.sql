CREATE TABLE IF NOT EXISTS usuario (
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	login CHAR(60) NOT NULL,
	senha CHAR(60) NOT NULL,
	email_confirmado TINYINT(1) NOT NULL,
	token VARCHAR(255),
	ativo TINYINT(1) NOT NULL,
	reset VARCHAR(50),
	criado_em DATETIME NOT NULL,
	atualizado_em DATETIME,
	excluido_em DATETIME,
	criado_por INT(11) NOT NULL,
	atualizado_por INT(11),
	excluido_por INT(11),
INDEX (id)
);