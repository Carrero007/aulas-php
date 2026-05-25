CREATE DATABASE IF NOT EXISTS db_cep;

USE db_cep;

CREATE TABLE `endereco` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cep` varchar(8) NOT NULL,
  `logradouro` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `pais` varchar(255) DEFAULT NULL
);

INSERT INTO `endereco` (`id`, `cep`, `logradouro`, `bairro`, `cidade`, `estado`, `pais`) VALUES
(1, '13175667', 'Avenida Ipê Amarelo', 'Parque Villa Flores', 'Sumaré', 'SP', 'Brasil'),
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
