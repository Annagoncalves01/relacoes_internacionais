-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11/04/2025 às 15:18
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
-- Banco de dados: `relacoes_internacionais`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `objetivos`
--

CREATE TABLE `objetivos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `prazo` date DEFAULT NULL,
  `tipo_prazo` enum('curto','medio','longo') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `perguntas`
--

CREATE TABLE `perguntas` (
  `id` int(11) NOT NULL,
  `texto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `perguntas`
--

INSERT INTO `perguntas` (`id`, `texto`) VALUES
(1, 'Como você lida com desafios criativos?'),
(2, 'Quando você observa um prédio ou um ambiente, o que mais chama sua atenção?'),
(3, 'Você gosta de desenhar ou criar projetos visuais?'),
(4, 'Como você se sente em relação a matemática e cálculos?'),
(5, 'Você costuma reparar na organização dos espaços ao seu redor?'),
(6, 'Como você lida com trabalho em equipe?'),
(7, 'Você se interessa por tecnologia aplicada a construções e design?'),
(8, 'Como você se sente ao lidar com prazos e projetos longos?'),
(9, 'Você gosta de visitar museus, exposições de arte ou lugares históricos?'),
(10, 'Como você lida com críticas e feedback sobre suas ideias?'),
(11, 'Como você se sente ao trabalhar com softwares e ferramentas digitais para criação de projetos?'),
(12, 'Quando você vê uma construção mal planejada ou um espaço desconfortável, qual é sua reação?'),
(13, 'Como você se sente ao estudar história e teoria da arte e arquitetura?'),
(14, 'Você gosta de experimentar diferentes estilos estéticos em seus projetos ou criações?'),
(15, 'Se tivesse que projetar uma casa dos sonhos, o que mais te empolgaria?');

-- --------------------------------------------------------

--
-- Estrutura para tabela `plano_acao`
--

CREATE TABLE `plano_acao` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `area` enum('Relacionamento Familiar','Estudos','Saúde','Futura Profissão','Religião','Amigos','Namorado(a)','Comunidade','Tempo Livre') DEFAULT NULL,
  `passo` int(11) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `prazo` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `profissoes`
--

CREATE TABLE `profissoes` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `areas_atuacao` text DEFAULT NULL,
  `salario_medio` decimal(10,2) DEFAULT NULL,
  `relacoes_internacionais_relevancia` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `respostas`
--

CREATE TABLE `respostas` (
  `id` int(11) NOT NULL,
  `pergunta_id` int(11) NOT NULL,
  `texto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `respostas`
--

INSERT INTO `respostas` (`id`, `pergunta_id`, `texto`) VALUES
(1, 1, 'Adoro desafios e sempre busco soluções inovadoras.'),
(2, 1, 'Gosto de criatividade, mas prefiro seguir referências prontas.'),
(3, 1, 'Não sou muito criativo, mas gosto de resolver problemas práticos.'),
(4, 1, 'Evito desafios criativos, prefiro tarefas mais objetivas.'),
(5, 2, 'O design e os detalhes arquitetônicos.'),
(6, 2, 'A funcionalidade e como ele atende às necessidades das pessoas.'),
(7, 2, 'O impacto ambiental e sustentável da construção.'),
(8, 2, 'Apenas passo reto, sem prestar muita atenção.'),
(9, 3, 'Sim, adoro desenhar e imaginar novos espaços.'),
(10, 3, 'Gosto, mas não me sinto muito talentoso nisso.'),
(11, 3, 'Prefiro trabalhar com números e cálculos do que com desenho.'),
(12, 3, 'Não gosto de desenhar nem de criar projetos visuais.'),
(13, 4, 'Gosto e não tenho dificuldade com cálculos e medidas.'),
(14, 4, 'Não sou fã, mas consigo lidar bem com matemática quando necessário.'),
(15, 4, 'Tenho dificuldade com matemática, mas me interesso por design e criação.'),
(16, 4, 'Detesto matemática e evito ao máximo.'),
(17, 5, 'Sim, sempre observo como os espaços são organizados e como poderiam melhorar.'),
(18, 5, 'Às vezes reparo, mas não é algo que me chama muito a atenção.'),
(19, 5, 'Só percebo se o espaço estiver muito bagunçado ou desorganizado.'),
(20, 5, 'Não presto atenção nisso.'),
(21, 6, 'Gosto de colaborar e discutir ideias para encontrar as melhores soluções.'),
(22, 6, 'Trabalho bem em equipe, mas prefiro tarefas individuais.'),
(23, 6, 'Só gosto de trabalhar sozinho, não sou muito fã de discussões em grupo.'),
(24, 6, 'Tenho dificuldade de trabalhar com outras pessoas.'),
(25, 7, 'Sim, acho fascinante o uso de tecnologia na arquitetura e no design.'),
(26, 7, 'Gosto de tecnologia, mas prefiro áreas mais tradicionais.'),
(27, 7, 'Não tenho muito interesse em tecnologia aplicada à construção.'),
(28, 7, 'Não me interesso por tecnologia de forma geral.'),
(29, 8, 'Me organizo bem e gosto de desafios de longo prazo.'),
(30, 8, 'Consigo lidar com prazos, mas às vezes procrastino um pouco.'),
(31, 8, 'Tenho dificuldade em manter o foco em projetos longos.'),
(32, 8, 'Não gosto de projetos demorados, prefiro tarefas rápidas e diretas.'),
(33, 9, 'Sim, adoro observar a arquitetura e o design dos lugares.'),
(34, 9, 'Gosto, mas não é algo que faço com frequência.'),
(35, 9, 'Só vou quando sou obrigado ou por curiosidade ocasional.'),
(36, 9, 'Não me interesso por isso.'),
(37, 10, 'Vejo como uma oportunidade de melhorar e aprender mais.'),
(38, 10, 'Tento aceitar, mas às vezes me sinto desmotivado.'),
(39, 10, 'Fico um pouco incomodado, mas aceito se for necessário.'),
(40, 10, 'Não gosto de críticas, prefiro seguir minhas próprias ideias.'),
(41, 11, 'Adoro! Já me interesso por programas de design e modelagem 3D.'),
(42, 11, 'Tenho interesse, mas nunca tive muito contato com essas ferramentas.'),
(43, 11, 'Prefiro trabalhar com papel e lápis do que com softwares.'),
(44, 11, 'Não gosto de tecnologia aplicada ao design.'),
(45, 12, 'Penso imediatamente em como ele poderia ser melhorado.'),
(46, 12, 'Percebo o problema, mas não sei exatamente como resolver.'),
(47, 12, 'Só me incomodo se for algo muito óbvio.'),
(48, 12, 'Nem percebo esses detalhes.'),
(49, 13, 'Acho fascinante e gosto de entender a evolução do design e das construções.'),
(50, 13, 'Gosto, mas prefiro a parte prática da Arquitetura.'),
(51, 13, 'Não me interesso muito por teoria, prefiro cálculos e planejamento.'),
(52, 13, 'Acho desnecessário, prefiro assuntos mais técnicos e objetivos.'),
(53, 14, 'Sim, adoro explorar diferentes estilos e tendências de design.'),
(54, 14, 'Gosto, mas às vezes fico inseguro sobre minhas escolhas.'),
(55, 14, 'Prefiro seguir um estilo fixo sem muitas variações.'),
(56, 14, 'Não me interesso por estética, apenas pela funcionalidade.'),
(57, 15, 'Criar um design inovador e único.'),
(58, 15, 'Pensar em soluções funcionais para cada ambiente.'),
(59, 15, 'Calcular a estrutura e garantir que tudo fique seguro e viável.'),
(60, 15, 'Não tenho muito interesse nesse tipo de projeto.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `respostas_autoconhecimento`
--

CREATE TABLE `respostas_autoconhecimento` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pergunta` text DEFAULT NULL,
  `resposta` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `resultados`
--

CREATE TABLE `resultados` (
  `id` int(11) NOT NULL,
  `teste_id` int(11) NOT NULL,
  `resultado` varchar(255) NOT NULL,
  `interpretacao` text NOT NULL,
  `imagem_resultado` varchar(255) NOT NULL,
  `data_resultado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sonhos`
--

CREATE TABLE `sonhos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `acoes_atuais` text DEFAULT NULL,
  `acoes_futuras` text DEFAULT NULL,
  `area_relacoes_internacionais` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `testes`
--

CREATE TABLE `testes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `data_teste` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `testes_realizados`
--

CREATE TABLE `testes_realizados` (
  `id` int(11) NOT NULL,
  `teste_id` int(11) NOT NULL,
  `pergunta_id` int(11) NOT NULL,
  `resposta_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `teste_inteligencias`
--

CREATE TABLE `teste_inteligencias` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `logico_matematica` int(11) DEFAULT NULL,
  `linguistica` int(11) DEFAULT NULL,
  `espacial` int(11) DEFAULT NULL,
  `musical` int(11) DEFAULT NULL,
  `corporal_cinestesica` int(11) DEFAULT NULL,
  `interpessoal` int(11) DEFAULT NULL,
  `intrapessoal` int(11) DEFAULT NULL,
  `naturalista` int(11) DEFAULT NULL,
  `existencial` int(11) DEFAULT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `teste_personalidade_relacoes_internacionais`
--

CREATE TABLE `teste_personalidade_relacoes_internacionais` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tipo_teste` varchar(255) DEFAULT NULL,
  `pergunta` text DEFAULT NULL,
  `resposta` enum('A','B','C','D') DEFAULT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `sobre_mim` text DEFAULT NULL,
  `foto_perfil` longblob DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `email`, `senha`, `data_nascimento`, `sobre_mim`, `foto_perfil`, `created_at`, `updated_at`) VALUES
(1, 'Anna Clara Gonçalves de Oliveira', 'annaclaragoliveir08@gmail.com', '$2y$10$navoHnNGDkapEfHxvCkoyudY2dtKFbXz7ZdiFuMXT8G8TJ2ytvVju', '2025-04-09', NULL, NULL, '2025-04-09 10:31:00', '2025-04-09 11:32:08'),
(7, 'Anna Clara Gonçalves de Oliveira', 'usuario@exemplo.com', '$2y$10$hf2nE7PoLQ0CsF93h0kSnOz2l.Wq4iHOwpWHKrk4THqMJITvG/4sC', '2025-04-09', NULL, NULL, '2025-04-09 11:26:06', '2025-04-09 11:26:06'),
(8, 'Luan santana', 'luan@gmail.com', '$2y$10$rcXtKRpUg9QAfio84XdQ7u1fz.iJHcEen7U2YSP7rarqR3JSPgrXm', '2025-04-09', NULL, NULL, '2025-04-09 11:42:52', '2025-04-09 11:43:14'),
(9, 'Sara Ajala Silva', 'sara@gmail.com', '$2y$10$DZyWLQK6ytyQM2.KTyVBRuSFPkCX3v5mdnekl2ADdn4.BveCrwanm', '2025-04-09', NULL, NULL, '2025-04-09 11:43:47', '2025-04-09 11:44:04');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `objetivos`
--
ALTER TABLE `objetivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `perguntas`
--
ALTER TABLE `perguntas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `plano_acao`
--
ALTER TABLE `plano_acao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `profissoes`
--
ALTER TABLE `profissoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `respostas`
--
ALTER TABLE `respostas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `respostas_autoconhecimento`
--
ALTER TABLE `respostas_autoconhecimento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `resultados`
--
ALTER TABLE `resultados`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `sonhos`
--
ALTER TABLE `sonhos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `testes`
--
ALTER TABLE `testes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `testes_realizados`
--
ALTER TABLE `testes_realizados`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `teste_inteligencias`
--
ALTER TABLE `teste_inteligencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `teste_personalidade_relacoes_internacionais`
--
ALTER TABLE `teste_personalidade_relacoes_internacionais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `objetivos`
--
ALTER TABLE `objetivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `perguntas`
--
ALTER TABLE `perguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `plano_acao`
--
ALTER TABLE `plano_acao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `profissoes`
--
ALTER TABLE `profissoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `respostas`
--
ALTER TABLE `respostas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de tabela `respostas_autoconhecimento`
--
ALTER TABLE `respostas_autoconhecimento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `resultados`
--
ALTER TABLE `resultados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sonhos`
--
ALTER TABLE `sonhos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `testes`
--
ALTER TABLE `testes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `testes_realizados`
--
ALTER TABLE `testes_realizados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `teste_inteligencias`
--
ALTER TABLE `teste_inteligencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `teste_personalidade_relacoes_internacionais`
--
ALTER TABLE `teste_personalidade_relacoes_internacionais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `objetivos`
--
ALTER TABLE `objetivos`
  ADD CONSTRAINT `objetivos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `plano_acao`
--
ALTER TABLE `plano_acao`
  ADD CONSTRAINT `plano_acao_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `respostas_autoconhecimento`
--
ALTER TABLE `respostas_autoconhecimento`
  ADD CONSTRAINT `respostas_autoconhecimento_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `sonhos`
--
ALTER TABLE `sonhos`
  ADD CONSTRAINT `sonhos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `teste_inteligencias`
--
ALTER TABLE `teste_inteligencias`
  ADD CONSTRAINT `teste_inteligencias_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `teste_personalidade_relacoes_internacionais`
--
ALTER TABLE `teste_personalidade_relacoes_internacionais`
  ADD CONSTRAINT `teste_personalidade_relacoes_internacionais_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
