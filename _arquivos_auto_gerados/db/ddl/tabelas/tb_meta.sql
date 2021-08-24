-- 24/08/2021 17:50:00
CREATE TABLE IF NOT EXISTS meta (
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	id_hospital int(11) NOT NULL,
	id_elemento int(11) NOT NULL COMMENT 'Comentário',
	quantidade int(3) NOT NULL,
	ativo tinyint(1) NOT NULL,
	criado_em datetime NOT NULL DEFAULT current_timestamp(),
	atualizado_em datetime on update current_timestamp(),
	excluido_em datetime,
	criado_por int(11) NOT NULL,
	atualizado_por int(11),
	excluido_por int(11),
INDEX (id)
);