-- --------------------------------------------------------
-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2021 at 08:19 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7
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
CREATE DATABASE IF NOT EXISTS `db_relatorio_ocupacao_hospitalar` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db_relatorio_ocupacao_hospitalar`;


-- --------------------------------------------------------

--
-- Table structure for table `categoria`
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
-- Dumping data for table `categoria`
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
-- Table structure for table `elemento`
--

CREATE TABLE `elemento` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
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
-- Dumping data for table `elemento`
--

INSERT INTO `elemento` (`id`, `categoria_id`, `titulo`, `ativo`, `criado_em`, `atualizado_em`, `excluido_em`, `criado_por`, `atualizado_por`, `excluido_por`) VALUES
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
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `id` int(11) NOT NULL,
  `titulo` char(255) NOT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `excluido_em` datetime DEFAULT NULL,
  `criado_por` int(11) NOT NULL,
  `atualizado_por` int(11) DEFAULT NULL,
  `excluido_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`id`, `titulo`, `ativo`, `criado_em`, `atualizado_em`, `excluido_em`, `criado_por`, `atualizado_por`, `excluido_por`) VALUES
(1, 'São Luiz Gonzaga', 1, '2021-07-04 18:58:48', '2021-07-17 12:53:53', NULL, 1, 0, 1),
(75, 'São João', 1, '2021-07-17 12:25:01', '2021-07-17 12:53:59', '2021-07-17 12:53:59', 9, NULL, 9),
(78, 'sd', NULL, '2021-07-18 09:24:45', NULL, NULL, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `meta`
--

CREATE TABLE `meta` (
  `id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `elemento_id` int(11) NOT NULL,
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
-- Dumping data for table `meta`
--

INSERT INTO `meta` (`id`, `hospital_id`, `elemento_id`, `quantidade`, `ativo`, `criado_em`, `atualizado_em`, `excluido_em`, `criado_por`, `atualizado_por`, `excluido_por`) VALUES
(175, 1, 10, 10, 1, '2021-07-13 11:09:35', '2021-07-13 15:12:56', '0000-00-00 00:00:00', 1, 1, 0),
(176, 1, 13, 10, 1, '2021-07-13 11:09:36', '2021-07-13 15:12:56', '0000-00-00 00:00:00', 1, 1, 0),
(177, 1, 12, 12, 1, '2021-07-13 11:09:36', '2021-07-13 15:12:56', '0000-00-00 00:00:00', 1, 1, 0),
(178, 1, 11, 13, 1, '2021-07-13 11:09:36', '2021-07-13 15:12:57', '0000-00-00 00:00:00', 1, 1, 0),
(179, 1, 14, 14, 1, '2021-07-13 11:09:36', '2021-07-13 15:12:57', '0000-00-00 00:00:00', 1, 1, 0),
(180, 1, 34, 100, 1, '2021-07-13 11:12:16', '2021-07-14 10:53:02', '0000-00-00 00:00:00', 1, 1, 0),
(181, 1, 33, 11, 1, '2021-07-13 11:12:16', '2021-07-14 10:53:02', '0000-00-00 00:00:00', 1, 1, 0),
(182, 1, 35, 12, 1, '2021-07-13 11:12:16', '2021-07-14 10:53:02', '0000-00-00 00:00:00', 1, 1, 0),
(183, 1, 36, 13, 1, '2021-07-13 11:12:17', '2021-07-14 10:53:02', '0000-00-00 00:00:00', 1, 1, 0),
(184, 1, 32, 14, 1, '2021-07-13 11:12:17', '2021-07-14 10:53:02', '0000-00-00 00:00:00', 1, 1, 0),
(185, 1, 31, 15, 1, '2021-07-13 11:12:17', '2021-07-14 10:53:02', '0000-00-00 00:00:00', 1, 1, 0),
(186, 1, 15, 10, 1, '2021-07-13 12:12:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(187, 1, 18, 20, 1, '2021-07-13 12:12:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(188, 1, 17, 30, 1, '2021-07-13 12:12:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(189, 1, 16, 40, 1, '2021-07-13 12:12:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(190, 1, 19, 50, 1, '2021-07-13 12:12:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(191, 1, 28, 10, 0, '2021-07-13 14:53:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(192, 1, 27, 9, 0, '2021-07-13 14:53:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(193, 1, 29, 8, 0, '2021-07-13 14:53:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(194, 1, 30, 7, 0, '2021-07-13 14:53:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(195, 1, 26, 6, 0, '2021-07-13 14:53:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(196, 1, 25, 5, 0, '2021-07-13 14:53:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(197, 1, 2, 4, 1, '2021-07-13 15:12:54', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(198, 1, 1, 3, 0, '2021-07-13 15:12:54', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(199, 1, 4, 2, 1, '2021-07-13 15:12:54', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(200, 1, 3, 1, 0, '2021-07-13 15:12:54', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(206, 1, 5, 9999, 1, '2021-07-13 15:27:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(207, 1, 8, 999, 0, '2021-07-13 15:27:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(208, 1, 7, 99, 0, '2021-07-13 15:27:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(209, 1, 6, 9, 0, '2021-07-13 15:27:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(210, 1, 9, 1, 0, '2021-07-13 15:27:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(211, 75, 10, 99, 1, '2021-07-17 12:34:01', NULL, NULL, 9, NULL, NULL),
(212, 75, 13, 0, 0, '2021-07-17 12:34:01', NULL, NULL, 9, NULL, NULL),
(213, 75, 12, 0, 0, '2021-07-17 12:34:01', NULL, NULL, 9, NULL, NULL),
(214, 75, 11, 0, 0, '2021-07-17 12:34:01', NULL, NULL, 9, NULL, NULL),
(215, 75, 14, 0, 0, '2021-07-17 12:34:01', NULL, NULL, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `resultado`
--

CREATE TABLE `resultado` (
  `id` int(11) NOT NULL,
  `meta_id` int(11) NOT NULL,
  `resultado` int(3) NOT NULL,
  `mes` tinyint(2) NOT NULL,
  `ano` int(4) NOT NULL,
  `justificativa` text DEFAULT NULL,
  `justificativa_aceita` tinyint(1) NOT NULL,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `criado_por` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `resultado`
--

INSERT INTO `resultado` (`id`, `meta_id`, `resultado`, `mes`, `ano`, `justificativa`, `justificativa_aceita`, `criado_em`, `criado_por`) VALUES
(73, 175, 1, 7, 2021, '', 0, '2021-07-13 11:32:02', 1),
(74, 176, 2, 7, 2021, '', 0, '2021-07-13 11:32:02', 1),
(75, 177, 3, 7, 2021, '', 0, '2021-07-13 11:32:02', 1),
(76, 178, 4, 7, 2021, '', 0, '2021-07-13 11:32:02', 1),
(77, 179, 5, 7, 2021, '', 0, '2021-07-13 11:32:02', 1),
(78, 180, 11, 7, 2021, '', 0, '2021-07-13 11:32:41', 1),
(79, 181, 10, 7, 2021, 'Foi fo', 0, '2021-07-13 11:32:41', 1),
(80, 182, 9, 7, 2021, 'foi muito f', 1, '2021-07-13 11:32:41', 1),
(81, 183, 1, 7, 2021, '', 0, '2021-07-13 11:32:41', 1),
(82, 184, 2, 7, 2021, '', 0, '2021-07-13 11:32:41', 1),
(83, 185, 3, 7, 2021, '', 0, '2021-07-13 11:32:41', 1),
(84, 186, 1, 7, 2021, 'Teste aceito', 1, '2021-07-13 12:29:14', 1),
(85, 187, 1, 7, 2021, 'Teste não aceito', 0, '2021-07-13 12:29:14', 1),
(86, 188, 10, 7, 2021, 'Teste 10 aceito', 1, '2021-07-13 12:29:14', 1),
(87, 189, 40, 7, 2021, '', 0, '2021-07-13 12:29:14', 1),
(88, 190, 51, 7, 2021, '', 0, '2021-07-13 12:29:14', 1),
(89, 206, 9999, 7, 2021, '', 0, '2021-07-13 15:28:07', 1),
(90, 207, 999, 7, 2021, '', 0, '2021-07-13 15:28:07', 1),
(91, 208, 99, 7, 2021, '', 0, '2021-07-13 15:28:07', 1),
(92, 209, 9, 7, 2021, '', 0, '2021-07-13 15:28:07', 1),
(93, 210, 2, 7, 2021, '', 0, '2021-07-13 15:28:07', 1),
(94, 197, 3, 7, 2021, 'Fliege', 1, '2021-07-13 15:31:01', 1),
(95, 198, 2, 7, 2021, 'Tanz', 1, '2021-07-13 15:31:01', 1),
(96, 199, 1, 7, 2021, 'Faun', 1, '2021-07-13 15:31:01', 1),
(97, 200, 0, 7, 2021, 'Nebel', 0, '2021-07-13 15:31:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `login` char(60) NOT NULL,
  `senha` char(60) NOT NULL,
  `email_confirmado` tinyint(1) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `reset` varchar(50) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
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
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `login`, `senha`, `email_confirmado`, `token`, `ativo`, `reset`, `telefone`, `nome`, `endereco`, `cpf`, `criado_em`, `atualizado_em`, `excluido_em`, `criado_por`, `atualizado_por`, `excluido_por`) VALUES
(1, 'usuario@email.com', '$2y$12$3zjkKY6O7CEOh43aqmaCru2D3C8z1csk.WZy6dH7IyYC0fuVBwhcC', 1, '', 0, '', '', '', '', '', '2021-07-02 10:21:37', '2021-07-17 12:56:03', '2021-07-17 12:56:03', 1, 0, 9),
(9, 'usuario2a@email.com', '$2y$12$0l2P0uhv22U1Iw9irB8fMeCqapt1YHMHREga3D.S.chTimimU5ObO', 0, NULL, 1, '', '(11) 95989-0399', 'Marcelo de Souza Bravin', 'Avenida Francisco Rodrigues Filho, 1902', '30748523804', '2021-07-17 12:21:36', '2021-07-17 19:19:15', NULL, 1, NULL, NULL),
(11, '1@2.com', '$2y$12$Dmwy45l6mEQBHEfVii0vyupj82b9MfPzzpUxIFI9B5P6Id.yDyDku', 0, NULL, 1, NULL, '', '', 'Avenida Francisco Rodrigues Filho, 1902', '307.485.238-04', '2021-07-18 11:17:22', '2021-07-18 13:19:12', NULL, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `_log_acesso`
--

CREATE TABLE `_log_acesso` (
  `id` int(11) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  `sucesso` tinyint(1) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `navegador` varchar(400) NOT NULL,
  `datahora` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_log_acesso`
--

INSERT INTO `_log_acesso` (`id`, `usuarioId`, `sucesso`, `ip`, `navegador`, `datahora`) VALUES
(1, 9, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-17 15:24:46'),
(2, 9, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-17 22:46:21');

-- --------------------------------------------------------

--
-- Table structure for table `_log_operacoes`
--

CREATE TABLE `_log_operacoes` (
  `id` int(11) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  `acao` char(1) NOT NULL,
  `tabela` varchar(50) NOT NULL,
  `objetoId` int(11) NOT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `navegador` varchar(400) NOT NULL,
  `datahora` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_log_operacoes`
--

INSERT INTO `_log_operacoes` (`id`, `usuarioId`, `acao`, `tabela`, `objetoId`, `ip`, `navegador`, `datahora`) VALUES
(1, 1, 'D', 'hospital', 74, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-17 15:20:36'),
(2, 1, 'd', 'hospital', 1, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-17 15:20:39'),
(3, 1, 'D', 'usuario', 8, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-17 15:20:45'),
(4, 1, 'D', 'usuario', 7, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-17 15:20:49'),
(5, 1, 'D', 'usuario', 6, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-17 15:20:54'),
(6, 1, 'I', 'usuario', 9, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-17 15:21:36'),
(7, 9, 'I', 'hospital', 75, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-17 15:25:01'),
(8, 9, 'd', 'usuario', 1, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-17 15:25:24'),
(9, 9, 'd', 'hospital', 75, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-17 15:34:08'),
(10, 9, 'd', 'hospital', 75, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-17 15:53:59'),
(11, 9, 'd', 'usuario', 1, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-17 15:56:03'),
(12, 9, 'I', 'usuario', 10, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-17 16:50:37'),
(13, 9, 'D', 'usuario', 10, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-17 16:50:43'),
(14, 9, 'U', 'usuario', 9, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-17 16:56:01'),
(15, 9, 'U', 'usuario', 9, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-17 20:48:32'),
(16, 9, 'U', 'usuario', 9, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-17 20:52:19'),
(17, 9, 'U', 'usuario', 9, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-17 21:41:44'),
(18, 9, 'U', 'usuario', 9, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-17 21:49:48'),
(19, 9, 'U', 'usuario', 9, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-17 22:04:40'),
(20, 9, 'U', 'usuario', 9, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-17 22:19:15'),
(21, 9, 'I', 'hospital', 76, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-18 12:15:46'),
(22, 9, 'I', 'hospital', 77, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-18 12:15:56'),
(23, 9, 'U', 'hospital', 77, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-18 12:24:22'),
(24, 9, 'U', 'hospital', 77, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-18 12:24:27'),
(25, 9, 'D', 'hospital', 77, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-18 12:24:31'),
(26, 9, 'D', 'hospital', 76, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-18 12:24:35'),
(27, 9, 'I', 'hospital', 78, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-18 12:24:45'),
(28, 9, 'I', 'usuario', 11, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-18 14:17:22'),
(29, 9, 'I', 'usuario', 12, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-18 14:18:47'),
(30, 9, 'U', 'usuario', 11, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-18 15:14:05'),
(31, 9, 'U', 'usuario', 11, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-18 15:14:49'),
(32, 9, 'U', 'usuario', 11, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-18 15:16:38'),
(33, 9, 'U', 'usuario', 11, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-18 15:16:43'),
(34, 9, 'U', 'usuario', 11, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-18 15:22:25'),
(35, 9, 'U', 'usuario', 11, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-18 15:22:32'),
(36, 9, 'U', 'usuario', 11, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-18 15:23:21'),
(37, 9, 'U', 'usuario', 11, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-18 15:23:23'),
(38, 9, 'U', 'usuario', 11, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-18 15:23:32'),
(39, 9, 'U', 'usuario', 11, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-18 15:28:29'),
(40, 9, 'U', 'usuario', 11, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-18 15:28:55'),
(41, 9, 'U', 'usuario', 11, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-18 15:49:15'),
(42, 9, 'U', 'usuario', 11, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-18 15:49:18'),
(43, 9, 'U', 'usuario', 11, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-18 15:49:21'),
(44, 9, 'U', 'usuario', 11, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-18 16:19:08'),
(45, 9, 'U', 'usuario', 11, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-18 16:19:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `elemento`
--
ALTER TABLE `elemento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `meta`
--
ALTER TABLE `meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `resultado`
--
ALTER TABLE `resultado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `_log_acesso`
--
ALTER TABLE `_log_acesso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `_log_operacoes`
--
ALTER TABLE `_log_operacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `elemento`
--
ALTER TABLE `elemento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `meta`
--
ALTER TABLE `meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT for table `resultado`
--
ALTER TABLE `resultado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `_log_acesso`
--
ALTER TABLE `_log_acesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `_log_operacoes`
--
ALTER TABLE `_log_operacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
