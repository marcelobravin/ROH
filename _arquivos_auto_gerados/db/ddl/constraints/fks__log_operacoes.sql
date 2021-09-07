-- 07/09/2021 10:43:53
ALTER TABLE `_log_operacoes` ENGINE = InnoDB;

ALTER TABLE `_log_operacoes`
		ADD CONSTRAINT `fk__log_operacoes-usuario`
		FOREIGN KEY (id_usuario)
		REFERENCES usuario(id)
			ON UPDATE CASCADE ON DELETE RESTRICT;