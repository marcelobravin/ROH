-- 06/09/2021 15:57:04
ALTER TABLE `hospital` ADD UNIQUE KEY `cnes` (cnes);
ALTER TABLE `hospital` ADD UNIQUE KEY `cnpj` (cnpj);
ALTER TABLE `usuario` ADD UNIQUE KEY `cpf` (cpf);
ALTER TABLE `usuario` ADD UNIQUE KEY `login` (login);
ALTER TABLE `meta` ADD UNIQUE KEY `meta_uq` (id_hospital,id_elemento);
ALTER TABLE `resultado` ADD UNIQUE KEY `resultado_uq` (id_meta,mes,ano);
