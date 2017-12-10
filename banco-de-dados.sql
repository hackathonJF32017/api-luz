-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 10-Dez-2017 às 15:35
-- Versão do servidor: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `luz2`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `luztb_001_usuario`
--

CREATE TABLE `luztb_001_usuario` (
  `co_usuario` bigint(255) NOT NULL,
  `no_login` varchar(80) DEFAULT NULL,
  `no_nome` varchar(80) NOT NULL,
  `co_password` varchar(255) NOT NULL,
  `last_access` datetime DEFAULT NULL,
  `co_perfil` int(255) NOT NULL,
  `co_setor` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `luztb_001_usuario`
--

INSERT INTO `luztb_001_usuario` (`co_usuario`, `no_login`, `no_nome`, `co_password`, `last_access`, `co_perfil`, `co_setor`) VALUES
(1, 'login', 'Usuario', '7751a23fa55170a57e90374df13a3ab78efe0e99', '2017-12-10 14:58:04', 1, 1),
(2, 'teste', 'Teste Cadastro', '2e6f9b0d5885b6010f9167787445617f553a735f', '2017-12-10 02:08:24', 1, 1),
(3, 'Login', 'Name', '078df637f761d0ea6a7f5998e62b33ba9fc90e08', '2017-12-10 01:31:12', 1, 1),
(4, 'Login', 'Name', '078df637f761d0ea6a7f5998e62b33ba9fc90e08', '2017-12-10 04:59:58', 1, 1),
(7, 'funcionario', 'funcionario', '3802bbe7c14128ebd50dbfdd4db95c1ffdc8425b', '2017-12-10 15:16:01', 3, 1),
(8, 'setor', 'setor', '75f64b174420203ce3398c932077903ba058735e', '2017-12-10 15:16:51', 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `luztb_002_perfil`
--

CREATE TABLE `luztb_002_perfil` (
  `co_perfil` int(255) NOT NULL,
  `no_perfil` char(20) DEFAULT NULL,
  `de_perfil` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `luztb_002_perfil`
--

INSERT INTO `luztb_002_perfil` (`co_perfil`, `no_perfil`, `de_perfil`) VALUES
(1, 'Gerente', 'Setor gerencial'),
(2, 'Chefe de setor', 'Chefe dos setores, responsável por receber as idéias'),
(3, 'Funcionário', 'Funcionários que enviarão as idéias');

-- --------------------------------------------------------

--
-- Estrutura da tabela `luztb_003_setor`
--

CREATE TABLE `luztb_003_setor` (
  `co_setor` int(255) NOT NULL,
  `no_setor` varchar(30) NOT NULL,
  `de_setor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `luztb_003_setor`
--

INSERT INTO `luztb_003_setor` (`co_setor`, `no_setor`, `de_setor`) VALUES
(1, 'Financeiro', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `luztb_004_ideias`
--

CREATE TABLE `luztb_004_ideias` (
  `co_ideia` bigint(255) NOT NULL,
  `co_usuario` bigint(255) DEFAULT NULL,
  `co_setor` int(255) NOT NULL,
  `de_ideia` longtext NOT NULL,
  `de_resposta` longtext,
  `co_usuario_resposta` bigint(20) DEFAULT NULL,
  `ck_aplicacao` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `luztb_004_ideias`
--

INSERT INTO `luztb_004_ideias` (`co_ideia`, `co_usuario`, `co_setor`, `de_ideia`, `de_resposta`, `co_usuario_resposta`, `ck_aplicacao`) VALUES
(2, 2, 1, 'Teste Ideia', 'resposta 123', 2, 0),
(3, 1, 1, 'Descrição da ideia', NULL, NULL, 1),
(4, 1, 1, 'this.idea', NULL, NULL, 0),
(5, 1, 5, 'zxczxc', NULL, NULL, 0),
(6, 1, 5, 'sugestão', NULL, NULL, 0),
(7, 1, 4, 'Sugedasd', NULL, NULL, 0),
(8, 1, 6, 'uma nova idea', NULL, NULL, 0),
(9, 1, 1, 'Sugiro que vocês finalizem o sistema!', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `luztb_005_comentarios`
--

CREATE TABLE `luztb_005_comentarios` (
  `co_comentario` bigint(255) NOT NULL,
  `co_ideia` bigint(255) NOT NULL,
  `co_usuario` bigint(255) NOT NULL,
  `de_comentario` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `luztb_005_comentarios`
--

INSERT INTO `luztb_005_comentarios` (`co_comentario`, `co_ideia`, `co_usuario`, `de_comentario`) VALUES
(2, 2, 1, 'Comentario teste 2'),
(3, 2, 6, 'Descrição do comentário'),
(4, 3, 1, 'ddddasdasd'),
(5, 3, 1, 'dasdasdasd'),
(6, 3, 1, 'Apenas mais um comentário visando melhorar a proposta de um outro alguem'),
(7, 3, 1, 'teste'),
(8, 3, 1, 'sssss'),
(9, 3, 1, 'asasas'),
(10, 9, 1, 'Ok! Iremos providenciar');

-- --------------------------------------------------------

--
-- Estrutura da tabela `luztb_006_apoio`
--

CREATE TABLE `luztb_006_apoio` (
  `co_apoio` int(11) NOT NULL,
  `co_ideia` int(11) NOT NULL,
  `co_comentario` bigint(255) NOT NULL DEFAULT '0',
  `co_usuario` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `luztb_006_apoio`
--

INSERT INTO `luztb_006_apoio` (`co_apoio`, `co_ideia`, `co_comentario`, `co_usuario`) VALUES
(2, 0, 2, 1),
(4, 2, 2, 1),
(5, 2, 0, 1),
(6, 2, 0, 1),
(7, 3, 0, 1),
(8, 3, 0, 1),
(9, 3, 0, 1),
(10, 3, 0, 1),
(11, 3, 0, 1),
(12, 3, 0, 1),
(13, 3, 0, 1),
(14, 3, 0, 1),
(15, 3, 0, 1),
(16, 3, 0, 1),
(17, 3, 0, 1),
(18, 3, 0, 1),
(19, 3, 0, 1),
(20, 3, 0, 1),
(21, 3, 0, 1),
(22, 3, 0, 1),
(23, 4, 0, 1),
(24, 4, 0, 1),
(25, 5, 0, 1),
(26, 5, 0, 1),
(27, 6, 0, 1),
(28, 7, 0, 1),
(29, 7, 0, 1),
(30, 7, 0, 1),
(31, 7, 0, 1),
(32, 7, 0, 1),
(33, 7, 0, 1),
(34, 6, 0, 1),
(35, 6, 0, 1),
(36, 2, 0, 1),
(37, 3, 0, 1),
(38, 3, 0, 1),
(39, 3, 0, 1),
(40, 8, 0, 1),
(41, 8, 0, 1),
(42, 8, 0, 1),
(43, 8, 0, 1),
(44, 3, 4, 1),
(45, 3, 4, 1),
(46, 3, 5, 1),
(47, 3, 6, 1),
(48, 3, 6, 1),
(49, 3, 6, 1),
(50, 3, 0, 1),
(51, 3, 0, 1),
(52, 3, 9, 1),
(53, 3, 4, 1),
(54, 3, 9, 1),
(55, 3, 0, 8),
(56, 3, 0, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `luztb_001_usuario`
--
ALTER TABLE `luztb_001_usuario`
  ADD UNIQUE KEY `unique_co_usuario` (`co_usuario`);

--
-- Indexes for table `luztb_002_perfil`
--
ALTER TABLE `luztb_002_perfil`
  ADD UNIQUE KEY `unique_co_perfil` (`co_perfil`);

--
-- Indexes for table `luztb_003_setor`
--
ALTER TABLE `luztb_003_setor`
  ADD UNIQUE KEY `unique_co_setor` (`co_setor`);

--
-- Indexes for table `luztb_004_ideias`
--
ALTER TABLE `luztb_004_ideias`
  ADD UNIQUE KEY `unique_co_ideia` (`co_ideia`);

--
-- Indexes for table `luztb_005_comentarios`
--
ALTER TABLE `luztb_005_comentarios`
  ADD UNIQUE KEY `unique_co_comentario` (`co_comentario`);

--
-- Indexes for table `luztb_006_apoio`
--
ALTER TABLE `luztb_006_apoio`
  ADD PRIMARY KEY (`co_apoio`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `luztb_001_usuario`
--
ALTER TABLE `luztb_001_usuario`
  MODIFY `co_usuario` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `luztb_002_perfil`
--
ALTER TABLE `luztb_002_perfil`
  MODIFY `co_perfil` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `luztb_003_setor`
--
ALTER TABLE `luztb_003_setor`
  MODIFY `co_setor` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `luztb_004_ideias`
--
ALTER TABLE `luztb_004_ideias`
  MODIFY `co_ideia` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `luztb_005_comentarios`
--
ALTER TABLE `luztb_005_comentarios`
  MODIFY `co_comentario` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `luztb_006_apoio`
--
ALTER TABLE `luztb_006_apoio`
  MODIFY `co_apoio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
