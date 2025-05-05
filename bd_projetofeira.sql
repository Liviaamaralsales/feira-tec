-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/04/2025 às 02:54
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_projetofeira`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos`
--

CREATE TABLE `alunos` (
  `id_alunos` int(11) NOT NULL,
  `nome` varchar(128) NOT NULL,
  `turma` varchar(3) NOT NULL,
  `curso` varchar(60) NOT NULL,
  `id_alunos_projetos` int(11) NOT NULL,
  `rm` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `alunos`
--

INSERT INTO `alunos` (`id_alunos`, `nome`, `turma`, `curso`, `id_alunos_projetos`, `rm`) VALUES
(9, 'Aluno1', '1°F', 'Informática', 3, 12345),
(10, 'Aluno2', '1°F', 'Informática', 7, 54321),
(11, 'Aluno3', '1°F', 'Informática', 3, 11111),
(12, 'Aluno4', '3°A', 'Administração', 5, 12321),
(13, 'Aluno5', '3°A', 'Administração', 5, 22222),
(15, 'Aluno6', '2°B', 'Recursos Humanos', 8, 33333);

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacao`
--

CREATE TABLE `avaliacao` (
  `id_avaliacao` int(11) NOT NULL,
  `feedback` varchar(512) DEFAULT NULL,
  `nota` int(1) NOT NULL,
  `id_avaliacao_projetos` int(11) NOT NULL,
  `data_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `avaliacao`
--

INSERT INTO `avaliacao` (`id_avaliacao`, `feedback`, `nota`, `id_avaliacao_projetos`, `data_hora`) VALUES
(2, 'texto de avaliação-1', 5, 3, '2025-03-11 15:46:22'),
(3, 'texto de avaliação-2', 2, 8, '2025-03-11 13:22:09'),
(4, '', 3, 8, '2025-03-11 14:12:54'),
(5, 'texto de avaliação-3', 5, 5, '2025-03-11 16:36:44');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `id_cadastro` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `email` varchar(110) NOT NULL,
  `senha` varchar(128) DEFAULT NULL,
  `data_nasc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cadastro`
--

INSERT INTO `cadastro` (`id_cadastro`, `nome`, `email`, `senha`, `data_nasc`) VALUES
(1, 'Fulano', 'fulano1@email.com', '12345678', '0000-00-00'),
(2, 'Ciclano', 'ciclano2@email.com', '87654321', '0000-00-00'),
(3, 'Beltrano', 'beltrano1@email.com', '12341234', '0000-00-00'),
(4, 'Visitante4', 'visitante4@email.com', '12344321', '0000-00-00'),
(5, 'Visitante5', 'visitante5@email.com', '11112222', '0000-00-00'),
(6, 'Visitante6', 'visitante6@email.com', '22221111', '0000-00-00'),
(8, 'Visitante7', 'visitante7@email.com', '11111111', '0000-00-00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `projetos`
--

CREATE TABLE `projetos` (
  `id_projetos` int(11) NOT NULL,
  `nome` varchar(128) NOT NULL,
  `ods` varchar(60) NOT NULL,
  `posicao` varchar(128) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `projetos`
--

INSERT INTO `projetos` (`id_projetos`, `nome`, `ods`, `posicao`, `status`) VALUES
(3, 'Projeto1', 'ODS-1', 'Bloco-A-Sala-3', 1),
(4, 'Projeto2', 'ODS-17', 'Bloco-B-Sala-4', 1),
(5, 'Projeto3', 'ODS-12', 'Bloco-A-Sala-7', 1),
(6, 'Projeto4', 'ODS-8', 'Bloco-B-Sala-1', 1),
(7, 'Projeto5', 'ODS-10', 'Bloco-A-Sala-2', 0),
(8, 'Projeto6', 'ODS-7', 'Bloco-A-Sala-2', 1),
(9, 'Projeto7', 'ODS-15', 'Bloco-A-Sala-7', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id_alunos`),
  ADD UNIQUE KEY `rm` (`rm`),
  ADD KEY `id_projetos` (`id_alunos_projetos`);

--
-- Índices de tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD PRIMARY KEY (`id_avaliacao`),
  ADD KEY `id_projetos` (`id_avaliacao_projetos`);

--
-- Índices de tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`id_cadastro`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `projetos`
--
ALTER TABLE `projetos`
  ADD PRIMARY KEY (`id_projetos`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id_alunos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  MODIFY `id_avaliacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `id_cadastro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `projetos`
--
ALTER TABLE `projetos`
  MODIFY `id_projetos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
