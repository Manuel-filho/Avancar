-- Esquema Inicial da Base de Dados para o projeto Avançar
-- Versão: 1.0
--
-- Autor: Jules
-- Data de Criação: 28/08/2025

-- Habilita o modo estrito para uma melhor integridade dos dados
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `data_criacao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

COMMIT;
