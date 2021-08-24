-- 24/08/2021 18:51:38
CREATE TABLE IF NOT EXISTS elemento (
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	id_categoria int(11) NOT NULL,
	titulo char(255) NOT NULL,
	ativo tinyint(1) NOT NULL,
	criado_em datetime NOT NULL DEFAULT current_timestamp(),
	atualizado_em datetime on update current_timestamp(),
	excluido_em datetime,
	criado_por int(11) NOT NULL,
	atualizado_por int(11),
	excluido_por int(11),
INDEX (id)
);