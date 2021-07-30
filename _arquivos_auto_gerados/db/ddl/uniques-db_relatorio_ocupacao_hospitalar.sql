-- 30-07-2021 09:21:09
ALTER TABLE `elemento` ADD UNIQUE KEY `elemento_uq` (categoria_id);
ALTER TABLE `meta` ADD UNIQUE KEY `meta_uq` (hospital_id, elemento_id, elemento_id, hospital_id);
ALTER TABLE `resultado` ADD UNIQUE KEY `resultado_uq` (meta_id, mes, ano, meta_id);
ALTER TABLE `usuario` ADD UNIQUE KEY `usuario_uq` (login, cpf);
