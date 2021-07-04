-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05-Jul-2021 às 00:18
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
-- Estrutura da tabela `hospital`
--

CREATE TABLE `hospital` (
  `id` int(11) NOT NULL,
  `titulo` char(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `excluido_em` timestamp NULL DEFAULT NULL,
  `criado_por` int(11) NOT NULL,
  `atualizado_por` int(11) DEFAULT NULL,
  `excluido_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `hospital`
--

INSERT INTO `hospital` (`id`, `titulo`, `ativo`, `criado_em`, `atualizado_em`, `excluido_em`, `criado_por`, `atualizado_por`, `excluido_por`) VALUES
(1, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(2, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(3, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(4, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(5, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(6, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(7, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(8, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(9, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(10, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(11, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(12, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(13, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(14, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(15, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(16, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(17, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(18, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(19, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(20, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(21, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(22, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(23, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(24, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(25, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(26, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(27, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(28, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(29, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(30, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:48', NULL, NULL, 1, NULL, NULL),
(31, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(32, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(33, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(34, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(35, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(36, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(37, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(38, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(39, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(40, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(41, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(42, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(43, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(44, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(45, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(46, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(47, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(48, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(49, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(50, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(51, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(52, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(53, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(54, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(55, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(56, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(57, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(58, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(59, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL),
(60, 'São Luiz Gonzaga', 0, '2021-07-04 21:58:55', NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `login` char(60) NOT NULL,
  `senha` char(60) NOT NULL,
  `email_confirmado` tinyint(1) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL,
  `reset` varchar(50) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `excluido_em` timestamp NULL DEFAULT NULL,
  `criado_por` int(11) NOT NULL,
  `atualizado_por` int(11) DEFAULT NULL,
  `excluido_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `login`, `senha`, `email_confirmado`, `token`, `ativo`, `reset`, `criado_em`, `atualizado_em`, `excluido_em`, `criado_por`, `atualizado_por`, `excluido_por`) VALUES
(1, 'usuario@email.com', '$2y$12$086ENbtirWVAgTBqKhPPGuMeuXhYdvH/ix1x3zLeLBLEvq.g9CmiC', 1, '', 1, '', '2021-07-02 13:21:37', '2021-07-04 21:21:51', '0000-00-00 00:00:00', 1, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `_log_acesso`
--

CREATE TABLE `_log_acesso` (
  `id` int(11) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  `sucesso` tinyint(1) NOT NULL DEFAULT 0,
  `ip` varchar(15) NOT NULL,
  `navegador` varchar(400) NOT NULL,
  `datahora` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `_log_acesso`
--

INSERT INTO `_log_acesso` (`id`, `usuarioId`, `sucesso`, `ip`, `navegador`, `datahora`) VALUES
(1, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-03 04:41:01'),
(2, 1, 0, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-03 04:53:03'),
(3, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-03 04:53:12'),
(4, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-03 12:50:29'),
(5, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-03 13:25:12'),
(6, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-03 18:00:43'),
(7, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-03 18:00:56'),
(8, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-03 18:02:51'),
(9, 1, 0, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-03 18:48:52'),
(10, 1, 0, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-03 18:48:57'),
(11, 1, 0, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-03 18:49:02'),
(12, 1, 0, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-04 02:17:52'),
(13, 1, 0, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-04 02:22:15'),
(14, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-04 02:22:24'),
(15, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-04 03:21:02'),
(16, 1, 0, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-04 03:21:07'),
(17, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-04 03:21:28'),
(18, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-04 03:42:15'),
(19, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-04 04:18:55'),
(20, 1, 0, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-04 04:22:09'),
(21, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-04 04:22:19'),
(22, 1, 0, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-04 04:54:28'),
(23, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-04 04:54:41'),
(24, 1, 0, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-04 14:55:42'),
(25, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-04 14:55:50'),
(26, 1, 0, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-04 15:26:41'),
(27, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-04 15:26:46'),
(28, 1, 1, '::1', '{\"userAgent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.124\",\"platform\":\"windows\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-07-04 21:21:58');

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
  `datahora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `_log_operacoes`
--

INSERT INTO `_log_operacoes` (`id`, `usuarioId`, `acao`, `tabela`, `objetoId`, `ip`, `datahora`) VALUES
(1, 129, 'U', 'usuarios', 138, '', '2021-06-22 19:34:44'),
(2, 129, 'U', 'usuarios', 138, '', '2021-06-22 19:37:16'),
(3, 129, 'U', 'usuarios', 138, '', '2021-06-22 19:38:18'),
(4, 129, 'U', 'usuarios', 138, '', '2021-06-22 19:44:41'),
(5, 129, 'U', 'usuarios', 139, '', '2021-06-25 19:25:12');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
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
-- AUTO_INCREMENT de tabela `hospital`
--
ALTER TABLE `hospital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `_log_acesso`
--
ALTER TABLE `_log_acesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `_log_operacoes`
--
ALTER TABLE `_log_operacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
