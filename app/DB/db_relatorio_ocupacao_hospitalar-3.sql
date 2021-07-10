-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10-Jul-2021 às 21:22
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
CREATE DATABASE IF NOT EXISTS `db_relatorio_ocupacao_hospitalar` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db_relatorio_ocupacao_hospitalar`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `titulo` char(255) NOT NULL,
  `legenda` varchar(255) NOT NULL,
  `observacoes` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
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
(1, 'Equipe', 'Manutenção da equipe médica no serviço de urgência e emergência nas 24 hs de segunda feira a domingo', 'Critério de cálculo: número absoluto / Evidência Quadro de indice diário da Comurge', 1, '2021-07-06 10:06:46', '2021-07-06 15:35:27', NULL, 1, NULL, NULL),
(2, 'Internação', 'Manutenção da equipe médica no serviço de urgência e emergência nas 24 hs de segunda feira a domingo', 'Critério de cálculo: número absoluto 							<br> 							Evidência Quadro de indice diário da Comurge', 1, '2021-07-06 10:06:46', '2021-07-06 15:35:29', NULL, 1, NULL, NULL),
(3, 'Ambulatório', 'Manutenção da equipe médica no serviço de urgência e emergência nas 24 hs de segunda feira a domingo', 'A conveniada deverá realizar no mínimo 2850 saídas hospitalares trimestrais, conforme distribuição de acordo com o número de leitos existentes', 1, '2021-07-06 10:06:46', '2021-07-06 15:35:31', NULL, 1, NULL, NULL),
(4, 'Consultas ambulatoriais', 'Manutenção da equipe médica no serviço de urgência e emergência nas 24 hs de segunda feira a domingo', '* está previsto número de vagas para realização de colposcopia de pedido externo 							Evidência das Consultas    SAI SUS e as primeiras consultas no SIGA', 1, '2021-07-06 10:06:46', '2021-07-06 15:35:33', NULL, 1, NULL, NULL),
(5, 'Procedimentos e cirurgias ambulatoriais', 'Manutenção da equipe médica no serviço de urgência e emergência nas 24 hs de segunda feira a domingo', 'Evidência dos procedimentos e cirurgias    SAI SUS, BPA SIH e SIGA', 1, '2021-07-06 10:06:46', '2021-07-06 15:35:34', NULL, 1, NULL, NULL),
(6, 'SADT', 'Manutenção da equipe médica no serviço de urgência e emergência nas 24 hs de segunda feira a domingo', 'Evidência do SADT, SAI, SUS e SIGA', 1, '2021-07-06 10:06:46', '2021-07-06 15:35:36', NULL, 1, NULL, NULL),
(7, 'Atenção domiciliar', 'Manutenção da equipe médica no serviço de urgência e emergência nas 24 hs de segunda feira a domingo', 'Evidência do SADT, SAI, SUS e SIGA', 1, '2021-07-06 10:06:46', '2021-07-06 15:37:16', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `elemento`
--

CREATE TABLE `elemento` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `titulo` char(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
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

INSERT INTO `elemento` (`id`, `categoria_id`, `titulo`, `ativo`, `criado_em`, `atualizado_em`, `excluido_em`, `criado_por`, `atualizado_por`, `excluido_por`) VALUES
(1, 1, 'Clínica médica', 1, '2021-07-06 10:35:58', NULL, NULL, 1, NULL, NULL),
(2, 1, 'Clínica Cirúrgica', 1, '2021-07-06 10:35:58', NULL, NULL, 1, NULL, NULL),
(3, 1, 'Pedatria', 1, '2021-07-06 10:35:58', NULL, NULL, 1, NULL, NULL),
(4, 1, 'Ginecologia e Obstetrícia', 1, '2021-07-06 10:35:58', NULL, NULL, 1, NULL, NULL),
(5, 2, 'Clínica médica e cirúrgica', 1, '2021-07-06 10:35:58', NULL, NULL, 1, NULL, NULL),
(6, 2, 'Pedatria', 1, '2021-07-06 10:35:58', NULL, NULL, 1, NULL, NULL),
(7, 2, 'Obstetrícia', 1, '2021-07-06 10:35:58', NULL, NULL, 1, NULL, NULL),
(8, 2, 'Cuidados intermediários', 1, '2021-07-06 10:35:58', NULL, NULL, 1, NULL, NULL),
(9, 2, 'UTI Neonatal', 1, '2021-07-06 10:35:58', NULL, NULL, 1, NULL, NULL),
(10, 3, 'Clínica médica e cirúrgica', 1, '2021-07-06 10:35:58', NULL, NULL, 1, NULL, NULL),
(11, 3, 'Pedatria', 1, '2021-07-06 10:35:58', NULL, NULL, 1, NULL, NULL),
(12, 3, 'Obstetrícia', 1, '2021-07-06 10:35:58', NULL, NULL, 1, NULL, NULL),
(13, 3, 'Cuidados intermediários', 1, '2021-07-06 10:35:59', NULL, NULL, 1, NULL, NULL),
(14, 3, 'UTI Neonatal', 1, '2021-07-06 10:35:59', NULL, NULL, 1, NULL, NULL),
(15, 4, 'Clínica médica e cirúrgica', 1, '2021-07-06 10:35:59', NULL, NULL, 1, NULL, NULL),
(16, 4, 'Pedatria', 1, '2021-07-06 10:35:59', NULL, NULL, 1, NULL, NULL),
(17, 4, 'Obstetrícia', 1, '2021-07-06 10:35:59', NULL, NULL, 1, NULL, NULL),
(18, 4, 'Cuidados intermediários', 1, '2021-07-06 10:35:59', NULL, NULL, 1, NULL, NULL),
(19, 4, 'UTI Neonatal', 1, '2021-07-06 10:35:59', NULL, NULL, 1, NULL, NULL),
(20, 5, 'Clínica médica e cirúrgica', 1, '2021-07-06 10:35:59', NULL, NULL, 1, NULL, NULL),
(21, 5, 'Pedatria', 1, '2021-07-06 10:35:59', NULL, NULL, 1, NULL, NULL),
(22, 5, 'Obstetrícia', 1, '2021-07-06 10:35:59', NULL, NULL, 1, NULL, NULL),
(23, 5, 'Cuidados intermediários', 1, '2021-07-06 10:35:59', NULL, NULL, 1, NULL, NULL),
(24, 5, 'UTI Neonatal', 1, '2021-07-06 10:35:59', NULL, NULL, 1, NULL, NULL),
(25, 6, 'Ultrassonografia geral', 1, '2021-07-06 10:35:59', NULL, NULL, 1, NULL, NULL),
(26, 6, 'Tomografia', 1, '2021-07-06 10:35:59', NULL, NULL, 1, NULL, NULL),
(27, 6, 'Ecocardiograma', 1, '2021-07-06 10:35:59', NULL, NULL, 1, NULL, NULL),
(28, 6, 'Colonoscopia', 1, '2021-07-06 10:35:59', NULL, NULL, 1, NULL, NULL),
(29, 6, 'Endoscopia', 1, '2021-07-06 10:35:59', NULL, NULL, 1, NULL, NULL),
(30, 6, 'Radiologia', 1, '2021-07-06 10:35:59', NULL, NULL, 1, NULL, NULL),
(31, 7, 'Ultrassonografia geral', 1, '2021-07-06 10:35:59', NULL, NULL, 1, NULL, NULL),
(32, 7, 'Tomografia', 1, '2021-07-06 10:35:59', NULL, NULL, 1, NULL, NULL),
(33, 7, 'Ecocardiograma', 1, '2021-07-06 10:35:59', NULL, NULL, 1, NULL, NULL),
(34, 7, 'Colonoscopia', 1, '2021-07-06 10:35:59', NULL, NULL, 1, NULL, NULL),
(35, 7, 'Endoscopia', 1, '2021-07-06 10:35:59', NULL, NULL, 1, NULL, NULL),
(36, 7, 'Radiologia', 1, '2021-07-06 10:35:59', NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `hospital`
--

CREATE TABLE `hospital` (
  `id` int(11) NOT NULL,
  `titulo` char(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` datetime DEFAULT NULL,
  `excluido_em` datetime DEFAULT NULL,
  `criado_por` int(11) NOT NULL,
  `atualizado_por` int(11) DEFAULT NULL,
  `excluido_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `hospital`
--

INSERT INTO `hospital` (`id`, `titulo`, `ativo`, `criado_em`, `atualizado_em`, `excluido_em`, `criado_por`, `atualizado_por`, `excluido_por`) VALUES
(1, 'São Luiz Gonzaga', 1, '2021-07-04 18:58:48', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(74, 'São Luiz Gonzaga23', 1, '2021-07-09 12:09:20', NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `meta`
--

CREATE TABLE `meta` (
  `id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `elemento_id` int(11) NOT NULL,
  `quantidade` int(3) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
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

INSERT INTO `meta` (`id`, `hospital_id`, `elemento_id`, `quantidade`, `ativo`, `criado_em`, `atualizado_em`, `excluido_em`, `criado_por`, `atualizado_por`, `excluido_por`) VALUES
(1, 1, 10, 10, 1, '2021-07-06 16:24:59', '2021-07-07 12:21:06', NULL, 1, 1, NULL),
(2, 1, 13, 20, 0, '2021-07-06 16:24:59', '2021-07-07 12:21:07', NULL, 1, 1, NULL),
(3, 1, 12, 30, 1, '2021-07-06 16:24:59', '2021-07-07 12:21:07', NULL, 1, 1, NULL),
(4, 1, 11, 40, 0, '2021-07-06 16:24:59', '2021-07-07 12:21:07', NULL, 1, 1, NULL),
(5, 1, 14, 50, 1, '2021-07-06 16:24:59', '2021-07-07 12:21:07', NULL, 1, 1, NULL),
(6, 1, 2, 102, 1, '2021-07-06 16:26:17', '2021-07-07 12:01:43', NULL, 1, NULL, NULL),
(7, 1, 1, 102, 1, '2021-07-06 16:26:17', '2021-07-07 12:01:43', NULL, 1, NULL, NULL),
(8, 1, 4, 102, 1, '2021-07-06 16:26:17', '2021-07-07 12:01:43', NULL, 1, NULL, NULL),
(9, 1, 3, 102, 1, '2021-07-06 16:26:17', '2021-07-07 12:01:43', NULL, 1, NULL, NULL),
(10, 1, 5, 101, 1, '2021-07-06 16:26:34', '2021-07-07 12:13:56', NULL, 1, NULL, NULL),
(11, 1, 8, 102, 1, '2021-07-06 16:26:34', '2021-07-07 12:13:56', NULL, 1, NULL, NULL),
(12, 1, 7, 103, 0, '2021-07-06 16:26:34', '2021-07-07 12:01:25', NULL, 1, NULL, NULL),
(13, 1, 6, 104, 1, '2021-07-06 16:26:34', '2021-07-07 12:13:56', NULL, 1, NULL, NULL),
(14, 1, 9, 105, 1, '2021-07-06 16:26:34', '2021-07-07 12:13:56', NULL, 1, NULL, NULL),
(20, 1, 34, 100, 0, '2021-07-07 11:47:29', NULL, NULL, 1, NULL, NULL),
(21, 1, 33, 200, 0, '2021-07-07 11:47:29', NULL, NULL, 1, NULL, NULL),
(22, 1, 35, 300, 0, '2021-07-07 11:47:29', NULL, NULL, 1, NULL, NULL),
(23, 1, 36, 400, 0, '2021-07-07 11:47:29', NULL, NULL, 1, NULL, NULL),
(24, 1, 32, 500, 0, '2021-07-07 11:47:29', NULL, NULL, 1, NULL, NULL),
(25, 1, 31, 600, 0, '2021-07-07 11:47:29', NULL, NULL, 1, NULL, NULL),
(44, 1, 15, 1000, 1, '2021-07-07 11:51:01', '2021-07-07 11:58:23', NULL, 1, NULL, NULL),
(45, 1, 18, 2000, 1, '2021-07-07 11:51:01', '2021-07-07 11:58:23', NULL, 1, NULL, NULL),
(46, 1, 17, 3000, 1, '2021-07-07 11:51:01', '2021-07-07 11:58:23', NULL, 1, NULL, NULL),
(47, 1, 16, 4000, 1, '2021-07-07 11:51:01', '2021-07-07 11:58:23', NULL, 1, NULL, NULL),
(48, 1, 19, 5000, 1, '2021-07-07 11:51:01', '2021-07-07 11:58:23', NULL, 1, NULL, NULL),
(54, 1, 20, 99999, 0, '2021-07-07 12:00:38', NULL, NULL, 1, NULL, NULL),
(55, 1, 23, 9999, 0, '2021-07-07 12:00:38', NULL, NULL, 1, NULL, NULL),
(56, 1, 22, 999, 0, '2021-07-07 12:00:38', NULL, NULL, 1, NULL, NULL),
(57, 1, 21, 99, 0, '2021-07-07 12:00:38', NULL, NULL, 1, NULL, NULL),
(58, 1, 24, 9, 0, '2021-07-07 12:00:38', NULL, NULL, 1, NULL, NULL),
(83, 66, 13, 20, 0, '2021-07-07 15:02:05', NULL, NULL, 1, NULL, NULL),
(84, 66, 12, 30, 1, '2021-07-07 15:02:05', NULL, NULL, 1, NULL, NULL),
(85, 66, 11, 40, 0, '2021-07-07 15:02:05', NULL, NULL, 1, NULL, NULL),
(86, 66, 14, 50, 1, '2021-07-07 15:02:05', NULL, NULL, 1, NULL, NULL),
(90, 1, 28, 2, 0, '2021-07-09 15:46:57', NULL, NULL, 1, NULL, NULL),
(91, 1, 27, 9, 0, '2021-07-09 15:46:57', NULL, NULL, 1, NULL, NULL),
(92, 1, 29, 8, 0, '2021-07-09 15:46:57', NULL, NULL, 1, NULL, NULL),
(93, 1, 30, 6, 0, '2021-07-09 15:46:57', NULL, NULL, 1, NULL, NULL),
(94, 1, 26, 2, 0, '2021-07-09 15:46:57', NULL, NULL, 1, NULL, NULL),
(95, 1, 25, 1, 0, '2021-07-09 15:46:57', NULL, NULL, 1, NULL, NULL),
(96, 74, 10, 100, 1, '2021-07-09 16:22:35', NULL, NULL, 1, NULL, NULL),
(97, 74, 13, 110, 1, '2021-07-09 16:22:35', NULL, NULL, 1, NULL, NULL),
(98, 74, 12, 120, 1, '2021-07-09 16:22:35', NULL, NULL, 1, NULL, NULL),
(99, 74, 11, 130, 1, '2021-07-09 16:22:35', NULL, NULL, 1, NULL, NULL),
(100, 74, 14, 140, 1, '2021-07-09 16:22:35', NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `resultado`
--

CREATE TABLE `resultado` (
  `id` int(11) NOT NULL,
  `meta_id` int(11) NOT NULL,
  `resultado` int(3) NOT NULL,
  `mes` tinyint(2) NOT NULL,
  `justificativa` text DEFAULT NULL,
  `justificativa_aceita` tinyint(1) NOT NULL DEFAULT 0,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `criado_por` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `resultado`
--

INSERT INTO `resultado` (`id`, `meta_id`, `resultado`, `mes`, `justificativa`, `justificativa_aceita`, `criado_em`, `criado_por`) VALUES
(43, 10, 1, 7, '', 0, '2021-07-09 22:16:17', 1),
(44, 13, 3, 7, '', 0, '2021-07-09 22:16:17', 1),
(45, 12, 4, 7, '', 0, '2021-07-09 22:16:17', 1),
(46, 11, 55, 7, '', 0, '2021-07-09 22:16:17', 1),
(47, 14, 55, 7, '', 0, '2021-07-09 22:16:17', 1);

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
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `reset` varchar(50) DEFAULT NULL,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` datetime DEFAULT NULL,
  `excluido_em` datetime DEFAULT NULL,
  `criado_por` int(11) NOT NULL,
  `atualizado_por` int(11) DEFAULT NULL,
  `excluido_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `login`, `senha`, `email_confirmado`, `token`, `ativo`, `reset`, `criado_em`, `atualizado_em`, `excluido_em`, `criado_por`, `atualizado_por`, `excluido_por`) VALUES
(1, 'usuario@email.com', '$2y$12$.oqI.kRnIrk3v.S7CMGJ4.N.qmg8Z5/kr1fYd/UxgnH0K8ZurKLP6', 1, '', 0, '', '2021-07-02 10:21:37', '2021-07-04 18:21:51', '0000-00-00 00:00:00', 1, 0, 0),
(6, 'usuario2@email.com', '$2y$12$AMdrHo0maWuKLDRImZGMneoiB4O9R8hWCOKufYQuBAVgLys3nWtM2', 0, NULL, 0, NULL, '2021-07-05 16:05:08', NULL, NULL, 1, NULL, NULL),
(7, 'zé', '$2y$12$MTpaUfpzCK6zJ2hz3BHWo.YoMZDGZZTDB468J7IXhcmeJ6cnI9Ziu', 0, NULL, 1, NULL, '2021-07-06 07:29:56', NULL, NULL, 1, NULL, NULL),
(8, 'login', '$2y$12$QKI.v.2Su6lu/tSuvuC9K.91Uphu1E6JX75DvrYCXAcWD/dJo3eVS', 0, NULL, 1, NULL, '2021-07-06 07:32:32', NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `_log_acesso`
--

CREATE TABLE `_log_acesso` (
  `id` int(11) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  `sucesso` tinyint(1) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `navegador` varchar(400) NOT NULL,
  `datahora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `_log_acesso`
--

INSERT INTO `_log_acesso` (`id`, `usuarioId`, `sucesso`, `ip`, `navegador`, `datahora`) VALUES
(35, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-06 11:06:04'),
(36, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-07 10:33:54'),
(37, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-09 00:06:49'),
(38, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-10 16:49:08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `_log_operacoes`
--

CREATE TABLE `_log_operacoes` (
  `id` int(11) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  `acao` char(1) NOT NULL,
  `tabela` varchar(50) NOT NULL,
  `objetoId` int(11) NOT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `navegador` varchar(400) NOT NULL,
  `datahora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `_log_operacoes`
--

INSERT INTO `_log_operacoes` (`id`, `usuarioId`, `acao`, `tabela`, `objetoId`, `ip`, `navegador`, `datahora`) VALUES
(6, 1, 'U', 'hospital', 74, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-10 18:31:27');

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
  ADD KEY `id` (`id`);

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
  ADD UNIQUE KEY `hospital_id` (`hospital_id`,`elemento_id`),
  ADD KEY `id` (`id`);

--
-- Índices para tabela `resultado`
--
ALTER TABLE `resultado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `id` (`id`);

--
-- Índices para tabela `_log_acesso`
--
ALTER TABLE `_log_acesso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Índices para tabela `_log_operacoes`
--
ALTER TABLE `_log_operacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de tabela `meta`
--
ALTER TABLE `meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT de tabela `resultado`
--
ALTER TABLE `resultado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `_log_acesso`
--
ALTER TABLE `_log_acesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `_log_operacoes`
--
ALTER TABLE `_log_operacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
