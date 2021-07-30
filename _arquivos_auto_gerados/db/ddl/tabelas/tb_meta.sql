CREATE TABLE IF NOT EXISTS meta (
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	hospital_id INT(11) NOT NULL,
	elemento_id INT(11) NOT NULL,
	quantidade INT(3) NOT NULL,
	ativo TINYINT(1) NOT NULL,
	criado_em DATETIME NOT NULL DEFAULT current_timestamp(),
	atualizado_em DATETIME on update current_timestamp(),
	excluido_em DATETIME,
	criado_por INT(11) NOT NULL,
	atualizado_por INT(11),
	excluido_por INT(11),
INDEX (id)
);