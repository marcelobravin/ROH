-- 07/09/2021 19:46:43
CREATE TABLE IF NOT EXISTS __exemplo (
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	acao set('I','U','D','X') CHARACTER SET utf8 COLLATE utf8_bin COMMENT 'I: insert
U: update
D: delete
X: exclusão lógica',
	ano year(4),
	bairro varchar(255),
	cargo set('enfermeiro','medico','administrador'),
	celular bigint(11),
	cep int(8) unsigned zerofill NOT NULL,
	cidade varchar(255),
	cnes int(7),
	cnpj bigint(14),
	cpf varchar(14),
	data date,
	datahora timestamp DEFAULT current_timestamp(),
	dinheiro decimal(9,2),
	endereco varchar(255),
	ip varchar(15),
	justificativa text,
	mes tinyint(2),
	navegador text CHARACTER SET utf8 COLLATE utf8mb4_bin,
	objetoId int(11) COMMENT 'Registro que sofreu a alteração',
	quantidade int(3),
	resultado int(3),
	senha char(60),
	sucesso tinyint(1),
	tabela varchar(50) COMMENT 'Tabela onde foi realizada a operação',
	telefone varchar(15),
	tempo time,
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
INDEX (id)
);