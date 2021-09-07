-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08-Set-2021 às 00:45
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
  `numero` int(11) NOT NULL,
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

INSERT INTO `hospital` (`id`, `titulo`, `ativo`, `cnes`, `cnpj`, `diretor`, `segundo_responsavel`, `cep`, `endereco`, `numero`, `bairro`, `cidade`, `uf`, `telefone`, `email`, `criado_em`, `atualizado_em`, `excluido_em`, `criado_por`, `atualizado_por`, `excluido_por`) VALUES
(31, 'José D\'Ávila II', 0, 0, 0, '', '', 00000000, '', 0, NULL, NULL, NULL, '', '', '2021-08-06 11:41:19', '2021-08-11 09:56:36', '2021-08-07 00:57:14', 1, NULL, 1),
(63, 'NOME DO HOSPITAL SEM CARACTERES ESPECIAL', 1, 1236511, 21201225621000, 'Antônio Soares', 'Antônio Cantolano', 06852640, 'Rua Arkansas', 0, '', '', 'AC', '(11) 3386-410', 'mesnovaes@prefeitura.sp.gov.br', '2021-09-03 09:44:33', '2021-09-03 09:53:46', NULL, 1, 1, NULL),
(64, 'hospital teste', 0, 1111111, 12121212111212, 'Paulo Gustavo', 'anjsbashcbhabhb', 06852610, 'Rua Lusiânia', 0, NULL, NULL, NULL, '(16) 6304-7707', 'meiresama@gmail.com', '2021-09-03 11:52:07', NULL, NULL, 1, NULL, NULL),
(65, 'São João I', 1, 4564564, NULL, 'didi', 'tere', 08710190, 'Rua Capitão Manoel Caetano', 0, 'Centro', 'Mogi das Cruzes', 'SP', '', '', '2021-09-05 13:36:26', '2021-09-06 13:16:46', NULL, 1, 1, NULL);

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
(116, 43, 10, 7, 1, '2021-08-27 10:33:02', '2021-09-03 12:53:31', NULL, 1, 1, NULL),
(117, 43, 13, 11, 1, '2021-08-27 10:33:02', '2021-09-02 18:12:09', NULL, 1, 1, NULL),
(118, 43, 12, 12, 1, '2021-08-27 10:33:02', '2021-09-02 18:12:09', NULL, 1, 1, NULL),
(119, 43, 11, 13, 1, '2021-08-27 10:33:02', '2021-09-02 18:12:09', NULL, 1, 1, NULL),
(120, 43, 14, 14, 1, '2021-08-27 10:33:02', '2021-09-02 18:12:09', NULL, 1, 1, NULL),
(121, 43, 34, 20, 1, '2021-08-27 12:19:21', '2021-08-27 12:19:35', NULL, 1, 1, NULL),
(122, 43, 33, 21, 1, '2021-08-27 12:19:21', '2021-08-27 12:19:43', NULL, 1, 1, NULL),
(123, 43, 35, 22, 1, '2021-08-27 12:19:21', '2021-08-27 12:19:44', NULL, 1, 1, NULL),
(124, 43, 36, 23, 1, '2021-08-27 12:19:21', '2021-08-27 12:19:44', NULL, 1, 1, NULL),
(125, 43, 32, 24, 1, '2021-08-27 12:19:21', '2021-08-27 12:19:44', NULL, 1, 1, NULL),
(126, 43, 31, 25, 1, '2021-08-27 12:19:21', '2021-08-27 12:19:44', NULL, 1, 1, NULL),
(139, 43, 5, 6, 1, '2021-09-02 14:38:38', NULL, NULL, 1, NULL, NULL),
(140, 43, 8, 4, 1, '2021-09-02 14:38:38', NULL, NULL, 1, NULL, NULL),
(141, 43, 7, 0, 0, '2021-09-02 14:38:38', NULL, NULL, 1, NULL, NULL),
(142, 43, 6, 0, 0, '2021-09-02 14:38:38', NULL, NULL, 1, NULL, NULL),
(143, 43, 9, 0, 0, '2021-09-02 14:38:38', NULL, NULL, 1, NULL, NULL),
(149, 63, 10, 32, 1, '2021-09-03 10:01:22', NULL, NULL, 1, NULL, NULL),
(150, 63, 13, 55, 1, '2021-09-03 10:01:22', NULL, NULL, 1, NULL, NULL),
(151, 63, 12, 68, 1, '2021-09-03 10:01:22', NULL, NULL, 1, NULL, NULL),
(152, 63, 11, 4, 1, '2021-09-03 10:01:23', NULL, NULL, 1, NULL, NULL),
(153, 63, 14, 6, 1, '2021-09-03 10:01:23', NULL, NULL, 1, NULL, NULL),
(154, 63, 34, 12, 1, '2021-09-03 10:04:18', '2021-09-03 10:07:48', NULL, 1, 1, NULL),
(155, 63, 33, 93, 1, '2021-09-03 10:04:18', '2021-09-03 10:07:48', NULL, 1, 1, NULL),
(156, 63, 35, 45, 1, '2021-09-03 10:04:18', '2021-09-03 10:07:48', NULL, 1, 1, NULL),
(157, 63, 36, 40, 1, '2021-09-03 10:04:18', '2021-09-03 10:07:48', NULL, 1, 1, NULL),
(158, 63, 32, 0, 1, '2021-09-03 10:04:18', '2021-09-03 10:07:48', NULL, 1, 1, NULL),
(159, 63, 31, 0, 1, '2021-09-03 10:04:18', '2021-09-03 10:07:48', NULL, 1, 1, NULL),
(171, 65, 10, 3, 1, '2021-09-06 13:18:24', NULL, NULL, 1, NULL, NULL),
(172, 65, 13, 1, 1, '2021-09-06 13:18:24', NULL, NULL, 1, NULL, NULL),
(173, 65, 12, 5, 1, '2021-09-06 13:18:24', NULL, NULL, 1, NULL, NULL),
(174, 65, 11, 0, 0, '2021-09-06 13:18:24', NULL, NULL, 1, NULL, NULL),
(175, 65, 14, 0, 0, '2021-09-06 13:18:24', NULL, NULL, 1, NULL, NULL),
(176, 65, 34, 3, 1, '2021-09-06 13:18:39', NULL, NULL, 1, NULL, NULL),
(177, 65, 33, 0, 0, '2021-09-06 13:18:39', NULL, NULL, 1, NULL, NULL),
(178, 65, 35, 0, 0, '2021-09-06 13:18:39', NULL, NULL, 1, NULL, NULL),
(179, 65, 36, 0, 0, '2021-09-06 13:18:39', NULL, NULL, 1, NULL, NULL),
(180, 65, 32, 0, 0, '2021-09-06 13:18:39', NULL, NULL, 1, NULL, NULL),
(181, 65, 31, 8, 1, '2021-09-06 13:18:39', NULL, NULL, 1, NULL, NULL),
(182, 65, 28, 6, 1, '2021-09-07 10:29:42', NULL, NULL, 1, NULL, NULL),
(183, 65, 27, 5, 1, '2021-09-07 10:29:42', NULL, NULL, 1, NULL, NULL),
(184, 65, 29, 4, 1, '2021-09-07 10:29:42', NULL, NULL, 1, NULL, NULL),
(185, 65, 30, 3, 1, '2021-09-07 10:29:42', NULL, NULL, 1, NULL, NULL),
(186, 65, 26, 2, 1, '2021-09-07 10:29:42', NULL, NULL, 1, NULL, NULL),
(187, 65, 25, 1, 1, '2021-09-07 10:29:42', NULL, NULL, 1, NULL, NULL);

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
  `atualizado_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `resultado`
--

INSERT INTO `resultado` (`id`, `id_meta`, `resultado`, `mes`, `ano`, `justificativa`, `justificativa_aceita`, `criado_em`, `criado_por`, `atualizado_em`, `atualizado_por`) VALUES
(131, 116, 5, 8, 2021, 'aaa', 0, '2021-08-27 11:27:27', 1, '2021-08-31 19:29:48', 1),
(132, 117, 4, 8, 2021, '44', 0, '2021-08-27 11:27:27', 1, '2021-08-31 19:32:52', 1),
(133, 118, 11, 8, 2021, '', 0, '2021-08-27 11:27:27', 1, '2021-08-31 19:27:28', 1),
(134, 119, 7, 8, 2021, 'fg', 0, '2021-08-27 11:27:27', 1, '2021-08-31 19:33:04', 1),
(135, 120, 2, 8, 2021, '', 0, '2021-08-27 11:27:27', 1, '2021-08-31 19:22:15', 1),
(187, 121, 20, 8, 2021, '', 0, '2021-08-27 12:20:08', 1, '2021-08-27 15:41:16', 1),
(188, 122, 2, 8, 2021, '', 0, '2021-08-27 12:20:08', 1, '2021-08-27 15:20:34', 1),
(189, 123, 3, 8, 2021, '', 0, '2021-08-27 12:20:08', 1, '2021-08-27 15:20:34', 1),
(190, 124, 4, 8, 2021, '', 0, '2021-08-27 12:20:08', 1, '2021-08-27 15:20:34', 1),
(191, 125, 5, 8, 2021, '', 0, '2021-08-27 12:20:08', 1, '2021-08-27 15:20:34', 1),
(192, 126, 6, 8, 2021, '', 0, '2021-08-27 12:20:08', 1, '2021-08-27 15:20:34', 1),
(974, 116, 100, 9, 2021, '', 1, '2021-09-01 07:44:28', 1, '2021-09-02 17:52:21', 1),
(975, 117, 2, 9, 2021, 'bbb', 0, '2021-09-01 07:44:28', 1, '2021-09-01 18:59:23', 1),
(976, 118, 3, 9, 2021, '', 0, '2021-09-01 07:44:28', 1, '2021-09-01 12:46:10', 1),
(980, 119, 1, 9, 2021, '', 0, '2021-09-01 09:46:10', 1, '2021-09-01 18:59:23', 1),
(989, 120, 4654, 9, 2021, '', 0, '2021-09-02 14:32:02', 1, '2021-09-02 17:39:24', 1),
(995, 121, 5, 9, 2021, '', 0, '2021-09-02 14:39:24', 1, '2021-09-02 17:43:56', 1),
(996, 122, 1, 9, 2021, '', 0, '2021-09-02 14:39:24', 1, '2021-09-02 17:43:56', 1),
(997, 123, 556, 9, 2021, '', 0, '2021-09-02 14:39:24', 1, '2021-09-02 17:43:57', 1),
(998, 124, 9999, 9, 2021, '', 0, '2021-09-02 14:39:24', 1, '2021-09-02 17:43:57', 1),
(999, 125, 1, 9, 2021, 'hjkh', 0, '2021-09-02 14:39:24', 1, '2021-09-02 17:43:57', 1),
(1050, 149, 25, 9, 2021, 'vhccfcfddzszs', 1, '2021-09-03 10:13:26', 1, '2021-09-05 20:14:58', 1),
(1051, 150, 52, 9, 2021, 'hggfxdsxdx', 1, '2021-09-03 10:13:26', 1, '2021-09-05 20:22:18', 1),
(1052, 151, 78, 9, 2021, '', 0, '2021-09-03 10:13:26', 1, '2021-09-05 20:14:58', 1),
(1053, 152, 5, 9, 2021, '', 0, '2021-09-03 10:13:26', 1, '2021-09-05 20:14:58', 1),
(1054, 153, 3, 9, 2021, '', 0, '2021-09-03 10:13:26', 1, '2021-09-05 20:15:17', 1),
(1055, 154, 58, 9, 2021, '', 0, '2021-09-03 10:13:26', 1, '2021-09-05 20:14:58', 1),
(1056, 155, 98, 9, 2021, '', 0, '2021-09-03 10:13:26', 1, '2021-09-05 20:14:58', 1),
(1057, 156, 58, 9, 2021, '', 0, '2021-09-03 10:13:26', 1, '2021-09-05 20:14:58', 1),
(1058, 157, 45, 9, 2021, '', 0, '2021-09-03 10:13:26', 1, '2021-09-05 20:14:58', 1),
(1059, 159, 52, 9, 2021, '', 0, '2021-09-03 10:13:26', 1, '2021-09-05 20:14:58', 1),
(1180, 176, 1, 9, 2021, 'aaa', 0, '2021-09-06 13:44:04', 1, NULL, NULL),
(1181, 181, 2, 9, 2021, 'bbbb', 0, '2021-09-06 13:44:04', 1, NULL, NULL),
(1182, 171, 2, 9, 2021, '', 0, '2021-09-06 14:01:57', 1, NULL, NULL),
(1183, 172, 1, 9, 2021, '', 0, '2021-09-06 14:01:57', 1, NULL, NULL),
(1184, 173, 6, 9, 2021, '', 0, '2021-09-06 14:01:57', 1, NULL, NULL);

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
(1, 'usuario@email.com', '$2y$12$TVnPBAOX7b6bIiygqf2pJOdBz5j9zAEBRkovyr.UZDJ4d635VUg.q', 1, '612e3b6492261', 1, '61322c06239ef', '1147964069', 11959890399, 'Marcelo de Souza Bravin', 'medico', 'Avenida Francisco Rodrigues Filho', '307.485.238-04', '2021-07-02 10:21:37', '2021-09-03 11:07:02', NULL, 1, 1, 21),
(32, 'mesnovaes@prefeitura.sp.gov.br', '$2y$12$V6IPH1Q/Nrv./iBP6lf2pu9b91c67uAEsw0P0m/QuCoSygyHKKOrq', 0, NULL, 0, NULL, '', 0, 'Meire Ellen', 'enfermeiro', '', '338.059.850-02', '2021-08-09 14:08:05', '2021-09-03 09:47:17', NULL, 1, 1, NULL),
(39, 'markness000@gmail.com', '$2y$12$Mz1gtEdxb9grY92xdQvLR.M7Y1dw704GCEDTDdvsvsHVFgBcgVcVa', 1, '', 0, NULL, '1195989039', 11959890399, 'Marcelo de Souza Bravin', 'medico', 'Avenida Francisco Rodrigues Filho', '547.533.270-35', '2021-08-23 08:34:12', '2021-09-05 17:05:23', NULL, 1, 1, NULL),
(78, 'meiresama@gmail.com', '$2y$12$WkX9/v1iCmkWQTKi/yJ9TuCtd0dQRtSpfkHhDf8NdOL/01JE4NsOO', 0, '61322d6e6d465', 1, NULL, '1133864106', 11974348255, 'Meire Ellen ', '', 'rua cascavel', '221.857.910-36', '2021-09-03 10:39:26', '2021-09-03 11:13:02', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `visita`
--

CREATE TABLE `visita` (
  `id` int(11) NOT NULL,
  `id_meta` int(11) NOT NULL,
  `resultado` int(3) NOT NULL,
  `dia` tinyint(2) NOT NULL,
  `mes` tinyint(2) NOT NULL,
  `ano` int(4) NOT NULL,
  `justificativa` text DEFAULT NULL,
  `justificativa_aceita` tinyint(1) NOT NULL DEFAULT 0,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `criado_por` int(11) NOT NULL,
  `atualizado_em` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `atualizado_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `visita`
--

INSERT INTO `visita` (`id`, `id_meta`, `resultado`, `dia`, `mes`, `ano`, `justificativa`, `justificativa_aceita`, `criado_em`, `criado_por`, `atualizado_em`, `atualizado_por`) VALUES
(2, 171, 1, 0, 9, 2021, 'aaa', 0, '2021-09-06 18:30:48', 1, '2021-09-07 17:19:26', NULL),
(3, 172, 2, 0, 9, 2021, '', 0, '2021-09-06 18:30:48', 1, NULL, NULL),
(4, 173, 3, 0, 9, 2021, 'bb', 0, '2021-09-06 18:30:48', 1, '2021-09-07 17:19:31', NULL),
(5, 176, 4, 0, 9, 2021, '', 0, '2021-09-06 18:30:48', 1, NULL, NULL),
(6, 181, 5, 0, 9, 2021, 'c', 0, '2021-09-06 18:30:48', 1, '2021-09-07 17:19:37', NULL),
(7, 171, 1, 6, 9, 2021, 'aaa', 0, '2021-09-06 18:34:25', 1, NULL, NULL),
(8, 172, 2, 6, 9, 2021, '', 0, '2021-09-06 18:34:25', 1, NULL, NULL),
(9, 173, 3, 6, 9, 2021, 'cccc', 0, '2021-09-06 18:34:25', 1, NULL, NULL),
(10, 176, 4, 6, 9, 2021, '', 0, '2021-09-06 18:34:25', 1, NULL, NULL),
(11, 181, 5, 6, 9, 2021, 'eeee', 0, '2021-09-06 18:34:25', 1, NULL, NULL),
(12, 171, 3, 7, 9, 2021, '', 0, '2021-09-07 08:02:14', 1, NULL, NULL),
(13, 172, 1, 7, 9, 2021, '', 0, '2021-09-07 08:02:14', 1, NULL, NULL),
(14, 173, 5, 7, 9, 2021, '', 0, '2021-09-07 08:02:14', 1, NULL, NULL),
(15, 176, 1, 7, 9, 2021, 'aaa', 0, '2021-09-07 08:02:14', 1, NULL, NULL),
(16, 181, 2, 7, 9, 2021, 'bbb', 0, '2021-09-07 08:02:14', 1, NULL, NULL);

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
(33, 32, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-10 12:48:34'),
(34, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-10 16:51:30'),
(35, 1, 1, '10.46.113.200', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.131 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.131\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-10 17:22:43'),
(36, 1, 1, '10.46.113.200', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.131 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.131\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-10 17:44:43'),
(37, 1, 1, '10.46.113.200', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.131 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.131\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-10 18:46:26'),
(38, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-11 11:09:54'),
(39, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-11 12:15:01'),
(40, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-11 17:04:25'),
(41, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-12 10:47:17'),
(42, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-12 12:11:07'),
(43, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-12 12:45:23'),
(44, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-12 13:40:07'),
(45, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-12 17:31:40'),
(46, 1, 0, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-13 10:30:01'),
(47, 1, 0, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-13 10:30:07'),
(48, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-13 10:33:29'),
(49, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-13 14:26:33'),
(50, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-13 16:56:14'),
(51, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-16 12:04:46'),
(52, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-16 12:54:51'),
(53, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-16 12:56:20'),
(54, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-16 12:57:16'),
(55, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-16 12:59:20'),
(56, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-16 13:00:03'),
(57, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-16 14:39:29'),
(58, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-17 14:08:05'),
(59, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-17 16:55:47'),
(60, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-17 17:53:19'),
(61, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-17 19:22:29'),
(62, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-18 12:48:14'),
(63, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-18 15:27:55'),
(64, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-18 17:12:45'),
(65, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-19 12:55:18'),
(66, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-19 14:01:23'),
(67, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-19 17:26:20'),
(68, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-20 10:50:39'),
(69, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-20 12:08:02'),
(70, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-20 13:41:22'),
(71, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-20 14:48:12'),
(72, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-20 17:44:12'),
(73, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-23 10:53:51'),
(74, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-23 11:33:42'),
(75, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-23 12:04:51'),
(76, 32, 0, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-23 13:15:02'),
(77, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-23 13:15:15'),
(78, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-23 17:52:43'),
(79, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-23 18:39:06'),
(80, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-24 14:40:51'),
(81, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-24 16:44:44'),
(82, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-24 20:51:30'),
(83, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-25 14:26:41'),
(84, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-25 15:51:13'),
(85, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-25 17:43:06'),
(86, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-26 10:41:09'),
(87, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-26 11:16:23'),
(88, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-26 13:36:42'),
(89, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-26 16:52:04'),
(90, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-26 18:08:58'),
(91, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-26 18:37:44'),
(92, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-26 18:37:54'),
(93, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-26 18:38:13'),
(94, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-26 18:38:28'),
(95, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-26 19:03:55'),
(96, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-26 19:05:01'),
(97, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-26 19:25:13'),
(98, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-26 19:27:10'),
(99, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 10:43:18'),
(100, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 11:44:50'),
(101, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 11:45:24'),
(102, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 11:47:38'),
(103, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 11:48:06'),
(104, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 11:48:12'),
(105, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 11:49:10'),
(106, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 11:49:30'),
(107, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 11:49:33'),
(108, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 11:53:37'),
(109, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 11:54:11'),
(110, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 11:56:58'),
(111, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 11:57:06'),
(112, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 11:57:23'),
(113, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (iPad; CPU OS 11_0 like Mac OS X) AppleWebKit/604.1.34 (KHTML, like Gecko) Version/11.0 Mobile/15A5341f Safari/604.1\",\"name\":\"Apple Safari\",\"version\":\"11.0\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Safari|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 12:00:24'),
(114, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Unknown OS Platform\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 12:10:13'),
(115, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 12:27:10'),
(116, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 12:36:41'),
(117, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 12:43:16'),
(118, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (iPad; CPU OS 11_0 like Mac OS X) AppleWebKit/604.1.34 (KHTML, like Gecko) Version/11.0 Mobile/15A5341f Safari/604.1\",\"name\":\"Apple Safari\",\"version\":\"11.0\",\"pattern\":\"#(?<browser>Version|Safari|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 12:43:36'),
(119, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 13:04:54'),
(120, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 17:04:32'),
(121, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 17:26:55'),
(122, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 17:26:58'),
(123, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 17:26:59'),
(124, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 17:27:25'),
(125, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 18:13:34'),
(126, 1, 1, '10.46.116.6', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 19:07:21'),
(127, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 11:02:10'),
(128, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 11:02:32'),
(129, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 11:33:25'),
(130, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 12:09:53'),
(131, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 14:44:56'),
(132, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 14:45:03'),
(133, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 17:19:19'),
(134, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 17:19:27'),
(135, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 18:16:47'),
(136, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 18:17:52'),
(137, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 10:59:26'),
(138, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 10:59:29'),
(139, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 11:35:12'),
(140, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 11:35:15'),
(141, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 11:40:04'),
(142, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 11:40:06'),
(143, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 11:40:06'),
(144, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 11:40:08'),
(145, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 11:40:09'),
(146, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 11:40:27'),
(147, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 11:42:14'),
(148, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 11:42:16'),
(149, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 12:27:05'),
(150, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 12:30:42'),
(151, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 14:22:32'),
(152, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 14:22:40'),
(153, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 17:33:53'),
(154, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 17:34:01'),
(155, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-01 10:42:30'),
(156, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-01 10:42:34'),
(157, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-01 10:58:11'),
(158, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-01 10:58:21'),
(159, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-01 11:40:58'),
(160, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-01 11:41:03'),
(161, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-01 14:24:07'),
(162, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-01 14:24:12'),
(163, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-01 16:55:07'),
(164, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-01 16:55:39'),
(165, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-01 18:01:22'),
(166, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-01 18:01:25'),
(167, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-01 18:58:23'),
(168, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-01 18:58:30'),
(169, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 11:01:42'),
(170, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 11:30:23'),
(171, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 11:31:43'),
(172, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 11:31:56'),
(173, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 13:25:32'),
(174, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 13:25:39'),
(175, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 17:04:44'),
(176, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 17:09:34'),
(177, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 17:26:38'),
(178, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 17:26:41'),
(179, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 17:28:39');
INSERT INTO `_log_acesso` (`id`, `id_usuario`, `sucesso`, `ip`, `navegador`, `datahora`) VALUES
(180, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 17:30:35'),
(181, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 18:45:01'),
(182, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 18:45:04'),
(183, 1, 1, '10.46.112.77', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 19:15:49'),
(184, 1, 1, '10.46.112.77', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 20:07:45'),
(185, 1, -1, '10.46.112.77', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 20:40:51'),
(186, 1, 1, '10.46.112.77', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 20:41:00'),
(187, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 11:20:06'),
(188, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 11:20:12'),
(189, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 11:55:45'),
(190, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 11:55:49'),
(191, 1, 1, '10.46.112.77', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 12:35:20'),
(192, 1, -1, '10.46.112.77', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:31:38'),
(193, 1, 1, '10.46.112.77', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:31:41'),
(194, 1, 1, '10.46.112.77', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:38:34'),
(195, 1, 1, '10.46.112.77', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36 Edg/92.0.902.84\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:47:57'),
(196, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:49:45'),
(197, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:49:51'),
(198, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 14:06:54'),
(199, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 14:09:17'),
(200, 1, -1, '10.46.112.77', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36 Edg/92.0.902.84\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 14:43:58'),
(201, 1, 1, '10.46.112.77', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36 Edg/92.0.902.84\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 14:45:24'),
(202, 1, -1, '10.46.112.77', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36 Edg/92.0.902.84\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 15:48:52'),
(203, 1, 1, '10.46.112.77', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36 Edg/92.0.902.84\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 15:48:57'),
(204, 1, -1, '10.46.112.77', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36 Edg/92.0.902.84\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 15:56:20'),
(205, 1, 1, '10.46.112.77', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36 Edg/92.0.902.84\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 15:58:24'),
(206, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 16:41:26'),
(207, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 16:50:26'),
(208, 1, -1, '10.46.112.77', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36 Edg/92.0.902.84\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 16:52:37'),
(209, 1, 1, '10.46.112.77', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36 Edg/92.0.902.84\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 16:52:55'),
(210, 1, -1, '10.46.112.77', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36 Edg/92.0.902.84\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 17:31:31'),
(211, 1, 1, '10.46.112.77', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36 Edg/92.0.902.84\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 17:31:42'),
(212, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 18:45:47'),
(213, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 18:46:38'),
(214, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 18:48:02'),
(215, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.58 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.58\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-05 16:22:58'),
(216, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.58 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.58\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-05 16:23:04'),
(217, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.58 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.58\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-05 17:34:30'),
(218, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.58 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.58\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-05 17:34:43'),
(219, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.58 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.58\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-05 19:59:30'),
(220, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.58 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.58\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-05 19:59:38'),
(221, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.58 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.58\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-05 20:57:36'),
(222, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.58 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.58\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-05 20:57:42'),
(223, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 16:16:02'),
(224, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 16:16:12'),
(225, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 18:56:49'),
(226, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 18:56:56'),
(227, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 21:09:23'),
(228, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 21:09:30'),
(229, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-07 11:01:21'),
(230, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-07 11:01:26'),
(231, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-07 13:17:46'),
(232, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-07 13:17:52'),
(233, 1, -1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-07 17:15:27'),
(234, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-07 17:15:33');

-- --------------------------------------------------------

--
-- Estrutura da tabela `_log_operacoes`
--

CREATE TABLE `_log_operacoes` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL COMMENT 'Id do usuário que realizou a operação',
  `acao` set('I','U','D','X') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'I: insert\r\nU: update\r\nD: delete\r\nX: exclusão lógica',
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
(289, 1, 'U', 'meta', 131, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 14:37:53'),
(290, 1, 'U', 'meta', 132, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 14:37:54'),
(291, 1, 'U', 'resultado', 131, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:06:40'),
(292, 1, 'U', 'resultado', 132, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:06:40'),
(293, 1, 'U', 'resultado', 132, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:06:54'),
(294, 1, 'U', 'resultado', 135, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:06:54'),
(295, 1, 'U', 'resultado', 135, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:07:01'),
(296, 1, 'U', 'resultado', 135, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:16:57'),
(297, 1, 'I', 'meta', 121, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:19:21'),
(298, 1, 'I', 'meta', 122, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:19:21'),
(299, 1, 'I', 'meta', 123, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:19:21'),
(300, 1, 'I', 'meta', 124, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:19:21'),
(301, 1, 'I', 'meta', 125, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:19:21'),
(302, 1, 'I', 'meta', 126, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:19:21'),
(303, 1, 'U', 'meta', 121, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:19:35'),
(304, 1, 'U', 'meta', 122, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:19:35'),
(305, 1, 'U', 'meta', 123, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:19:35'),
(306, 1, 'U', 'meta', 124, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:19:35'),
(307, 1, 'U', 'meta', 125, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:19:35'),
(308, 1, 'U', 'meta', 126, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:19:35'),
(309, 1, 'U', 'meta', 122, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:19:44'),
(310, 1, 'U', 'meta', 123, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:19:44'),
(311, 1, 'U', 'meta', 124, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:19:44'),
(312, 1, 'U', 'meta', 125, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:19:44'),
(313, 1, 'U', 'meta', 126, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:19:44'),
(314, 1, 'I', 'resultado', 187, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:20:08'),
(315, 1, 'I', 'resultado', 188, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:20:08'),
(316, 1, 'I', 'resultado', 189, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:20:08'),
(317, 1, 'I', 'resultado', 190, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:20:08'),
(318, 1, 'I', 'resultado', 191, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:20:08'),
(319, 1, 'I', 'resultado', 192, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:20:08'),
(320, 1, 'U', 'resultado', 187, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:20:33'),
(321, 1, 'U', 'resultado', 188, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:20:34'),
(322, 1, 'U', 'resultado', 189, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:20:34'),
(323, 1, 'U', 'resultado', 190, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:20:34'),
(324, 1, 'U', 'resultado', 191, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:20:34'),
(325, 1, 'U', 'resultado', 192, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:20:34'),
(326, 1, 'U', 'resultado', 187, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-27 15:41:16'),
(327, 1, 'D', 'hospital', 55, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 14:45:16'),
(328, 1, 'D', 'hospital', 56, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 14:45:19'),
(329, 1, 'D', 'hospital', 57, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 14:45:22'),
(330, 1, 'D', 'hospital', 58, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 14:45:25'),
(331, 1, 'D', 'hospital', 59, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 14:45:28'),
(332, 1, 'D', 'hospital', 60, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 14:45:32'),
(333, 1, 'D', 'hospital', 61, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 14:45:35'),
(334, 1, 'D', 'hospital', 53, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 14:45:37'),
(335, 1, 'D', 'hospital', 52, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 14:45:40'),
(336, 1, 'D', 'hospital', 50, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 14:45:42'),
(337, 1, 'D', 'hospital', 49, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 14:45:44'),
(338, 1, 'D', 'hospital', 48, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 14:45:48'),
(339, 1, 'D', 'hospital', 3, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 14:45:54'),
(340, 1, 'D', 'hospital', 1, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 14:45:56'),
(341, 1, 'X', 'hospital', 43, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 14:45:58'),
(342, 1, 'D', 'hospital', 4, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 14:46:01'),
(343, 1, 'I', 'hospital', 62, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 17:35:04'),
(344, 1, 'U', 'hospital', 62, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 17:40:35'),
(345, 1, 'U', 'hospital', 62, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 18:21:49'),
(346, 1, 'I', 'usuario', 41, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 12:33:23'),
(347, 1, 'D', 'usuario', 41, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 12:35:16'),
(348, 1, 'I', 'usuario', 43, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 12:35:46'),
(349, 1, 'I', 'usuario', 51, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 12:39:30'),
(350, 1, 'I', 'usuario', 53, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 12:39:56'),
(351, 1, 'I', 'usuario', 54, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 12:40:41'),
(352, 1, 'I', 'usuario', 56, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 12:40:57'),
(353, 1, 'I', 'usuario', 57, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 12:41:16'),
(354, 1, 'I', 'usuario', 59, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 12:41:53'),
(355, 1, 'I', 'usuario', 61, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 12:48:48'),
(356, 1, 'I', 'usuario', 63, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 13:12:47'),
(357, 1, 'I', 'usuario', 65, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 13:18:07'),
(358, 1, 'I', 'usuario', 71, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 13:21:17'),
(359, 1, 'I', 'usuario', 1, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 13:33:55'),
(360, 1, 'I', 'usuario', 1, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 13:34:30'),
(361, 1, 'I', 'usuario', 1, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 14:23:07'),
(362, 1, 'I', 'usuario', 1, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 14:23:32'),
(363, 1, 'I', 'usuario', 73, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 14:24:26'),
(364, 1, 'U', 'resultado', 131, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 17:34:17'),
(365, 1, 'U', 'resultado', 132, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 17:34:31'),
(366, 1, 'U', 'resultado', 132, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 17:38:01'),
(367, 1, 'U', 'resultado', 132, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 17:38:35'),
(368, 1, 'U', 'resultado', 131, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 17:48:55'),
(369, 1, 'U', 'resultado', 133, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 18:08:02'),
(370, 1, 'U', 'resultado', 133, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 18:12:48'),
(371, 1, 'U', 'resultado', 134, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 18:13:35'),
(372, 1, 'U', 'resultado', 134, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 18:15:06'),
(373, 1, 'U', 'resultado', 131, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 18:32:50'),
(374, 1, 'U', 'resultado', 134, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 19:14:38'),
(375, 1, 'U', 'resultado', 133, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 19:14:47'),
(376, 1, 'U', 'resultado', 132, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 19:20:54'),
(377, 1, 'U', 'resultado', 133, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 19:21:15'),
(378, 1, 'U', 'resultado', 133, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 19:21:39'),
(379, 1, 'U', 'resultado', 135, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 19:22:15'),
(380, 1, 'U', 'resultado', 133, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 19:27:28'),
(381, 1, 'U', 'resultado', 131, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 19:29:48'),
(382, 1, 'U', 'resultado', 134, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 19:29:57'),
(383, 1, 'U', 'resultado', 132, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 19:32:53'),
(384, 1, 'U', 'resultado', 134, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-31 19:33:04'),
(385, 1, 'I', 'resultado', 974, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-01 10:44:28'),
(386, 1, 'I', 'resultado', 975, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-01 10:44:28'),
(387, 1, 'I', 'resultado', 976, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-01 10:44:28'),
(388, 1, 'U', 'resultado', 974, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-01 12:46:09'),
(389, 1, 'U', 'resultado', 975, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-01 12:46:09'),
(390, 1, 'U', 'resultado', 976, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-01 12:46:10'),
(391, 1, 'I', 'resultado', 980, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-01 12:46:10'),
(392, 1, 'U', 'resultado', 975, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-01 18:59:23'),
(393, 1, 'U', 'resultado', 980, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-01 18:59:23'),
(394, 1, 'I', 'resultado', 989, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 17:32:02'),
(395, 1, 'I', 'meta', 139, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 17:38:38'),
(396, 1, 'I', 'meta', 140, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 17:38:38'),
(397, 1, 'I', 'meta', 141, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 17:38:38'),
(398, 1, 'I', 'meta', 142, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 17:38:38'),
(399, 1, 'I', 'meta', 143, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 17:38:38'),
(400, 1, 'U', 'resultado', 989, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 17:39:24'),
(401, 1, 'I', 'resultado', 995, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 17:39:24'),
(402, 1, 'I', 'resultado', 996, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 17:39:24'),
(403, 1, 'I', 'resultado', 997, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 17:39:24'),
(404, 1, 'I', 'resultado', 998, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 17:39:24'),
(405, 1, 'I', 'resultado', 999, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 17:39:24'),
(406, 1, 'U', 'resultado', 974, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 17:43:56'),
(407, 1, 'U', 'resultado', 995, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 17:43:56'),
(408, 1, 'U', 'resultado', 996, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 17:43:56'),
(409, 1, 'U', 'resultado', 997, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 17:43:57'),
(410, 1, 'U', 'resultado', 998, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 17:43:57'),
(411, 1, 'U', 'resultado', 999, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 17:43:57'),
(412, 1, 'U', 'resultado', 974, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 17:44:16'),
(413, 1, 'U', 'resultado', 974, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 17:44:30'),
(414, 1, 'U', 'resultado', 974, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 17:52:21'),
(415, 1, 'U', 'hospital', 62, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 18:01:27'),
(416, 1, 'U', 'meta', 116, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/92.0.4515.159 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 21:12:09'),
(417, 1, 'U', 'meta', 117, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/92.0.4515.159 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 21:12:09'),
(418, 1, 'U', 'meta', 118, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/92.0.4515.159 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 21:12:09'),
(419, 1, 'U', 'meta', 119, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/92.0.4515.159 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 21:12:09'),
(420, 1, 'U', 'meta', 120, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/92.0.4515.159 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-02 21:12:09'),
(421, 1, 'I', 'hospital', 63, '10.46.112.77', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 12:44:33'),
(422, 1, 'U', 'usuario', 32, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 12:47:17'),
(423, 1, 'U', 'hospital', 63, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 12:53:46'),
(424, 1, 'I', 'meta', 149, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:01:22'),
(425, 1, 'I', 'meta', 150, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:01:22'),
(426, 1, 'I', 'meta', 151, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:01:22'),
(427, 1, 'I', 'meta', 152, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:01:23');
INSERT INTO `_log_operacoes` (`id`, `id_usuario`, `acao`, `tabela`, `objetoId`, `ip`, `navegador`, `datahora`) VALUES
(428, 1, 'I', 'meta', 153, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:01:23'),
(429, 1, 'I', 'meta', 154, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:04:18'),
(430, 1, 'I', 'meta', 155, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:04:18'),
(431, 1, 'I', 'meta', 156, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:04:18'),
(432, 1, 'I', 'meta', 157, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:04:18'),
(433, 1, 'I', 'meta', 158, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:04:18'),
(434, 1, 'I', 'meta', 159, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:04:18'),
(435, 1, 'U', 'meta', 154, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:07:48'),
(436, 1, 'U', 'meta', 155, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:07:48'),
(437, 1, 'U', 'meta', 156, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:07:48'),
(438, 1, 'U', 'meta', 157, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:07:48'),
(439, 1, 'U', 'meta', 158, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:07:48'),
(440, 1, 'U', 'meta', 159, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:07:48'),
(441, 1, 'I', 'resultado', 1050, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:13:26'),
(442, 1, 'I', 'resultado', 1051, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:13:26'),
(443, 1, 'I', 'resultado', 1052, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:13:26'),
(444, 1, 'I', 'resultado', 1053, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:13:26'),
(445, 1, 'I', 'resultado', 1054, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:13:26'),
(446, 1, 'I', 'resultado', 1055, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:13:26'),
(447, 1, 'I', 'resultado', 1056, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:13:26'),
(448, 1, 'I', 'resultado', 1057, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:13:26'),
(449, 1, 'I', 'resultado', 1058, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:13:26'),
(450, 1, 'I', 'resultado', 1059, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:13:27'),
(451, 1, 'I', 'usuario', 74, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:28:44'),
(452, 1, 'I', 'usuario', 78, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:39:26'),
(453, 1, 'U', 'usuario', 1, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 13:43:52'),
(454, 1, 'I', 'hospital', 64, '10.46.112.77', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36 Edg/92.0.902.84\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 14:52:07'),
(455, 1, 'U', 'meta', 116, '10.46.112.77', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/92.0.4515.159 Safari\\/537.36 Edg\\/92.0.902.84\",\"name\":\"Google Chrome\",\"version\":\"92.0.4515.159\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-03 15:53:31'),
(456, 1, 'I', 'hospital', 65, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.58 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.58\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-05 16:36:26'),
(457, 1, 'U', 'resultado', 1050, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.58 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.58\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-05 20:14:58'),
(458, 1, 'U', 'resultado', 1051, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.58 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.58\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-05 20:14:58'),
(459, 1, 'U', 'resultado', 1052, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.58 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.58\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-05 20:14:58'),
(460, 1, 'U', 'resultado', 1053, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.58 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.58\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-05 20:14:58'),
(461, 1, 'U', 'resultado', 1054, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.58 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.58\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-05 20:14:58'),
(462, 1, 'U', 'resultado', 1055, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.58 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.58\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-05 20:14:58'),
(463, 1, 'U', 'resultado', 1056, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.58 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.58\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-05 20:14:58'),
(464, 1, 'U', 'resultado', 1057, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.58 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.58\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-05 20:14:58'),
(465, 1, 'U', 'resultado', 1058, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.58 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.58\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-05 20:14:58'),
(466, 1, 'U', 'resultado', 1059, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.58 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.58\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-05 20:14:58'),
(467, 1, 'U', 'resultado', 1054, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.58 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.58\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-05 20:15:09'),
(468, 1, 'U', 'resultado', 1054, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.58 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.58\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-05 20:15:17'),
(469, 1, 'U', 'hospital', 65, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 16:16:46'),
(470, 1, 'I', 'meta', 171, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 16:18:24'),
(471, 1, 'I', 'meta', 172, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 16:18:24'),
(472, 1, 'I', 'meta', 173, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 16:18:24'),
(473, 1, 'I', 'meta', 174, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 16:18:24'),
(474, 1, 'I', 'meta', 175, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 16:18:24'),
(475, 1, 'I', 'meta', 176, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 16:18:39'),
(476, 1, 'I', 'meta', 177, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 16:18:39'),
(477, 1, 'I', 'meta', 178, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 16:18:39'),
(478, 1, 'I', 'meta', 179, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 16:18:39'),
(479, 1, 'I', 'meta', 180, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 16:18:39'),
(480, 1, 'I', 'meta', 181, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 16:18:39'),
(481, 1, 'I', 'resultado', 1180, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 16:44:04'),
(482, 1, 'I', 'resultado', 1181, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 16:44:04'),
(483, 1, 'I', 'resultado', 1182, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 17:01:57'),
(484, 1, 'I', 'resultado', 1183, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 17:01:57'),
(485, 1, 'I', 'resultado', 1184, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 17:01:57'),
(486, 1, 'I', 'visita', 2, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 21:30:48'),
(487, 1, 'I', 'visita', 3, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 21:30:48'),
(488, 1, 'I', 'visita', 4, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 21:30:48'),
(489, 1, 'I', 'visita', 5, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 21:30:48'),
(490, 1, 'I', 'visita', 6, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 21:30:48'),
(491, 1, 'I', 'visita', 7, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 21:34:25'),
(492, 1, 'I', 'visita', 8, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 21:34:25'),
(493, 1, 'I', 'visita', 9, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 21:34:25'),
(494, 1, 'I', 'visita', 10, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 21:34:25'),
(495, 1, 'I', 'visita', 11, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-06 21:34:25'),
(496, 1, 'I', 'visita', 12, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-07 11:02:14'),
(497, 1, 'I', 'visita', 13, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-07 11:02:14'),
(498, 1, 'I', 'visita', 14, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-07 11:02:14'),
(499, 1, 'I', 'visita', 15, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-07 11:02:14'),
(500, 1, 'I', 'visita', 16, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-07 11:02:14'),
(501, 1, 'I', 'meta', 182, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-07 13:29:42'),
(502, 1, 'I', 'meta', 183, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-07 13:29:42'),
(503, 1, 'I', 'meta', 184, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-07 13:29:42'),
(504, 1, 'I', 'meta', 185, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-07 13:29:42'),
(505, 1, 'I', 'meta', 186, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-07 13:29:42'),
(506, 1, 'I', 'meta', 187, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/93.0.4577.63 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"93.0.4577.63\",\"platform\":\"Windows 10\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-09-07 13:29:42');

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
  ADD UNIQUE KEY `cnes` (`cnes`),
  ADD UNIQUE KEY `cnpj` (`cnpj`),
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
-- Índices para tabela `visita`
--
ALTER TABLE `visita`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_meta` (`id_meta`,`dia`,`mes`,`ano`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de tabela `meta`
--
ALTER TABLE `meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT de tabela `resultado`
--
ALTER TABLE `resultado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1185;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de tabela `visita`
--
ALTER TABLE `visita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `_log_acesso`
--
ALTER TABLE `_log_acesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT de tabela `_log_operacoes`
--
ALTER TABLE `_log_operacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=507;

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
