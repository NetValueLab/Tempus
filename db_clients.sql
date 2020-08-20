CREATE DATABASE db_clients;

USE db_clients;

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `entrada_nome` varchar(150) NOT NULL,
  `entrada_cpf` varchar(11) NOT NULL,
  `entrada_data_nasc` date NOT NULL,
  `entrada_data_cadastro` date NOT NULL,
  `entrada_renda` decimal(20,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `clientes` (`id_cliente`, `entrada_nome`, `entrada_cpf`, `entrada_data_nasc`, `entrada_data_cadastro`, `entrada_renda`) VALUES
(1, 'Lucas Leonardo Lima Genovez', '34271703818', '2020-08-18', '2020-08-19', '980.00'),
(2, 'Vitor Augusto Lima Genovez', '34271703874', '1998-11-24', '2020-08-19', '18000.00'),
(3, 'Luana Piovanni', '34271709815', '1988-06-09', '2020-08-19', '980.01'),
(4, 'Gustavo Santana', '12345678090', '1996-08-19', '2020-08-20', '2500.00'),
(5, 'Gabriel Silva Viera', '34271703850', '1990-08-06', '2020-08-20', '2500.01'),
(6, 'Ismael Salvador Genovez', '09093457891', '1935-12-05', '2020-08-19', '2500.02');