ALTER TABLE `resultado` ENGINE = InnoDB;

ALTER TABLE `resultado`
		ADD CONSTRAINT `fk_meta`
		FOREIGN KEY (id_meta)
		REFERENCES meta(id)
			ON UPDATE CASCADE ON DELETE RESTRICT;