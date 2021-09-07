-- 07/09/2021 19:46:44
ALTER TABLE `hospital` ADD UNIQUE KEY `cnes` (cnes);
ALTER TABLE `hospital` ADD UNIQUE KEY `cnpj` (cnpj);
ALTER TABLE `usuario` ADD UNIQUE KEY `cpf` (cpf);
ALTER TABLE `visita` ADD UNIQUE KEY `id_meta` (id_meta,dia,mes,ano);
ALTER TABLE `usuario` ADD UNIQUE KEY `login` (login);
ALTER TABLE `meta` ADD UNIQUE KEY `meta_uq` (id_hospital,id_elemento);
ALTER TABLE `resultado` ADD UNIQUE KEY `resultado_uq` (id_meta,mes,ano);
