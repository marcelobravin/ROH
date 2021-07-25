-- 25-07-2021 11:20:16
ALTER TABLE `elemento` ADD UNIQUE KEY `elemento_uq` (id_categoria);
ALTER TABLE `meta` ADD UNIQUE KEY `meta_uq` (id_hospital, id_elemento, id_elemento, id_hospital);
ALTER TABLE `resultado` ADD UNIQUE KEY `resultado_uq` (id_meta, mes, ano, id_meta);
ALTER TABLE `usuario` ADD UNIQUE KEY `usuario_uq` (login, cpf);
