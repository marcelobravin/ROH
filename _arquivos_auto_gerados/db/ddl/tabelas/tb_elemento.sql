-- 07-08-2021 22:20:42
CREATE TABLE IF NOT EXISTS elemento (
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	id_categoria INT(11) NOT NULL,
	titulo CHAR(255) NOT NULL,
	ativo TINYINT(1) NOT NULL,
	criado_em DATETIME NOT NULL DEFAULT current_timestamp(),
	atualizado_em DATETIME on update current_timestamp(),
	excluido_em DATETIME,
	criado_por INT(11) NOT NULL,
	atualizado_por INT(11),
	excluido_por INT(11),
INDEX (id)
);