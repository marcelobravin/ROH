-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 24-Jun-2021 às 16:27
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
-- Banco de dados: `db_NOVO`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `login` char(60) NOT NULL,
  `senha` char(60) NOT NULL,
  `email_confirmado` tinyint(1) NOT NULL DEFAULT 0,
  `token` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `reset` varchar(50) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `login`, `senha`, `email_confirmado`, `token`, `ativo`, `reset`, `criado_em`, `atualizado_em`) VALUES
(129, 'usuario@email.com', '$2y$12$3oSgaZPFJ1PI2WLilrLiMeOhe4KaKWKd/3w91ochh0EiXS1FvOkDm', 1, '', 1, '', '2021-06-21 12:46:44', '2021-06-23 18:20:38'),
(138, 'usuario2a@gamil.com', '$2y$12$GnKWbhbWl6R.5NKT3KcBQu.pVKZgQ.uHzQm3vMTrUgrv0kBjD9Hpi', 0, '60d240bd84664', 0, NULL, '2021-06-22 14:44:43', '2021-06-23 18:25:42'),
(139, 'usuario3@email.com', '$2y$12$S0Le9I1/uTg0xFKo3g7m2e3xBO6yiC72.Uj74d5JcFN38FOgjBGAi', 0, '60d37c5a5c62c', 0, NULL, '2021-06-22 14:46:40', '2021-06-23 18:24:26');

-- --------------------------------------------------------

--
-- Estrutura da tabela `_log_acesso`
--

CREATE TABLE `_log_acesso` (
  `id` int(11) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  `sucesso` bit(1) NOT NULL DEFAULT b'0',
  `ip` varchar(15) DEFAULT NULL,
  `navegador` varchar(400) NOT NULL,
  `datahora` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `_log_acesso`
--

INSERT INTO `_log_acesso` (`id`, `usuarioId`, `sucesso`, `ip`, `navegador`, `datahora`) VALUES
(85, 129, b'0', '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.77\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-06-22 10:40:47'),
(86, 129, b'1', '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.77\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-06-22 10:42:35'),
(87, 129, b'0', '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.77\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-06-22 12:42:29'),
(88, 129, b'0', '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.77\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-06-22 12:42:39'),
(89, 129, b'0', '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.77\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-06-22 12:42:53'),
(90, 129, b'0', '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.77\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-06-22 14:29:36'),
(91, 129, b'0', '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.77\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-06-22 14:34:24'),
(92, 129, b'1', '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.77\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-06-22 14:34:53'),
(93, 129, b'0', '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.77\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-06-22 17:39:02'),
(94, 129, b'0', '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.77\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-06-22 17:39:10'),
(95, 129, b'0', '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.77\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-06-22 17:39:15'),
(96, 129, b'1', '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.77\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-06-22 18:53:25'),
(97, 129, b'0', '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.77\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-06-23 11:14:38'),
(98, 129, b'1', '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.77\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-06-23 11:14:47'),
(99, 129, b'0', '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.77\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-06-23 18:20:48'),
(100, 129, b'1', '::1', '{\"userAgent\":\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36\",\"name\":\"Google Chrome\",\"version\":\"91.0.4472.77\",\"platform\":\"linux\",\"pattern\":\"#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\"}', '2021-06-23 18:21:32');

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
  `datahora` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `_log_operacoes`
--

INSERT INTO `_log_operacoes` (`id`, `usuarioId`, `acao`, `tabela`, `objetoId`, `ip`, `datahora`) VALUES
(1, 129, 'U', 'usuarios', 138, NULL, '2021-06-22 19:34:44'),
(2, 129, 'U', 'usuarios', 138, NULL, '2021-06-22 19:37:16'),
(3, 129, 'U', 'usuarios', 138, NULL, '2021-06-22 19:38:18'),
(4, 129, 'U', 'usuarios', 138, NULL, '2021-06-22 19:44:41');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Índices para tabela `_log_acesso`
--
ALTER TABLE `_log_acesso`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `_log_operacoes`
--
ALTER TABLE `_log_operacoes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT de tabela `_log_acesso`
--
ALTER TABLE `_log_acesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de tabela `_log_operacoes`
--
ALTER TABLE `_log_operacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
