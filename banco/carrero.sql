-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Maio-2026 às 12:57
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `carrero`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `id` int(11) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `logradouro` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `pais` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`id`, `cep`, `logradouro`, `bairro`, `cidade`, `estado`, `pais`) VALUES
(2, '13175667', 'Avenida Ipê Amarelo', 'Parque Villa Flores', 'Sumaré', NULL, 'Brasil'),
(2, '01310100', 'Avenida Paulista', 'Bela Vista', 'São Paulo', 'SP', 'Brasil'),
(3, '22241330', 'Parque Nacional da Tijuca', 'Cosme Velho', 'Rio de Janeiro', 'RJ', 'Brasil'),
(4, '40026280', 'Largo do Pelourinho', 'Pelourinho', 'Salvador', 'BA', 'Brasil'),
(5, '22070000', 'Avenida Atlântica', 'Copacabana', 'Rio de Janeiro', 'RJ', 'Brasil'),
(6, '01024001', 'Rua da Cantareira', 'Centro Histórico', 'São Paulo', 'SP', 'Brasil'),
(7, '82590300', 'Rua Engenheiro Ostoja Roguski', 'Jardim Botânico', 'Curitiba', 'PR', 'Brasil'),
(8, '70050000', 'Esplanada dos Ministérios', 'Zona Cívico-Administrativa', 'Brasília', 'DF', 'Brasil'),
(9, '69010140', 'Avenida Eduardo Ribeiro', 'Centro', 'Manaus', 'AM', 'Brasil'),
(10, '55590000', 'Rua Beijupirá', 'Porto de Galinhas', 'Ipojuca', 'PE', 'Brasil'),
(11, '04094050', 'Avenida Pedro Álvares Cabral', 'Vila Mariana', 'São Paulo', 'SP', 'Brasil');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
