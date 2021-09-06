-- 06/09/2021 15:57:05
ALTER TABLE `_log_operacoes` ENGINE = InnoDB;

ALTER TABLE `_log_operacoes`
		ADD CONSTRAINT `fk__log_operacoes-usuario`
		FOREIGN KEY (id_usuario)
		REFERENCES usuario(id)
			ON UPDATE CASCADE ON DELETE RESTRICT;