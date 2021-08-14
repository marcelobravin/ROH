-- 14-08-2021 17:21:08
ALTER TABLE `elemento` ADD UNIQUE KEY `elemento_uq` (id_categoria);
ALTER TABLE `meta` ADD UNIQUE KEY `meta_uq` (id_hospital, id_elemento, id_elemento, id_hospital);
ALTER TABLE `resultado` ADD UNIQUE KEY `resultado_uq` (id_meta, mes, ano, id_meta);
ALTER TABLE `usuario` ADD UNIQUE KEY `usuario_uq` (login, cpf);
ALTER TABLE `_log_acesso` ADD UNIQUE KEY `_log_acesso_uq` (id_usuario);
ALTER TABLE `_log_operacoes` ADD UNIQUE KEY `_log_operacoes_uq` (id_usuario);
