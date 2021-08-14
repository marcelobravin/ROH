-- 14-08-2021 17:20:48
ALTER TABLE `_log_operacoes` ENGINE = InnoDB;

ALTER TABLE `_log_operacoes`
		ADD CONSTRAINT `fk__log_operacoes-usuario`
		FOREIGN KEY (id_usuario)
		REFERENCES usuario(id)
			ON UPDATE CASCADE ON DELETE RESTRICT;