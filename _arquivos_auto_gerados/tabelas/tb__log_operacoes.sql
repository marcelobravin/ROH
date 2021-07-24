CREATE TABLE IF NOT EXISTS _log_operacoes (
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	usuarioId INT(11) NOT NULL,
	acao CHAR(1) NOT NULL,
	tabela VARCHAR(50) NOT NULL,
	objetoId INT(11) NOT NULL,
	ip VARCHAR(15),
	navegador VARCHAR(400) NOT NULL,
	datahora TIMESTAMP NOT NULL DEFAULT current_timestamp(),
INDEX (id)
);