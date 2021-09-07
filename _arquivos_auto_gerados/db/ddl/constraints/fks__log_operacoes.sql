-- 07/09/2021 19:46:44
ALTER TABLE `_log_operacoes` ENGINE = InnoDB;

ALTER TABLE `_log_operacoes`
		ADD CONSTRAINT `fk__log_operacoes-usuario`
		FOREIGN KEY (id_usuario)
		REFERENCES usuario(id)
			ON UPDATE CASCADE ON DELETE RESTRICT;