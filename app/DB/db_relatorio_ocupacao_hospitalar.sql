-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 14-Jul-2021 às 20:44
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
CREATE DATABASE IF NOT EXISTS `db_relatorio_ocupacao_hospitalar` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db_relatorio_ocupacao_hospitalar`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `titulo` char(255) NOT NULL,
  `legenda` varchar(255) DEFAULT NULL,
  `observacoes` varchar(255) DEFAULT NULL,
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
  `ativo` tinyint(1) DEFAULT NULL,
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
(74, 'São João', 0, '2021-07-09 12:09:20', NULL, NULL, 1, NULL, NULL);

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
(175, 1, 10, 10, 1, '2021-07-13 11:09:35', '2021-07-13 15:12:56', NULL, 1, 1, NULL),
(176, 1, 13, 10, 1, '2021-07-13 11:09:36', '2021-07-13 15:12:56', NULL, 1, 1, NULL),
(177, 1, 12, 12, 1, '2021-07-13 11:09:36', '2021-07-13 15:12:56', NULL, 1, 1, NULL),
(178, 1, 11, 13, 1, '2021-07-13 11:09:36', '2021-07-13 15:12:57', NULL, 1, 1, NULL),
(179, 1, 14, 14, 1, '2021-07-13 11:09:36', '2021-07-13 15:12:57', NULL, 1, 1, NULL),
(180, 1, 34, 100, 1, '2021-07-13 11:12:16', '2021-07-14 10:53:02', NULL, 1, 1, NULL),
(181, 1, 33, 11, 1, '2021-07-13 11:12:16', '2021-07-14 10:53:02', NULL, 1, 1, NULL),
(182, 1, 35, 12, 1, '2021-07-13 11:12:16', '2021-07-14 10:53:02', NULL, 1, 1, NULL),
(183, 1, 36, 13, 1, '2021-07-13 11:12:17', '2021-07-14 10:53:02', NULL, 1, 1, NULL),
(184, 1, 32, 14, 1, '2021-07-13 11:12:17', '2021-07-14 10:53:02', NULL, 1, 1, NULL),
(185, 1, 31, 15, 1, '2021-07-13 11:12:17', '2021-07-14 10:53:02', NULL, 1, 1, NULL),
(186, 1, 15, 10, 1, '2021-07-13 12:12:13', NULL, NULL, 1, NULL, NULL),
(187, 1, 18, 20, 1, '2021-07-13 12:12:13', NULL, NULL, 1, NULL, NULL),
(188, 1, 17, 30, 1, '2021-07-13 12:12:13', NULL, NULL, 1, NULL, NULL),
(189, 1, 16, 40, 1, '2021-07-13 12:12:13', NULL, NULL, 1, NULL, NULL),
(190, 1, 19, 50, 1, '2021-07-13 12:12:13', NULL, NULL, 1, NULL, NULL),
(191, 1, 28, 10, 0, '2021-07-13 14:53:23', NULL, NULL, 1, NULL, NULL),
(192, 1, 27, 9, 0, '2021-07-13 14:53:23', NULL, NULL, 1, NULL, NULL),
(193, 1, 29, 8, 0, '2021-07-13 14:53:23', NULL, NULL, 1, NULL, NULL),
(194, 1, 30, 7, 0, '2021-07-13 14:53:23', NULL, NULL, 1, NULL, NULL),
(195, 1, 26, 6, 0, '2021-07-13 14:53:23', NULL, NULL, 1, NULL, NULL),
(196, 1, 25, 5, 0, '2021-07-13 14:53:23', NULL, NULL, 1, NULL, NULL),
(197, 1, 2, 4, 1, '2021-07-13 15:12:54', NULL, NULL, 1, NULL, NULL),
(198, 1, 1, 3, 0, '2021-07-13 15:12:54', NULL, NULL, 1, NULL, NULL),
(199, 1, 4, 2, 1, '2021-07-13 15:12:54', NULL, NULL, 1, NULL, NULL),
(200, 1, 3, 1, 0, '2021-07-13 15:12:54', NULL, NULL, 1, NULL, NULL),
(206, 1, 5, 9999, 1, '2021-07-13 15:27:32', NULL, NULL, 1, NULL, NULL),
(207, 1, 8, 999, 0, '2021-07-13 15:27:32', NULL, NULL, 1, NULL, NULL),
(208, 1, 7, 99, 0, '2021-07-13 15:27:32', NULL, NULL, 1, NULL, NULL),
(209, 1, 6, 9, 0, '2021-07-13 15:27:32', NULL, NULL, 1, NULL, NULL),
(210, 1, 9, 1, 0, '2021-07-13 15:27:32', NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `resultado`
--

CREATE TABLE `resultado` (
  `id` int(11) NOT NULL,
  `meta_id` int(11) NOT NULL,
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
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `login` char(60) NOT NULL,
  `senha` char(60) NOT NULL,
  `email_confirmado` tinyint(1) NOT NULL DEFAULT 0,
  `token` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  `reset` varchar(50) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `cpf` varchar(14) NOT NULL,
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

INSERT INTO `usuario` (`id`, `login`, `senha`, `email_confirmado`, `token`, `ativo`, `reset`, `telefone`, `nome`, `endereco`, `cpf`, `criado_em`, `atualizado_em`, `excluido_em`, `criado_por`, `atualizado_por`, `excluido_por`) VALUES
(1, 'usuario@email.com', '$2y$12$3zjkKY6O7CEOh43aqmaCru2D3C8z1csk.WZy6dH7IyYC0fuVBwhcC', 1, '', 0, '', '', '', '', '', '2021-07-02 10:21:37', '2021-07-04 18:21:51', '0000-00-00 00:00:00', 1, 0, 0),
(6, 'usuario2@email.com', '$2y$12$AMdrHo0maWuKLDRImZGMneoiB4O9R8hWCOKufYQuBAVgLys3nWtM2', 0, NULL, 0, NULL, '', '', '', '', '2021-07-05 16:05:08', NULL, NULL, 1, NULL, NULL),
(7, 'zé', '$2y$12$MTpaUfpzCK6zJ2hz3BHWo.YoMZDGZZTDB468J7IXhcmeJ6cnI9Ziu', 0, NULL, 1, NULL, '', '', '', '', '2021-07-06 07:29:56', NULL, NULL, 1, NULL, NULL),
(8, 'login', '$2y$12$QKI.v.2Su6lu/tSuvuC9K.91Uphu1E6JX75DvrYCXAcWD/dJo3eVS', 0, NULL, 1, NULL, '', '', '', '', '2021-07-06 07:32:32', NULL, NULL, 1, NULL, NULL);

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
(38, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-10 16:49:08'),
(39, 1, 0, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-12 12:40:22'),
(40, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-12 12:40:43'),
(41, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-15 11:38:38'),
(42, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-16 11:08:14'),
(43, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-16 12:36:17'),
(44, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-16 12:43:49'),
(45, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-16 18:43:56');

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
(6, 1, 'U', 'hospital', 74, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-10 18:31:27'),
(7, 1, 'U', 'hospital', 74, '::1', '{\"userAgent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.114\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[\\/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-12 13:05:23');

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
  ADD UNIQUE KEY `meta_id` (`meta_id`,`mes`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT de tabela `resultado`
--
ALTER TABLE `resultado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `_log_acesso`
--
ALTER TABLE `_log_acesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de tabela `_log_operacoes`
--
ALTER TABLE `_log_operacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
