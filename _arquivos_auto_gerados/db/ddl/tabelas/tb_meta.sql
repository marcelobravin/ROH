-- 13-08-2021 23:23:52
CREATE TABLE IF NOT EXISTS meta (
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	id_hospital INT(11) NOT NULL,
	id_elemento INT(11) NOT NULL COMMENT 'Comentário',
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