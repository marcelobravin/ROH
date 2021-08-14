-- 13-08-2021 15:14:54
CREATE TABLE IF NOT EXISTS hospital (
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	titulo CHAR(255) NOT NULL,
	ativo TINYINT(1),
	cnes INT(7) NOT NULL,
	cnpj BIGINT(14) NOT NULL,
	diretor VARCHAR(255) NOT NULL,
	segundo_responsavel VARCHAR(255) NOT NULL,
	endereco VARCHAR(255) NOT NULL,
	cep INT(8) NOT NULL,
	telefone VARCHAR(15) NOT NULL,
	email VARCHAR(255) NOT NULL,
	criado_em DATETIME NOT NULL DEFAULT current_timestamp(),
	atualizado_em DATETIME on update current_timestamp(),
	excluido_em DATETIME,
	criado_por INT(11) NOT NULL,
	atualizado_por INT(11),
	excluido_por INT(11),
INDEX (id)
);