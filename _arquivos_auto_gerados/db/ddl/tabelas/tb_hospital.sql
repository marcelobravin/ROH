-- 14-08-2021 17:20:47
CREATE TABLE IF NOT EXISTS hospital (
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	titulo CHAR(255) NOT NULL,
	ativo TINYINT(1),
	cnes INT(7),
	cnpj BIGINT(14),
	diretor VARCHAR(255),
	segundo_responsavel VARCHAR(255),
	endereco VARCHAR(255),
	cep INT(8),
	telefone VARCHAR(15),
	email VARCHAR(255),
	criado_em DATETIME NOT NULL DEFAULT current_timestamp(),
	atualizado_em DATETIME on update current_timestamp(),
	excluido_em DATETIME,
	criado_por INT(11) NOT NULL,
	atualizado_por INT(11),
	excluido_por INT(11),
INDEX (id)
);