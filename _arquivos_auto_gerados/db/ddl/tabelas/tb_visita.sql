-- 07/09/2021 10:43:53
CREATE TABLE IF NOT EXISTS visita (
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	id_meta int(11) NOT NULL,
	resultado int(3) NOT NULL,
	dia tinyint(2) NOT NULL,
	mes tinyint(2) NOT NULL,
	ano int(4) NOT NULL,
	justificativa text,
	justificativa_aceita tinyint(1) NOT NULL,
	criado_em datetime NOT NULL DEFAULT current_timestamp(),
	criado_por int(11) NOT NULL,
	atualizado_em timestamp on update current_timestamp(),
	atualizado_por int(11),
INDEX (id)
);