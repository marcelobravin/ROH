-- 14-08-2021 17:20:48
ALTER TABLE `elemento` ENGINE = InnoDB;

ALTER TABLE `elemento`
		ADD CONSTRAINT `fk_elemento-categoria`
		FOREIGN KEY (id_categoria)
		REFERENCES categoria(id)
			ON UPDATE CASCADE ON DELETE RESTRICT;