-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Ago-2021 às 18:24
-- Versão do servidor: 10.4.19-MariaDB
-- versão do PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_relatorio_ocupacao_hospitalar`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `titulo` char(255) NOT NULL,
  `legenda` varchar(255) DEFAULT NULL,
  `observacoes` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `excluido_em` datetime DEFAULT NULL,
  `criado_por` int(11) NOT NULL,
  `atualizado_por` int(11) DEFAULT NULL,
  `excluido_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `titulo`, `legenda`, `observacoes`, `ativo`, `criado_em`, `atualizado_em`, `excluido_em`, `criado_por`, `atualizado_por`, `excluido_por`) VALUES
(1, 'Equipe', 'Manutenção da equipe médica no serviço de urgência e emergência nas 24 hs de segunda feira a domingo', 'Critério de cálculo: número absoluto / Evidência Quadro de indice diário da Comurge', 1, '2021-07-06 10:06:46', '2021-07-06 15:35:27', '0000-00-00 00:00:00', 1, 0, 0),
(2, 'Internação', 'Manutenção da equipe médica no serviço de urgência e emergência nas 24 hs de segunda feira a domingo', 'Critério de cálculo: número absoluto <br> Evidência Quadro de indice diário da Comurge', 1, '2021-07-06 10:06:46', '2021-07-06 15:35:29', '0000-00-00 00:00:00', 1, 0, 0),
(3, 'Ambulatório', 'Manutenção da equipe médica no serviço de urgência e emergência nas 24 hs de segunda feira a domingo', 'A conveniada deverá realizar no mínimo 2850 saídas hospitalares trimestrais, conforme distribuição de acordo com o número de leitos existentes', 1, '2021-07-06 10:06:46', '2021-07-06 15:35:31', '0000-00-00 00:00:00', 1, 0, 0),
(4, 'Consultas ambulatoriais', 'Manutenção da equipe médica no serviço de urgência e emergência nas 24 hs de segunda feira a domingo', '* está previsto número de vagas para realização de colposcopia de pedido externo Evidência das Consultas    SAI SUS e as primeiras consultas no SIGA', 1, '2021-07-06 10:06:46', '2021-07-06 15:35:33', '0000-00-00 00:00:00', 1, 0, 0),
(5, 'Procedimentos e cirurgias ambulatoriais', 'Manutenção da equipe médica no serviço de urgência e emergência nas 24 hs de segunda feira a domingo', 'Evidência dos procedimentos e cirurgias    SAI SUS, BPA SIH e SIGA', 1, '2021-07-06 10:06:46', '2021-07-06 15:35:34', '0000-00-00 00:00:00', 1, 0, 0),
(6, 'SADT', 'Manutenção da equipe médica no serviço de urgência e emergência nas 24 hs de segunda feira a domingo', 'Evidência do SADT, SAI, SUS e SIGA', 1, '2021-07-06 10:06:46', '2021-07-06 15:35:36', '0000-00-00 00:00:00', 1, 0, 0),
(7, 'Atenção domiciliar', 'Manutenção da equipe médica no serviço de urgência e emergência nas 24 hs de segunda feira a domingo', 'Evidência do SADT, SAI, SUS e SIGA', 1, '2021-07-06 10:06:46', '2021-07-06 15:37:16', '0000-00-00 00:00:00', 1, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `elemento`
--

CREATE TABLE `elemento` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `titulo` char(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `excluido_em` datetime DEFAULT NULL,
  `criado_por` int(11) NOT NULL,
  `atualizado_por` int(11) DEFAULT NULL,
  `excluido_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `elemento`
--

INSERT INTO `elemento` (`id`, `id_categoria`, `titulo`, `ativo`, `criado_em`, `atualizado_em`, `excluido_em`, `criado_por`, `atualizado_por`, `excluido_por`) VALUES
(1, 1, 'Clínica médica', 1, '2021-07-06 10:35:58', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(2, 1, 'Clínica Cirúrgica', 1, '2021-07-06 10:35:58', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(3, 1, 'Pedatria', 1, '2021-07-06 10:35:58', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(4, 1, 'Ginecologia e Obstetrícia', 1, '2021-07-06 10:35:58', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(5, 2, 'Clínica médica e cirúrgica', 1, '2021-07-06 10:35:58', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(6, 2, 'Pedatria', 1, '2021-07-06 10:35:58', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(7, 2, 'Obstetrícia', 1, '2021-07-06 10:35:58', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(8, 2, 'Cuidados intermediários', 1, '2021-07-06 10:35:58', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(9, 2, 'UTI Neonatal', 1, '2021-07-06 10:35:58', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(10, 3, 'Clínica médica e cirúrgica', 1, '2021-07-06 10:35:58', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(11, 3, 'Pedatria', 1, '2021-07-06 10:35:58', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(12, 3, 'Obstetrícia', 1, '2021-07-06 10:35:58', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(13, 3, 'Cuidados intermediários', 1, '2021-07-06 10:35:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(14, 3, 'UTI Neonatal', 1, '2021-07-06 10:35:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(15, 4, 'Clínica médica e cirúrgica', 1, '2021-07-06 10:35:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(16, 4, 'Pedatria', 1, '2021-07-06 10:35:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(17, 4, 'Obstetrícia', 1, '2021-07-06 10:35:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(18, 4, 'Cuidados intermediários', 1, '2021-07-06 10:35:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(19, 4, 'UTI Neonatal', 1, '2021-07-06 10:35:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(20, 5, 'Clínica médica e cirúrgica', 1, '2021-07-06 10:35:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(21, 5, 'Pedatria', 1, '2021-07-06 10:35:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(22, 5, 'Obstetrícia', 1, '2021-07-06 10:35:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(23, 5, 'Cuidados intermediários', 1, '2021-07-06 10:35:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(24, 5, 'UTI Neonatal', 1, '2021-07-06 10:35:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(25, 6, 'Ultrassonografia geral', 1, '2021-07-06 10:35:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(26, 6, 'Tomografia', 1, '2021-07-06 10:35:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(27, 6, 'Ecocardiograma', 1, '2021-07-06 10:35:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(28, 6, 'Colonoscopia', 1, '2021-07-06 10:35:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(29, 6, 'Endoscopia', 1, '2021-07-06 10:35:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(30, 6, 'Radiologia', 1, '2021-07-06 10:35:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(31, 7, 'Ultrassonografia geral', 1, '2021-07-06 10:35:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(32, 7, 'Tomografia', 1, '2021-07-06 10:35:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(33, 7, 'Ecocardiograma', 1, '2021-07-06 10:35:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(34, 7, 'Colonoscopia', 1, '2021-07-06 10:35:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(35, 7, 'Endoscopia', 1, '2021-07-06 10:35:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(36, 7, 'Radiologia', 1, '2021-07-06 10:35:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `hospital`
--

CREATE TABLE `hospital` (
  `id` int(11) NOT NULL,
  `titulo` char(255) NOT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `cnes` int(7) NOT NULL,
  `cnpj` bigint(14) DEFAULT NULL,
  `diretor` varchar(255) NOT NULL,
  `segundo_responsavel` varchar(255) NOT NULL,
  `cep` int(8) UNSIGNED ZEROFILL NOT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `uf` set('AC','AL','AP','AM','BA','CE','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO','DF') DEFAULT NULL COMMENT 'Acre,\r\nAlagoas,\r\nAmapá,\r\nAmazonas,\r\nBahia,\r\nCeará,\r\nEspírito Santo,\r\nGoiás,\r\nMaranhão,\r\nMato Grosso,\r\nMato Grosso do Sul,\r\nMinas Gerais,\r\nPará,\r\nParaíba,\r\nParaná,\r\nPernambuco,\r\nPiauí,\r\nRio de Janeiro,\r\nRio Grande do Norte,\r\nRio Grande do Sul,\r\nRondônia,\r\nRoraima,\r\nSanta Catarina,\r\nSão Paulo,\r\nSergipe,\r\nTocantins,\r\nDistrito Federal,',
  `telefone` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `excluido_em` datetime DEFAULT NULL,
  `criado_por` int(11) NOT NULL,
  `atualizado_por` int(11) DEFAULT NULL,
  `excluido_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `hospital`
--

INSERT INTO `hospital` (`id`, `titulo`, `ativo`, `cnes`, `cnpj`, `diretor`, `segundo_responsavel`, `cep`, `endereco`, `bairro`, `cidade`, `uf`, `telefone`, `email`, `criado_em`, `atualizado_em`, `excluido_em`, `criado_por`, `atualizado_por`, `excluido_por`) VALUES
(1, 'Novo Hospital', 1, 312123, 45678912311110, 'Décio Carvalho', 'Décio Carvalho Júnior', 08710190, 'Rua Capitão Manoel Caetano', 'Centro', 'Mogi das Cruzes', 'SP', '(12) 1231-3122', 'markness000@gmail.com', '2021-08-10 14:48:43', '2021-08-24 18:03:03', NULL, 1, 1, NULL),
(3, 'São Luiz Gonzaga', 1, 0, 0, 'Naor', 'Segundo responsável', 00000000, 'Endereço: R. Michel Ouchana, 94 - Jaçanã, São Paulo - SP, 02276-140', NULL, NULL, NULL, '(11) 3466-1000', 'usuario@email.com', '2021-07-21 15:37:17', '2021-08-11 14:43:24', NULL, 21, NULL, NULL),
(4, 'Luzia de Pinho Melo', 1, 0, 0, '', '', 00000000, '', NULL, NULL, NULL, '', '', '2021-07-23 09:08:14', '2021-08-09 11:01:55', NULL, 21, NULL, NULL),
(29, 'São Deus II', 0, 0, 0, '', '', 00000000, '', NULL, NULL, NULL, '', '', '2021-08-06 11:38:37', '2021-08-10 13:59:31', '2021-08-10 13:59:31', 1, NULL, 1),
(30, 'São Deus', 0, 0, 0, '', '', 00000000, '', NULL, NULL, NULL, '', '', '2021-08-06 11:40:37', '2021-08-07 00:57:08', '2021-08-07 00:57:08', 1, NULL, 1),
(31, 'José D\'Ávila II', 0, 0, 0, '', '', 00000000, '', NULL, NULL, NULL, '', '', '2021-08-06 11:41:19', '2021-08-11 09:56:36', '2021-08-07 00:57:14', 1, NULL, 1),
(32, 'São Deus', 0, 0, 0, '', '', 00000000, '', NULL, NULL, NULL, '', '', '2021-08-06 11:43:39', '2021-08-07 14:50:44', '2021-08-07 14:50:44', 1, NULL, 1),
(33, 'São Deus', 0, 0, 0, '', '', 00000000, '', NULL, NULL, NULL, '', '', '2021-08-06 11:44:10', '2021-08-07 00:57:04', '2021-08-07 00:57:04', 1, NULL, 1),
(34, 'São Deus', 0, 0, 0, '', '', 00000000, '', NULL, NULL, NULL, '', '', '2021-08-06 11:44:24', '2021-08-07 14:50:51', '2021-08-07 14:50:51', 1, NULL, 1),
(35, 'São Deus', 0, 0, 0, '', '', 00000000, '', NULL, NULL, NULL, '', '', '2021-08-06 11:44:38', '2021-08-07 00:56:54', '2021-08-07 00:56:54', 1, NULL, 1),
(36, 'São Deus', 0, 0, 0, '', '', 00000000, '', NULL, NULL, NULL, '', '', '2021-08-06 11:44:45', '2021-08-07 14:50:55', '2021-08-07 14:50:55', 1, NULL, 1),
(37, 'São Deus', 0, 0, 0, '', '', 00000000, '', NULL, NULL, NULL, '', '', '2021-08-06 11:45:19', '2021-08-07 14:50:29', '2021-08-07 14:50:29', 1, NULL, 1),
(38, 'São Deus', 0, 0, 0, '', '', 00000000, '', NULL, NULL, NULL, '', '', '2021-08-06 11:45:31', '2021-08-07 14:50:32', '2021-08-07 14:50:32', 1, NULL, 1),
(39, 'São Deus', 0, 0, 0, '', '', 00000000, '', NULL, NULL, NULL, '', '', '2021-08-06 11:46:17', '2021-08-07 14:50:38', '2021-08-07 14:50:38', 1, NULL, 1),
(40, 'São Deus', 0, 0, 0, '', '', 00000000, '', NULL, NULL, NULL, '', '', '2021-08-06 11:48:44', '2021-08-07 14:50:59', '2021-08-07 14:50:59', 1, NULL, 1),
(42, '<script>alert(\"vc sofreu um ataque XSS \")</script>', 0, 0, 0, '', '', 00000000, '', NULL, NULL, NULL, '', '', '2021-08-07 15:01:35', '2021-08-10 13:59:19', '2021-08-10 13:59:19', 1, NULL, 1),
(43, 'CARLOS ALBERTO DE NOBREGA JUNIOR', 1, 0, 0, '', '', 00000000, '', NULL, NULL, NULL, '', '', '2021-08-09 15:30:41', '2021-08-10 14:23:15', NULL, 1, NULL, NULL),
(45, 'Luzia de Pinho Melo', 1, 0, 0, '', '', 00000000, '', NULL, NULL, NULL, '', '', '2021-08-10 13:59:10', NULL, NULL, 1, NULL, NULL),
(47, 'São Luiz Gonzaga', 0, 312123, 4456456456421, 'Décio Carvalho', 'Segundo responsável', 08710190, 'Rua Capitão Manoel Caetano', 'Centro', 'Mogi das Cruzes', 'PR', '(11) 9598-9039', 'raquelnunesusados@gmail.com', '2021-08-24 09:07:27', '2021-08-24 11:47:37', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `meta`
--

CREATE TABLE `meta` (
  `id` int(11) NOT NULL,
  `id_hospital` int(11) NOT NULL,
  `id_elemento` int(11) NOT NULL COMMENT 'Comentário',
  `quantidade` int(3) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `excluido_em` datetime DEFAULT NULL,
  `criado_por` int(11) NOT NULL,
  `atualizado_por` int(11) DEFAULT NULL,
  `excluido_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `meta`
--

INSERT INTO `meta` (`id`, `id_hospital`, `id_elemento`, `quantidade`, `ativo`, `criado_em`, `atualizado_em`, `excluido_em`, `criado_por`, `atualizado_por`, `excluido_por`) VALUES
(1, 3, 10, 10, 1, '2021-08-06 14:51:30', '2021-08-07 17:47:48', NULL, 1, 1, NULL),
(2, 3, 13, 20, 1, '2021-08-06 14:51:30', '2021-08-07 17:47:48', NULL, 1, 1, NULL),
(3, 3, 12, 0, 0, '2021-08-06 14:51:31', '2021-08-07 17:47:48', NULL, 1, 1, NULL),
(4, 3, 11, 0, 0, '2021-08-06 14:51:31', '2021-08-07 17:47:48', NULL, 1, 1, NULL),
(5, 3, 14, 0, 0, '2021-08-06 14:51:31', '2021-08-07 17:47:48', NULL, 1, 1, NULL),
(6, 29, 10, 10, 1, '2021-08-07 00:37:36', '2021-08-07 00:57:42', NULL, 1, 1, NULL),
(7, 29, 13, 10, 1, '2021-08-07 00:37:36', '2021-08-07 00:57:42', NULL, 1, 1, NULL),
(8, 29, 12, 20, 1, '2021-08-07 00:37:36', '2021-08-07 00:57:42', NULL, 1, 1, NULL),
(9, 29, 11, 3, 1, '2021-08-07 00:37:36', '2021-08-07 00:57:42', NULL, 1, 1, NULL),
(10, 29, 14, 30, 1, '2021-08-07 00:37:36', '2021-08-07 00:57:42', NULL, 1, 1, NULL),
(16, 29, 34, 9, 1, '2021-08-07 01:07:08', '2021-08-07 09:39:14', NULL, 1, 1, NULL),
(17, 29, 33, 8, 1, '2021-08-07 01:07:08', '2021-08-07 09:39:14', NULL, 1, 1, NULL),
(18, 29, 35, 7, 1, '2021-08-07 01:07:08', '2021-08-07 09:39:14', NULL, 1, 1, NULL),
(19, 29, 36, 0, 0, '2021-08-07 01:07:08', '2021-08-07 09:39:14', NULL, 1, 1, NULL),
(20, 29, 32, 3, 1, '2021-08-07 01:07:08', '2021-08-07 09:39:14', NULL, 1, 1, NULL),
(21, 29, 31, 0, 0, '2021-08-07 01:07:08', '2021-08-07 09:39:14', NULL, 1, 1, NULL),
(33, 42, 10, 10, 1, '2021-08-07 18:06:26', NULL, NULL, 1, NULL, NULL),
(34, 42, 13, 0, 0, '2021-08-07 18:06:26', NULL, NULL, 1, NULL, NULL),
(35, 42, 12, 0, 0, '2021-08-07 18:06:26', NULL, NULL, 1, NULL, NULL),
(36, 42, 11, 0, 0, '2021-08-07 18:06:26', NULL, NULL, 1, NULL, NULL),
(37, 42, 14, 0, 0, '2021-08-07 18:06:26', NULL, NULL, 1, NULL, NULL),
(38, 43, 10, 10, 1, '2021-08-09 16:06:18', '2021-08-19 11:06:55', NULL, 1, 1, NULL),
(39, 43, 13, 11, 1, '2021-08-09 16:06:18', '2021-08-19 11:06:49', NULL, 1, 1, NULL),
(40, 43, 12, 12, 1, '2021-08-09 16:06:18', '2021-08-19 11:07:01', NULL, 1, 1, NULL),
(41, 43, 11, 13, 1, '2021-08-09 16:06:19', '2021-08-19 11:07:12', NULL, 1, 1, NULL),
(42, 43, 14, 14, 1, '2021-08-09 16:06:19', '2021-08-19 11:07:12', NULL, 1, 1, NULL),
(48, 1, 34, 60, 1, '2021-08-10 14:56:08', NULL, NULL, 1, NULL, NULL),
(49, 1, 33, 200, 1, '2021-08-10 14:56:08', NULL, NULL, 1, NULL, NULL),
(50, 1, 35, 20, 1, '2021-08-10 14:56:08', NULL, NULL, 1, NULL, NULL),
(51, 1, 36, 0, 0, '2021-08-10 14:56:08', NULL, NULL, 1, NULL, NULL),
(52, 1, 32, 0, 0, '2021-08-10 14:56:08', NULL, NULL, 1, NULL, NULL),
(53, 1, 31, 0, 0, '2021-08-10 14:56:08', NULL, NULL, 1, NULL, NULL),
(54, 43, 28, 70, 1, '2021-08-19 11:03:55', '2021-08-19 11:20:40', NULL, 1, 1, NULL),
(55, 43, 27, 71, 1, '2021-08-19 11:03:55', '2021-08-19 11:20:40', NULL, 1, 1, NULL),
(56, 43, 29, 72, 1, '2021-08-19 11:03:55', '2021-08-19 11:20:40', NULL, 1, 1, NULL),
(57, 43, 30, 73, 1, '2021-08-19 11:03:56', '2021-08-19 11:20:40', NULL, 1, 1, NULL),
(58, 43, 26, 74, 1, '2021-08-19 11:03:56', '2021-08-19 11:20:41', NULL, 1, 1, NULL),
(59, 43, 25, 75, 1, '2021-08-19 11:03:56', '2021-08-19 11:20:41', NULL, 1, 1, NULL),
(80, 43, 34, 20, 1, '2021-08-19 11:07:33', NULL, NULL, 1, NULL, NULL),
(81, 43, 33, 21, 1, '2021-08-19 11:07:33', NULL, NULL, 1, NULL, NULL),
(82, 43, 35, 22, 1, '2021-08-19 11:07:33', NULL, NULL, 1, NULL, NULL),
(83, 43, 36, 23, 1, '2021-08-19 11:07:33', NULL, NULL, 1, NULL, NULL),
(84, 43, 32, 24, 1, '2021-08-19 11:07:33', NULL, NULL, 1, NULL, NULL),
(85, 43, 31, 25, 1, '2021-08-19 11:07:33', NULL, NULL, 1, NULL, NULL),
(86, 43, 2, 40, 1, '2021-08-19 11:16:04', NULL, NULL, 1, NULL, NULL),
(87, 43, 1, 41, 1, '2021-08-19 11:16:04', NULL, NULL, 1, NULL, NULL),
(88, 43, 4, 42, 1, '2021-08-19 11:16:04', NULL, NULL, 1, NULL, NULL),
(89, 43, 3, 43, 1, '2021-08-19 11:16:04', NULL, NULL, 1, NULL, NULL),
(90, 43, 15, 30, 1, '2021-08-19 11:16:26', NULL, NULL, 1, NULL, NULL),
(91, 43, 18, 31, 1, '2021-08-19 11:16:26', NULL, NULL, 1, NULL, NULL),
(92, 43, 17, 32, 1, '2021-08-19 11:16:26', NULL, NULL, 1, NULL, NULL),
(93, 43, 16, 33, 1, '2021-08-19 11:16:26', NULL, NULL, 1, NULL, NULL),
(94, 43, 19, 34, 1, '2021-08-19 11:16:26', NULL, NULL, 1, NULL, NULL),
(95, 43, 5, 50, 1, '2021-08-19 11:16:50', NULL, NULL, 1, NULL, NULL),
(96, 43, 8, 51, 1, '2021-08-19 11:16:50', NULL, NULL, 1, NULL, NULL),
(97, 43, 7, 52, 1, '2021-08-19 11:16:50', NULL, NULL, 1, NULL, NULL),
(98, 43, 6, 53, 1, '2021-08-19 11:16:51', NULL, NULL, 1, NULL, NULL),
(99, 43, 9, 54, 1, '2021-08-19 11:16:51', NULL, NULL, 1, NULL, NULL),
(100, 43, 20, 60, 1, '2021-08-19 11:17:12', '2021-08-19 11:17:23', NULL, 1, 1, NULL),
(101, 43, 23, 61, 1, '2021-08-19 11:17:12', '2021-08-19 11:17:23', NULL, 1, 1, NULL),
(102, 43, 22, 62, 1, '2021-08-19 11:17:12', '2021-08-19 11:17:23', NULL, 1, 1, NULL),
(103, 43, 21, 63, 1, '2021-08-19 11:17:12', '2021-08-19 11:17:23', NULL, 1, 1, NULL),
(104, 43, 24, 64, 1, '2021-08-19 11:17:12', '2021-08-19 11:17:23', NULL, 1, 1, NULL),
(116, 4, 28, 1, 1, '2021-08-28 11:41:11', NULL, NULL, 1, NULL, NULL),
(117, 4, 27, 0, 0, '2021-08-28 11:41:11', NULL, NULL, 1, NULL, NULL),
(118, 4, 29, 0, 0, '2021-08-28 11:41:11', NULL, NULL, 1, NULL, NULL),
(119, 4, 30, 0, 0, '2021-08-28 11:41:11', NULL, NULL, 1, NULL, NULL),
(120, 4, 26, 0, 0, '2021-08-28 11:41:11', NULL, NULL, 1, NULL, NULL),
(121, 4, 25, 0, 0, '2021-08-28 11:41:11', NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `resultado`
--

CREATE TABLE `resultado` (
  `id` int(11) NOT NULL,
  `id_meta` int(11) NOT NULL,
  `resultado` int(3) NOT NULL,
  `mes` tinyint(2) NOT NULL,
  `ano` int(4) NOT NULL,
  `justificativa` text DEFAULT NULL,
  `justificativa_aceita` tinyint(1) NOT NULL DEFAULT 0,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `criado_por` int(11) NOT NULL,
  `atualizado_em` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `atualizado_por` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `resultado`
--

INSERT INTO `resultado` (`id`, `id_meta`, `resultado`, `mes`, `ano`, `justificativa`, `justificativa_aceita`, `criado_em`, `criado_por`, `atualizado_em`, `atualizado_por`) VALUES
(61, 116, 1, 8, 2021, '', 0, '2021-08-28 13:22:11', 1, '2021-08-28 16:22:48', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `login` char(60) NOT NULL,
  `senha` char(60) NOT NULL,
  `email_confirmado` tinyint(1) NOT NULL DEFAULT 0,
  `token` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `reset` varchar(50) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `celular` bigint(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `cargo` set('enfermeiro','medico','administrador') NOT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `cpf` varchar(14) NOT NULL,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `excluido_em` datetime DEFAULT NULL,
  `criado_por` int(11) NOT NULL,
  `atualizado_por` int(11) DEFAULT NULL,
  `excluido_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `login`, `senha`, `email_confirmado`, `token`, `ativo`, `reset`, `telefone`, `celular`, `nome`, `cargo`, `endereco`, `cpf`, `criado_em`, `atualizado_em`, `excluido_em`, `criado_por`, `atualizado_por`, `excluido_por`) VALUES
(1, 'usuario@email.com', '$2y$12$TVnPBAOX7b6bIiygqf2pJOdBz5j9zAEBRkovyr.UZDJ4d635VUg.q', 1, '', 0, '', '1147964069', 11959890399, 'Marcelo de Souza Bravin', 'medico', 'Avenida Francisco Rodrigues Filho', '307.485.238-04', '2021-07-02 10:21:37', '2021-08-24 18:11:54', NULL, 1, 1, 21),
(32, 'mesnovaes@prefeitura.sp.gov.br', '$2y$12$V6IPH1Q/Nrv./iBP6lf2pu9b91c67uAEsw0P0m/QuCoSygyHKKOrq', 0, NULL, 0, NULL, '', 0, 'Meire Ellen', '', '', '338.059.850-02', '2021-08-09 14:08:05', NULL, NULL, 1, NULL, NULL),
(39, 'markness000@gmail.com', '$2y$12$Mz1gtEdxb9grY92xdQvLR.M7Y1dw704GCEDTDdvsvsHVFgBcgVcVa', 1, '', 0, NULL, '1195989039', 11959890399, 'Marcelo de Souza Bravin', 'medico', 'Avenida Francisco Rodrigues Filho', '547.533.270-35', '2021-08-23 08:34:12', '2021-08-24 18:14:21', NULL, 1, 1, NULL),
(40, 'markness@hotmail.com', '$2y$12$6qbW7XV3QtoN2eICpcERHOk1XAKC1/B9XceypuI9Q6dzZQJNrOVkK', 1, '', 1, '', '', 45646546456, '', 'administrador', '', '318.661.650-62', '2021-08-24 18:15:42', '2021-08-24 18:56:28', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `_log_acesso`
--

CREATE TABLE `_log_acesso` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `sucesso` tinyint(1) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `navegador` varchar(400) NOT NULL,
  `datahora` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `_log_acesso`
--

INSERT INTO `_log_acesso` (`id`, `id_usuario`, `sucesso`, `ip`, `navegador`, `datahora`) VALUES
(92, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-28 13:57:15'),
(93, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-28 13:57:52'),
(94, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-28 13:57:53'),
(95, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-28 13:58:03'),
(96, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-28 14:29:14'),
(97, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-28 14:34:01'),
(98, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-28 14:34:19'),
(99, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-28 16:16:02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `_log_operacoes`
--

CREATE TABLE `_log_operacoes` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL COMMENT 'Id do usuário que realizou a operação',
  `acao` set('I','U','D','d') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'I: insert\r\nU: update\r\nD: delete\r\nd: exclusão lógica',
  `tabela` varchar(50) NOT NULL COMMENT 'Tabela onde foi realizada a operação',
  `objetoId` int(11) NOT NULL COMMENT 'Registro que sofreu a alteração',
  `ip` varchar(15) NOT NULL COMMENT 'IP do usuário que realizou a operação',
  `navegador` varchar(400) NOT NULL COMMENT 'Navegador e SO do usuário que realizou a operação',
  `datahora` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Momento em que foi a operação realizada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `_log_operacoes`
--

INSERT INTO `_log_operacoes` (`id`, `id_usuario`, `acao`, `tabela`, `objetoId`, `ip`, `navegador`, `datahora`) VALUES
(104, 1, 'U', 'resultado', 37, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/92.0.4515.159 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-28 16:21:42'),
(105, 1, 'I', 'resultado', 61, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/92.0.4515.159 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-28 16:22:11'),
(106, 1, 'U', 'resultado', 61, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/92.0.4515.159 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-28 16:22:20'),
(107, 1, 'U', 'resultado', 61, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/92.0.4515.159 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-28 16:22:36'),
(108, 1, 'U', 'resultado', 61, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/92.0.4515.159 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-28 16:22:48');

-- --------------------------------------------------------

--
-- Estrutura da tabela `__exemplo`
--

CREATE TABLE `__exemplo` (
  `id` int(11) NOT NULL,
  `acao` set('I','U','D','X') CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT 'I: insert\r\nU: update\r\nD: delete\r\nX: exclusão lógica',
  `ano` year(4) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `cargo` set('enfermeiro','medico','administrador') DEFAULT NULL,
  `celular` bigint(11) DEFAULT NULL,
  `cep` int(8) UNSIGNED ZEROFILL NOT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `cnes` int(7) DEFAULT NULL,
  `cnpj` bigint(14) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `datahora` timestamp NULL DEFAULT current_timestamp(),
  `dinheiro` decimal(9,2) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `justificativa` text DEFAULT NULL,
  `mes` tinyint(2) DEFAULT NULL,
  `navegador` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `objetoId` int(11) DEFAULT NULL COMMENT 'Registro que sofreu a alteração',
  `quantidade` int(3) DEFAULT NULL,
  `resultado` int(3) DEFAULT NULL,
  `senha` char(60) DEFAULT NULL,
  `sucesso` tinyint(1) DEFAULT NULL,
  `tabela` varchar(50) DEFAULT NULL COMMENT 'Tabela onde foi realizada a operação',
  `telefone` varchar(15) DEFAULT NULL,
  `tempo` time DEFAULT NULL,
  `uf` set('AC','AL','AP','AM','BA','CE','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO','DF') DEFAULT NULL COMMENT 'Acre,\r\nAlagoas,\r\nAmapá,\r\nAmazonas,\r\nBahia,\r\nCeará,\r\nEspírito Santo,\r\nGoiás,\r\nMaranhão,\r\nMato Grosso,\r\nMato Grosso do Sul,\r\nMinas Gerais,\r\nPará,\r\nParaíba,\r\nParaná,\r\nPernambuco,\r\nPiauí,\r\nRio de Janeiro,\r\nRio Grande do Norte,\r\nRio Grande do Sul,\r\nRondônia,\r\nRoraima,\r\nSanta Catarina,\r\nSão Paulo,\r\nSergipe,\r\nTocantins,\r\nDistrito Federal,'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `__exemplo`
--

INSERT INTO `__exemplo` (`id`, `acao`, `ano`, `bairro`, `cargo`, `celular`, `cep`, `cidade`, `cnes`, `cnpj`, `cpf`, `data`, `datahora`, `dinheiro`, `endereco`, `ip`, `justificativa`, `mes`, `navegador`, `objetoId`, `quantidade`, `resultado`, `senha`, `sucesso`, `tabela`, `telefone`, `tempo`, `uf`) VALUES
(1, 'D', 2000, 'bairro', 'medico', 11959890399, 08710190, 'cidade', 1234567, 33710079000101, '30748523804', '2021-08-01', '2021-08-24 18:54:21', '5099.89', 'endereco', '255.255.255', 'Justificativa', 15, 'json', 1, 8, 88, 'senha', 1, 'tabela', '11959890399', '04:22:00', 'PR'),
(2, 'U', 0000, '', '', 0, 00000000, '', 0, NULL, '', '0000-00-00', '2021-08-24 18:55:18', '0.00', '', '', NULL, 0, '', 0, 0, 0, '', 0, '', NULL, '00:00:00', NULL),
(3, NULL, NULL, NULL, NULL, NULL, 00000000, NULL, NULL, NULL, NULL, NULL, '2021-08-24 18:56:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, NULL, 2020, NULL, 'medico', 77, 00000000, 'df', 3432, 43, '32', '2021-08-24', '2021-08-24 18:58:48', '11.00', NULL, NULL, 'we', 3, 'w', 3, 3, 3, '23', NULL, 'eqwe', '12', '20:56:40', NULL),
(5, NULL, NULL, NULL, NULL, NULL, 00000000, NULL, NULL, NULL, NULL, NULL, '2021-08-24 18:58:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'D', NULL, NULL, NULL, NULL, 00000001, NULL, NULL, NULL, NULL, NULL, '2021-08-24 18:59:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Índices para tabela `elemento`
--
ALTER TABLE `elemento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `fk_categoria` (`id_categoria`);

--
-- Índices para tabela `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Índices para tabela `meta`
--
ALTER TABLE `meta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `meta_uq` (`id_hospital`,`id_elemento`),
  ADD KEY `id` (`id`),
  ADD KEY `fk_elemento` (`id_elemento`);

--
-- Índices para tabela `resultado`
--
ALTER TABLE `resultado`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `resultado_uq` (`id_meta`,`mes`,`ano`),
  ADD KEY `id` (`id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD KEY `id` (`id`);

--
-- Índices para tabela `_log_acesso`
--
ALTER TABLE `_log_acesso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `fk_usuario_acesso` (`id_usuario`);

--
-- Índices para tabela `_log_operacoes`
--
ALTER TABLE `_log_operacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario` (`id_usuario`);

--
-- Índices para tabela `__exemplo`
--
ALTER TABLE `__exemplo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `elemento`
--
ALTER TABLE `elemento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `hospital`
--
ALTER TABLE `hospital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de tabela `meta`
--
ALTER TABLE `meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT de tabela `resultado`
--
ALTER TABLE `resultado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `_log_acesso`
--
ALTER TABLE `_log_acesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de tabela `_log_operacoes`
--
ALTER TABLE `_log_operacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT de tabela `__exemplo`
--
ALTER TABLE `__exemplo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `elemento`
--
ALTER TABLE `elemento`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `meta`
--
ALTER TABLE `meta`
  ADD CONSTRAINT `fk_elemento` FOREIGN KEY (`id_elemento`) REFERENCES `elemento` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_hospital` FOREIGN KEY (`id_hospital`) REFERENCES `hospital` (`id`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `resultado`
--
ALTER TABLE `resultado`
  ADD CONSTRAINT `fk_meta` FOREIGN KEY (`id_meta`) REFERENCES `meta` (`id`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `_log_acesso`
--
ALTER TABLE `_log_acesso`
  ADD CONSTRAINT `fk_usuario_acesso` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `_log_operacoes`
--
ALTER TABLE `_log_operacoes`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
