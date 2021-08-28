-- 28/08/2021 13:34:18
ALTER TABLE `elemento` ENGINE = InnoDB;

ALTER TABLE `elemento`
		ADD CONSTRAINT `fk_elemento-categoria`
		FOREIGN KEY (id_categoria)
		REFERENCES categoria(id)
			ON UPDATE CASCADE ON DELETE RESTRICT;