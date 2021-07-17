CREATE TABLE IF NOT EXISTS hospital (
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	titulo CHAR(255) NOT NULL,
	ativo TINYINT(1),
	criado_em DATETIME NOT NULL DEFAULT current_timestamp(),
	atualizado_em DATETIME on update current_timestamp(),
	excluido_em DATETIME,
	criado_por INT(11) NOT NULL,
	atualizado_por INT(11),
	excluido_por INT(11),
INDEX (id)
);