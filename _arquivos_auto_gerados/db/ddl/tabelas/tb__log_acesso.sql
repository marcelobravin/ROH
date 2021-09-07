-- 07/09/2021 19:46:43
CREATE TABLE IF NOT EXISTS _log_acesso (
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	id_usuario int(11) NOT NULL,
	sucesso tinyint(1) NOT NULL,
	ip varchar(15) NOT NULL,
	navegador varchar(400) NOT NULL,
	datahora timestamp NOT NULL DEFAULT current_timestamp(),
INDEX (id)
);