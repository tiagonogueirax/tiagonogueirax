-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/11/2021 às 04:27
-- Versão do servidor: 10.4.20-MariaDB
-- Versão do PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bibliotech`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `emprestimo`
--

CREATE TABLE `emprestimo` (
  `id` int(11) NOT NULL,
  `fk_livro` int(11) NOT NULL,
  `fk_usuario` int(11) NOT NULL,
  `dt_devprev` datetime NOT NULL,
  `dt_devreal` datetime DEFAULT NULL,
  `aprovado` enum('S','N') DEFAULT NULL,
  `dt_analise` datetime DEFAULT NULL,
  `fk_aprovador` int(11) DEFAULT NULL,
  `extravio` enum('X') DEFAULT NULL,
  `dt_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `emprestimo`
--

INSERT INTO `emprestimo` (`id`, `fk_livro`, `fk_usuario`, `dt_devprev`, `dt_devreal`, `aprovado`, `dt_analise`, `fk_aprovador`, `extravio`, `dt_registro`) VALUES
(19, 4, 1, '2021-12-10 23:59:59', '2021-12-18 00:01:37', 'S', '2021-11-23 19:05:26', 1, NULL, '2021-11-23 13:56:55');

-- --------------------------------------------------------

--
-- Estrutura para tabela `estoque`
--

CREATE TABLE `estoque` (
  `id` int(11) NOT NULL,
  `fk_livro` int(11) NOT NULL,
  `fk_usuario` int(11) NOT NULL,
  `qtd` int(11) NOT NULL,
  `dt_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `estoque`
--

INSERT INTO `estoque` (`id`, `fk_livro`, `fk_usuario`, `qtd`, `dt_registro`) VALUES
(8, 4, 1, 1, '2021-11-23 13:47:45'),
(9, 4, 1, 2, '2021-11-23 13:47:57'),
(10, 4, 1, 4, '2021-11-23 13:53:53'),
(11, 4, 1, -4, '2021-11-23 13:54:29'),
(12, 4, 1, -1, '2021-11-23 13:55:47'),
(13, 5, 1, 4, '2021-11-23 13:56:20');

-- --------------------------------------------------------

--
-- Estrutura para tabela `livro`
--

CREATE TABLE `livro` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(1024) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `dt_cadastro` datetime NOT NULL DEFAULT current_timestamp(),
  `fk_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `livro`
--

INSERT INTO `livro` (`id`, `nome`, `descricao`, `autor`, `img`, `dt_cadastro`, `fk_usuario`) VALUES
(4, 'LIVRO DE SALOMÃO', 'A SABEDORIA DA CONTEMPLAÇÃO', 'JEAN YVES', 'c73b14445828e1b1c56d5b8785d3bb557e7aad77.jpg', '2021-11-23 11:34:48', 1),
(5, 'HISTÓRIAS DE MARKETING E VENDAS', 'AS LIÇÕES QUE A VIDA EM ENSINOU', 'HEITOR BERGAMINI', '5124c73fe33d91067dc610ac9d9e2ea72fee5060.jpg', '2021-11-23 11:38:51', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `nivel` varchar(255) NOT NULL,
  `alvo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `menu`
--

INSERT INTO `menu` (`id`, `descricao`, `nivel`, `alvo`) VALUES
(1, 'Consultar Livros', 'COMUM', 'consultar-livros'),
(2, 'Meus Livros', 'COMUM', 'meus-livros'),
(3, 'Ger. Empréstimos', 'ADMINISTRADOR', 'emprestimos'),
(4, 'Ger. Empréstimos', 'BIBLIOTECARIO', 'emprestimos'),
(5, 'Meus Empréstimos', 'COMUM', 'meus-emprestimos'),
(7, 'Ger. Estoque', 'ADMINISTRADOR', 'estoque');

-- --------------------------------------------------------

--
-- Estrutura para tabela `msgbox`
--

CREATE TABLE `msgbox` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `mensagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `msgbox`
--

INSERT INTO `msgbox` (`id`, `codigo`, `mensagem`) VALUES
(1, 1001, 'Solicitação enviada com sucesso!'),
(2, 4001, 'Erro no envio da solicitação!'),
(3, 1002, 'Inserção realizada com sucesso!'),
(4, 4002, 'Erro na inserção!'),
(5, 1003, 'Atualização realizada com sucesso!'),
(7, 4004, 'Você possui pendências!'),
(8, 4005, 'Você pode emprestar livros a partir de: ');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `dt_verificacao` datetime DEFAULT NULL,
  `dt_cadastro` datetime NOT NULL,
  `nivel` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `dt_verificacao`, `dt_cadastro`, `nivel`) VALUES
(1, 'ADMINISTRADOR', 'admin@bibliotech.org', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2021-11-02 02:27:51', '2021-11-02 02:27:51', 'ADMINISTRADOR');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_livro` (`fk_livro`),
  ADD KEY `fk_usuario` (`fk_usuario`),
  ADD KEY `fk_aprovador` (`fk_aprovador`);

--
-- Índices de tabela `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_livro` (`fk_livro`),
  ADD KEY `fk_usuario` (`fk_usuario`);

--
-- Índices de tabela `livro`
--
ALTER TABLE `livro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario` (`fk_usuario`);

--
-- Índices de tabela `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `msgbox`
--
ALTER TABLE `msgbox`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `livro`
--
ALTER TABLE `livro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `msgbox`
--
ALTER TABLE `msgbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD CONSTRAINT `emprestimo_ibfk_1` FOREIGN KEY (`fk_livro`) REFERENCES `livro` (`id`),
  ADD CONSTRAINT `emprestimo_ibfk_2` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`id`);

--
-- Restrições para tabelas `estoque`
--
ALTER TABLE `estoque`
  ADD CONSTRAINT `estoque_ibfk_1` FOREIGN KEY (`fk_livro`) REFERENCES `livro` (`id`),
  ADD CONSTRAINT `estoque_ibfk_2` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`id`);

--
-- Restrições para tabelas `livro`
--
ALTER TABLE `livro`
  ADD CONSTRAINT `livro_ibfk_1` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
