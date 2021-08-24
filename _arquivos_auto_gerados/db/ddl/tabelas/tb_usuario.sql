-- 24/08/2021 17:50:00
CREATE TABLE IF NOT EXISTS usuario (
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	login char(60) NOT NULL,
	senha char(60) NOT NULL,
	email_confirmado tinyint(1) NOT NULL,
	token varchar(255),
	ativo tinyint(1),
	reset varchar(50),
	telefone varchar(15),
	celular bigint(11) NOT NULL,
	nome varchar(255),
	cargo set('enfermeiro','medico','administrador') NOT NULL,
	endereco varchar(255),
	cpf varchar(14) NOT NULL,
	criado_em datetime NOT NULL DEFAULT current_timestamp(),
	atualizado_em datetime on update current_timestamp(),
	excluido_em datetime,
	criado_por int(11) NOT NULL,
	atualizado_por int(11),
	excluido_por int(11),
INDEX (id)
);