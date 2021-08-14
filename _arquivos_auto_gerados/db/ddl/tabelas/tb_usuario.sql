-- 13-08-2021 15:14:54
CREATE TABLE IF NOT EXISTS usuario (
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	login CHAR(60) NOT NULL,
	senha CHAR(60) NOT NULL,
	email_confirmado TINYINT(1) NOT NULL,
	token VARCHAR(255),
	ativo TINYINT(1),
	reset VARCHAR(50),
	telefone VARCHAR(15),
	celular BIGINT(11) NOT NULL,
	nome VARCHAR(255),
	cargo SET('ENFERMEIRO','MEDICO','ADMINISTRADOR') NOT NULL,
	endereco VARCHAR(255),
	cpf VARCHAR(14) NOT NULL,
	criado_em DATETIME NOT NULL DEFAULT current_timestamp(),
	atualizado_em DATETIME on update current_timestamp(),
	excluido_em DATETIME,
	criado_por INT(11) NOT NULL,
	atualizado_por INT(11),
	excluido_por INT(11),
INDEX (id)
);