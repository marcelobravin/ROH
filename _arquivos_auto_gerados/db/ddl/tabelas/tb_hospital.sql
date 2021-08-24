-- 24/08/2021 17:38:22
CREATE TABLE IF NOT EXISTS hospital (
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	titulo char(255) NOT NULL,
	dinheirinhos decimal(9,2) NOT NULL,
	ativo tinyint(1),
	cnes int(7) NOT NULL,
	cnpj bigint(14),
	diretor varchar(255) NOT NULL,
	segundo_responsavel varchar(255) NOT NULL,
	cep int(8) unsigned zerofill NOT NULL,
	endereco varchar(255),
	bairro varchar(255),
	cidade varchar(255),
	uf set('AC','AL','AP','AM','BA','CE','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO','DF') COMMENT 'Acre,
Alagoas,
Amapá,
Amazonas,
Bahia,
Ceará,
Espírito Santo,
Goiás,
Maranhão,
Mato Grosso,
Mato Grosso do Sul,
Minas Gerais,
Pará,
Paraíba,
Paraná,
Pernambuco,
Piauí,
Rio de Janeiro,
Rio Grande do Norte,
Rio Grande do Sul,
Rondônia,
Roraima,
Santa Catarina,
São Paulo,
Sergipe,
Tocantins,
Distrito Federal,',
	telefone varchar(15),
	email varchar(255),
	criado_em datetime NOT NULL DEFAULT current_timestamp(),
	atualizado_em datetime on update current_timestamp(),
	excluido_em datetime,
	criado_por int(11) NOT NULL,
	atualizado_por int(11),
	excluido_por int(11),
INDEX (id)
);