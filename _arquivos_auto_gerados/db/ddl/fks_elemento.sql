-- 07-08-2021 22:20:42
ALTER TABLE `elemento` ENGINE = InnoDB;

ALTER TABLE `elemento`
		ADD CONSTRAINT `fk_categoria`
		FOREIGN KEY (id_categoria)
		REFERENCES categoria(id)
			ON UPDATE CASCADE ON DELETE RESTRICT;