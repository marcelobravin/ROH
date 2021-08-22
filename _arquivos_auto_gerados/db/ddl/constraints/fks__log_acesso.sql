-- 22/08/2021 15:53:12
ALTER TABLE `_log_acesso` ENGINE = InnoDB;

ALTER TABLE `_log_acesso`
		ADD CONSTRAINT `fk__log_acesso-usuario`
		FOREIGN KEY (id_usuario)
		REFERENCES usuario(id)
			ON UPDATE CASCADE ON DELETE RESTRICT;