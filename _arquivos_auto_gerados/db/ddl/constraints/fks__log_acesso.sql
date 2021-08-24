-- 24/08/2021 17:50:01
ALTER TABLE `_log_acesso` ENGINE = InnoDB;

ALTER TABLE `_log_acesso`
		ADD CONSTRAINT `fk__log_acesso-usuario`
		FOREIGN KEY (id_usuario)
		REFERENCES usuario(id)
			ON UPDATE CASCADE ON DELETE RESTRICT;