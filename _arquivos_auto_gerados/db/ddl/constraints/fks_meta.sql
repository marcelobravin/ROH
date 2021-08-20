-- 17-08-2021 11:07:02
ALTER TABLE `meta` ENGINE = InnoDB;

ALTER TABLE `meta`
		ADD CONSTRAINT `fk_meta-hospital`
		FOREIGN KEY (id_hospital)
		REFERENCES hospital(id)
			ON UPDATE CASCADE ON DELETE RESTRICT;
ALTER TABLE `meta`
		ADD CONSTRAINT `fk_meta-elemento`
		FOREIGN KEY (id_elemento)
		REFERENCES elemento(id)
			ON UPDATE CASCADE ON DELETE RESTRICT;