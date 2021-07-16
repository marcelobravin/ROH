CREATE TABLE IF NOT EXISTS resultado (
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	meta_id INT(11) NOT NULL,
	resultado INT(3) NOT NULL,
	mes TINYINT(2) NOT NULL,
	ano INT(4) NOT NULL,
	justificativa TEXT,
	justificativa_aceita TINYINT(1) NOT NULL,
	criado_em DATETIME NOT NULL,
	criado_por INT(11) NOT NULL,
INDEX (id)
);