-- 06/09/2021 15:57:04
CREATE TABLE IF NOT EXISTS categoria (
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	titulo char(255) NOT NULL,
	legenda varchar(255),
	observacoes varchar(255),
	ativo tinyint(1) NOT NULL,
	criado_em datetime NOT NULL DEFAULT current_timestamp(),
	atualizado_em datetime on update current_timestamp(),
	excluido_em datetime,
	criado_por int(11) NOT NULL,
	atualizado_por int(11),
	excluido_por int(11),
INDEX (id)
);