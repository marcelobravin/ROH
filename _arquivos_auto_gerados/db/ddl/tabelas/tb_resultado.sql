-- 14-08-2021 17:20:47
CREATE TABLE IF NOT EXISTS resultado (
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	id_meta INT(11) NOT NULL,
	resultado INT(3) NOT NULL,
	mes TINYINT(2) NOT NULL,
	ano INT(4) NOT NULL,
	justificativa TEXT,
	justificativa_aceita TINYINT(1) NOT NULL,
	criado_em DATETIME NOT NULL DEFAULT current_timestamp(),
	criado_por INT(11) NOT NULL,
INDEX (id)
);