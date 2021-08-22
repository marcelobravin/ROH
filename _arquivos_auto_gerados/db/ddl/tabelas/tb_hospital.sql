-- 22/08/2021 15:53:11
CREATE TABLE IF NOT EXISTS hospital (
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	titulo char(255) NOT NULL,
	ativo tinyint(1),
	cnes int(7) NOT NULL,
	cnpj bigint(14) NOT NULL,
	diretor varchar(255) NOT NULL,
	segundo_responsavel varchar(255) NOT NULL,
	endereco varchar(255) NOT NULL,
	cep int(8) NOT NULL,
	telefone varchar(15) NOT NULL,
	email varchar(255) NOT NULL,
	criado_em datetime NOT NULL DEFAULT current_timestamp(),
	atualizado_em datetime on update current_timestamp(),
	excluido_em datetime,
	criado_por int(11) NOT NULL,
	atualizado_por int(11),
	excluido_por int(11),
INDEX (id)
);