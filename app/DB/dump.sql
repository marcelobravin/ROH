-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 13-Ago-2021 às 21:16
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
  `cnpj` bigint(14) NOT NULL,
  `diretor` varchar(255) NOT NULL,
  `segundo_responsavel` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `cep` int(8) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
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

INSERT INTO `hospital` (`id`, `titulo`, `ativo`, `cnes`, `cnpj`, `diretor`, `segundo_responsavel`, `endereco`, `cep`, `telefone`, `email`, `criado_em`, `atualizado_em`, `excluido_em`, `criado_por`, `atualizado_por`, `excluido_por`) VALUES
(1, 'Novo Hospital', 1, 0, 0, '', '', '', 0, '', '', '2021-08-10 14:48:43', '2021-08-13 15:34:46', NULL, 1, NULL, NULL),
(3, 'São Luiz Gonzaga', 1, 0, 0, 'Naor', 'Segundo responsável', 'Endereço: R. Michel Ouchana, 94 - Jaçanã, São Paulo - SP, 02276-140', 0, '(11) 3466-1000', 'usuario@email.com', '2021-07-21 15:37:17', '2021-08-11 14:43:24', NULL, 21, NULL, NULL),
(4, 'Luzia de Pinho Melo', 1, 0, 0, '', '', '', 0, '', '', '2021-07-23 09:08:14', '2021-08-09 11:01:55', NULL, 21, NULL, NULL),
(29, 'São Deus II', 0, 0, 0, '', '', '', 0, '', '', '2021-08-06 11:38:37', '2021-08-10 13:59:31', '2021-08-10 13:59:31', 1, NULL, 1),
(30, 'São Deus', 0, 0, 0, '', '', '', 0, '', '', '2021-08-06 11:40:37', '2021-08-07 00:57:08', '2021-08-07 00:57:08', 1, NULL, 1),
(31, 'José D\'Ávila II', 0, 0, 0, '', '', '', 0, '', '', '2021-08-06 11:41:19', '2021-08-11 09:56:36', '2021-08-07 00:57:14', 1, NULL, 1),
(32, 'São Deus', 0, 0, 0, '', '', '', 0, '', '', '2021-08-06 11:43:39', '2021-08-07 14:50:44', '2021-08-07 14:50:44', 1, NULL, 1),
(33, 'São Deus', 0, 0, 0, '', '', '', 0, '', '', '2021-08-06 11:44:10', '2021-08-07 00:57:04', '2021-08-07 00:57:04', 1, NULL, 1),
(34, 'São Deus', 0, 0, 0, '', '', '', 0, '', '', '2021-08-06 11:44:24', '2021-08-07 14:50:51', '2021-08-07 14:50:51', 1, NULL, 1),
(35, 'São Deus', 0, 0, 0, '', '', '', 0, '', '', '2021-08-06 11:44:38', '2021-08-07 00:56:54', '2021-08-07 00:56:54', 1, NULL, 1),
(36, 'São Deus', 0, 0, 0, '', '', '', 0, '', '', '2021-08-06 11:44:45', '2021-08-07 14:50:55', '2021-08-07 14:50:55', 1, NULL, 1),
(37, 'São Deus', 0, 0, 0, '', '', '', 0, '', '', '2021-08-06 11:45:19', '2021-08-07 14:50:29', '2021-08-07 14:50:29', 1, NULL, 1),
(38, 'São Deus', 0, 0, 0, '', '', '', 0, '', '', '2021-08-06 11:45:31', '2021-08-07 14:50:32', '2021-08-07 14:50:32', 1, NULL, 1),
(39, 'São Deus', 0, 0, 0, '', '', '', 0, '', '', '2021-08-06 11:46:17', '2021-08-07 14:50:38', '2021-08-07 14:50:38', 1, NULL, 1),
(40, 'São Deus', 0, 0, 0, '', '', '', 0, '', '', '2021-08-06 11:48:44', '2021-08-07 14:50:59', '2021-08-07 14:50:59', 1, NULL, 1),
(42, '<script>alert(\"vc sofreu um ataque XSS \")</script>', 0, 0, 0, '', '', '', 0, '', '', '2021-08-07 15:01:35', '2021-08-10 13:59:19', '2021-08-10 13:59:19', 1, NULL, 1),
(43, 'CARLOS ALBERTO DE NOBREGA JUNIOR', 1, 0, 0, '', '', '', 0, '', '', '2021-08-09 15:30:41', '2021-08-10 14:23:15', NULL, 1, NULL, NULL),
(45, 'Luzia de Pinho Melo', 1, 0, 0, '', '', '', 0, '', '', '2021-08-10 13:59:10', NULL, NULL, 1, NULL, NULL);

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
(38, 43, 10, 10, 1, '2021-08-09 16:06:18', NULL, NULL, 1, NULL, NULL),
(39, 43, 13, 50, 1, '2021-08-09 16:06:18', NULL, NULL, 1, NULL, NULL),
(40, 43, 12, 0, 0, '2021-08-09 16:06:18', NULL, NULL, 1, NULL, NULL),
(41, 43, 11, 0, 0, '2021-08-09 16:06:19', NULL, NULL, 1, NULL, NULL),
(42, 43, 14, 0, 0, '2021-08-09 16:06:19', NULL, NULL, 1, NULL, NULL),
(48, 1, 34, 60, 1, '2021-08-10 14:56:08', NULL, NULL, 1, NULL, NULL),
(49, 1, 33, 200, 1, '2021-08-10 14:56:08', NULL, NULL, 1, NULL, NULL),
(50, 1, 35, 20, 1, '2021-08-10 14:56:08', NULL, NULL, 1, NULL, NULL),
(51, 1, 36, 0, 0, '2021-08-10 14:56:08', NULL, NULL, 1, NULL, NULL),
(52, 1, 32, 0, 0, '2021-08-10 14:56:08', NULL, NULL, 1, NULL, NULL),
(53, 1, 31, 0, 0, '2021-08-10 14:56:08', NULL, NULL, 1, NULL, NULL);

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
  `criado_por` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `resultado`
--

INSERT INTO `resultado` (`id`, `id_meta`, `resultado`, `mes`, `ano`, `justificativa`, `justificativa_aceita`, `criado_em`, `criado_por`) VALUES
(1, 6, 10, 8, 2021, '', 0, '2021-08-07 00:52:22', 1),
(2, 7, 2, 8, 2021, '', 0, '2021-08-07 00:52:22', 1),
(3, 8, 3, 8, 2021, '', 0, '2021-08-07 00:52:22', 1),
(4, 10, 1, 8, 2021, '<script>alert(\"vc sofreu um ataque XSS \")</script>', 0, '2021-08-07 00:52:22', 1),
(5, 33, 1, 8, 2021, '<script>alert(\"vc sofreu um ataque XSS \")</script>', 0, '2021-08-07 18:06:41', 1),
(6, 38, 1, 8, 2021, 'lokopkpok', 0, '2021-08-09 16:10:35', 1),
(7, 48, 10, 8, 2021, 'houve um problema', 0, '2021-08-10 14:59:29', 1),
(8, 49, 201, 8, 2021, '', 0, '2021-08-10 14:59:29', 1),
(9, 50, 9, 8, 2021, 'houve mais um problema', 0, '2021-08-10 14:59:30', 1);

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
(1, 'usuario@email.com', '$2y$12$TVnPBAOX7b6bIiygqf2pJOdBz5j9zAEBRkovyr.UZDJ4d635VUg.q', 1, '', 0, '', '1147964069', 11959890399, 'Marcelo de Souza Bravin', 'medico', 'Avenida Francisco Rodrigues Filho', '307.485.238-04', '2021-07-02 10:21:37', '2021-08-13 08:54:16', NULL, 1, 1, 21),
(32, 'mesnovaes@prefeitura.sp.gov.br', '$2y$12$V6IPH1Q/Nrv./iBP6lf2pu9b91c67uAEsw0P0m/QuCoSygyHKKOrq', 0, NULL, 0, NULL, '', 0, 'Meire Ellen', '', '', '338.059.850-02', '2021-08-09 14:08:05', NULL, NULL, 1, NULL, NULL);

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
(50, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-13 16:56:14');

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
(24, 1, 'U', 'usuario', 1, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-13 11:53:13'),
(25, 1, 'U', 'usuario', 1, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-13 11:53:57'),
(26, 1, 'U', 'usuario', 1, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-08-13 11:54:16');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de tabela `meta`
--
ALTER TABLE `meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de tabela `resultado`
--
ALTER TABLE `resultado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `_log_acesso`
--
ALTER TABLE `_log_acesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de tabela `_log_operacoes`
--
ALTER TABLE `_log_operacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
