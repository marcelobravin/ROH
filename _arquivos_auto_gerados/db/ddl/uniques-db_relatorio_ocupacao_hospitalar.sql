-- 17-08-2021 11:07:02
ALTER TABLE `usuario` ADD UNIQUE KEY `cpf` (cpf);
ALTER TABLE `usuario` ADD UNIQUE KEY `login` (login);
ALTER TABLE `meta` ADD UNIQUE KEY `meta_uq` (id_hospital,id_elemento);
ALTER TABLE `resultado` ADD UNIQUE KEY `resultado_uq` (id_meta,mes,ano);
