-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/04/2025 às 19:00
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
-- Banco de dados: `relacoesinternacionais`
--

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
(1, 'Você gosta de conhecer pessoas de diferentes culturas e aprender sobre seus costumes?\r\n'),
(2, 'Você se sente confortável debatendo temas complexos e defendendo seu ponto de vista?\r\n\r\n'),
(3, 'Como você lida com conflitos entre pessoas de opiniões opostas?\r\n\r\n'),
(4, 'Você acompanha notícias sobre política internacional, economia global ou relações diplomáticas?\r\n\r\n'),
(5, 'Se pudesse escolher um trabalho, qual seria mais interessante para você?\r\n\r\n'),
(6, 'Se você fosse transferido para um país onde não conhece a cultura ou o idioma, como reagiria?\r\n\r\n'),
(7, 'Em uma negociação entre duas partes que não falam a mesma língua, como você agiria?\r\n\r\n'),
(8, 'Você tem interesse em aprender novos idiomas?\r\n\r\n'),
(9, 'Você gosta de estudar sobre história, geopolítica e culturas de outros países?\r\n\r\n\r\n'),
(10, 'Você se considera uma pessoa estratégica e analítica ao tomar decisões?\r\n\r\n'),
(11, 'Como você se sente ao trabalhar em equipe com pessoas de diferentes origens e perspectivas?\r\n\r\n'),
(12, 'Você se vê morando em outro país por um longo período?\r\n\r\n'),
(13, 'Como você lida com informações complexas e volumosas?\r\n\r\n'),
(14, 'O que mais te motiva ao escolher uma carreira?\r\n\r\n'),
(15, 'Como você se sente ao lidar com incertezas e mudanças?\r\n\r\n');

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
(1, 1, ' Sim, adoro aprender sobre novas culturas.\r\n'),
(2, 1, 'Às vezes, dependendo do assunto.'),
(3, 1, 'Não, prefiro manter minha zona de conforto.'),
(4, 1, ' Gosto de aprender, mas prefiro interações mais restritas.'),
(5, 2, 'Sim, adoro debates e argumentação.'),
(6, 2, ' Depende do tema, mas gosto de trocar ideias.'),
(7, 2, 'Não, evito discussões e debates.'),
(8, 2, ' Prefiro ouvir os outros, mas falo quando necessário.'),
(9, 3, ' Tento entender os dois lados e buscar uma solução equilibrada.\r\n'),
(10, 3, ' Analiso os argumentos, mas prefiro não me envolver.\r\n'),
(11, 3, ' Evito ao máximo entrar em conflitos.'),
(12, 3, ' Defendo minha posição, mas respeito a opinião dos outros.'),
(13, 4, ' Sim, leio regularmente sobre esses assuntos.'),
(14, 4, 'De vez em quando, quando algo importante acontece.\r\n'),
(15, 4, 'Não, não me interesso por esses temas.\r\n'),
(16, 4, 'Apenas quando o assunto afeta diretamente o meu país.'),
(17, 5, 'Trabalhar em uma organização internacional ajudando a resolver crises globais.\r\n\r\n'),
(18, 5, 'Trabalhar no governo ou em ONGs nacionais.\r\n\r\n'),
(19, 5, ' Trabalhar em uma empresa local, sem envolvimento com temas internacionais.\r\n\r\n '),
(20, 5, 'Trabalhar em um cargo estratégico que envolva comunicação e análise de dados.'),
(21, 6, 'Ficaria animado com a oportunidade de aprender e me adaptar.\r\n'),
(22, 6, 'Sentiria um pouco de receio, mas tentaria me adaptar.\r\n'),
(23, 6, 'Evitaria essa mudança, pois me sentiria desconfortável.\r\n'),
(24, 6, 'Tentaria aprender o básico para me adaptar, mas com alguns receios.'),
(25, 7, 'Tentaria mediar a conversa e encontrar um meio de comunicação.\r\n'),
(26, 7, 'Esperaria alguém mais experiente conduzir a conversa.\r\n'),
(27, 7, 'Não me envolveria, pois não saberia como agir.\r\n'),
(28, 7, 'Usaria ferramentas como tradutores e tentaria manter um diálogo básico.'),
(29, 8, ' Sim, adoro estudar novas línguas.\r\n'),
(30, 8, 'Sim, mas só se for necessário para o meu trabalho.\r\n'),
(31, 8, 'Não, prefiro falar apenas meu idioma nativo.'),
(32, 8, 'Tenho curiosidade, mas acho difícil aprender idiomas novos.'),
(33, 9, ' Sim, acho fascinante entender como o mundo funciona.\r\n'),
(34, 9, 'Às vezes, mas só quando o assunto me interessa.\r\n'),
(35, 9, 'Não, esses temas não me atraem.'),
(36, 9, ' Tenho interesse, mas prefiro aprender de forma prática e não teórica.'),
(37, 10, 'Sim, sempre analiso os cenários antes de agir.'),
(38, 10, 'Depende da situação, mas tento pensar bem antes de decidir.'),
(39, 10, 'Não, sou mais impulsivo e decido no momento.'),
(40, 10, 'Busco equilibrar análise e ação, sem perder tempo demais.o desmotivado.'),
(41, 11, 'Acho enriquecedor e gosto de ouvir diferentes pontos de vista.'),
(42, 11, 'Consigo me adaptar bem, mas às vezes pode ser desafiador.'),
(43, 11, 'Prefiro trabalhar com pessoas que compartilham a mesma visão que eu.'),
(44, 11, 'Depende da situação, mas busco manter um bom relacionamento profissional.'),
(45, 12, 'Sim, adoraria essa experiência.'),
(46, 12, ' Talvez, dependendo das condições.\r\n'),
(47, 12, 'Não, prefiro ficar no meu país.'),
(48, 12, ' Poderia tentar, mas com a opção de voltar se não me adaptar.'),
(49, 13, 'Analiso e organizo os dados para tomar decisões informadas.'),
(50, 13, 'Faço o possível para entender o essencial.'),
(51, 13, 'Evito lidar com muita informação, pois me sinto sobrecarregado.'),
(52, 13, 'Procuro simplificar as informações ao máximo.'),
(53, 14, 'Oportunidade de impactar positivamente o mundo.\r\n'),
(54, 14, 'Crescimento profissional e financeiro.'),
(55, 14, 'Estabilidade e segurança.'),
(56, 14, 'Desafios intelectuais e aprendizado contínuo.'),
(57, 15, 'Vejo como oportunidades de crescimento e aprendizado.'),
(58, 15, 'Me adapto, mas preciso de um tempo para processar.'),
(59, 15, 'Me sinto desconfortável e tento evitá-las.'),
(60, 15, 'Tento planejar ao máximo para minimizar surpresas.\r\n\r\n');

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
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
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
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `data_nascimento`, `sobre_mim`, `foto_perfil`, `created_at`, `updated_at`) VALUES
(1, 'anna clara', 'annaclaragoliveir08@gmail.com', '123', '2025-04-04', NULL, NULL, '2025-04-04 11:35:51', '2025-04-04 11:35:51');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `perguntas`
--
ALTER TABLE `perguntas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `respostas`
--
ALTER TABLE `respostas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `resultados`
--
ALTER TABLE `resultados`
  ADD PRIMARY KEY (`id`);

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
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `perguntas`
--
ALTER TABLE `perguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `respostas`
--
ALTER TABLE `respostas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de tabela `resultados`
--
ALTER TABLE `resultados`
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
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
