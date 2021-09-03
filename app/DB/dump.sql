-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 30-Ago-2021 às 19:46
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 8.0.3

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
(43, 'CARLOS ALBERTO DE NOBREGA JUNIOR', 1, 0, 0, '', '', 00000000, '', NULL, NULL, NULL, '', '', '2021-08-09 15:30:41', '2021-08-30 11:45:58', '2021-08-30 11:45:58', 1, NULL, 1),
(62, 'Hospital 9 de Julho', 0, 312123, 0, 'Décio Carvalho', 'Segundo responsável', 08773380, 'Avenida Francisco Rodrigues Filho', 'Vila Mogilar', 'Mogi das Cruzes', 'SP', '', '', '2021-08-30 14:35:04', '2021-08-30 14:40:35', NULL, 1, 1, NULL);

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
(116, 43, 10, 10, 1, '2021-08-27 10:33:02', NULL, NULL, 1, NULL, NULL),
(117, 43, 13, 11, 1, '2021-08-27 10:33:02', NULL, NULL, 1, NULL, NULL),
(118, 43, 12, 12, 1, '2021-08-27 10:33:02', NULL, NULL, 1, NULL, NULL),
(119, 43, 11, 13, 1, '2021-08-27 10:33:02', NULL, NULL, 1, NULL, NULL),
(120, 43, 14, 14, 1, '2021-08-27 10:33:02', NULL, NULL, 1, NULL, NULL),
(121, 43, 34, 20, 1, '2021-08-27 12:19:21', '2021-08-27 12:19:35', NULL, 1, 1, NULL),
(122, 43, 33, 21, 1, '2021-08-27 12:19:21', '2021-08-27 12:19:43', NULL, 1, 1, NULL),
(123, 43, 35, 22, 1, '2021-08-27 12:19:21', '2021-08-27 12:19:44', NULL, 1, 1, NULL),
(124, 43, 36, 23, 1, '2021-08-27 12:19:21', '2021-08-27 12:19:44', NULL, 1, 1, NULL),
(125, 43, 32, 24, 1, '2021-08-27 12:19:21', '2021-08-27 12:19:44', NULL, 1, 1, NULL),
(126, 43, 31, 25, 1, '2021-08-27 12:19:21', '2021-08-27 12:19:44', NULL, 1, 1, NULL);

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
(131, 116, 1, 8, 2021, '', 0, '2021-08-27 11:27:27', 1, '2021-08-27 15:06:40', 1),
(132, 117, 1, 8, 2021, '', 0, '2021-08-27 11:27:27', 1, '2021-08-27 15:06:54', 1),
(133, 118, 5, 8, 2021, '', 0, '2021-08-27 11:27:27', 1, '2021-08-27 14:37:08', 1),
(134, 119, 2, 8, 2021, '', 0, '2021-08-27 11:27:27', 1, '2021-08-27 14:37:08', 1),
(135, 120, 1, 8, 2021, '', 0, '2021-08-27 11:27:27', 1, '2021-08-27 15:16:57', 1),
(187, 121, 20, 8, 2021, '', 0, '2021-08-27 12:20:08', 1, '2021-08-27 15:41:16', 1),
(188, 122, 2, 8, 2021, '', 0, '2021-08-27 12:20:08', 1, '2021-08-27 15:20:34', 1),
(189, 123, 3, 8, 2021, '', 0, '2021-08-27 12:20:08', 1, '2021-08-27 15:20:34', 1),
(190, 124, 4, 8, 2021, '', 0, '2021-08-27 12:20:08', 1, '2021-08-27 15:20:34', 1),
(191, 125, 5, 8, 2021, '', 0, '2021-08-27 12:20:08', 1, '2021-08-27 15:20:34', 1),
(192, 126, 6, 8, 2021, '', 0, '2021-08-27 12:20:08', 1, '2021-08-27 15:20:34', 1);

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
(40, 'markness@hotmail.com', '$2y$12$qvLLKPgiukFqWwvokYB6K.689J1flV3gMKTsiM0su6xIe.iEuvzoq', 1, '', 1, NULL, '', 45646546456, '', 'administrador', '', '318.661.650-62', '2021-08-24 18:15:42', '2021-08-24 18:22:44', NULL, 1, NULL, NULL);

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
(134, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 17:19:27');

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
(344, 1, 'U', 'hospital', 62, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"Linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-30 17:40:35');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de tabela `meta`
--
ALTER TABLE `meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT de tabela `resultado`
--
ALTER TABLE `resultado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `_log_acesso`
--
ALTER TABLE `_log_acesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT de tabela `_log_operacoes`
--
ALTER TABLE `_log_operacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=345;

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
