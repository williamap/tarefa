-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 26-Nov-2019 às 16:39
-- Versão do servidor: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imagens`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `galeria`
--

CREATE TABLE `galeria` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `descricao` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `galeria`
--

INSERT INTO `galeria` (`id`, `nome`, `descricao`) VALUES
(1, 'Fotos do Campus', 'Contém fotos do Campus, tiradas ao longo do tempo.'),
(2, 'E-TIC', 'Contém fotos do Encontro de Tecnologia da Informação e Comunicação do IFC-Camboriú.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagem`
--

CREATE TABLE `imagem` (
  `id` int(11) NOT NULL,
  `descricao` varchar(256) NOT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `arquivo` varchar(256) NOT NULL,
  `galeria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `imagem`
--

INSERT INTO `imagem` (`id`, `descricao`, `data`, `arquivo`, `galeria_id`) VALUES
(1, 'Foto aerea do predio principal', '2019-11-26 15:02:21', 'g1_foto1.jpg', 1),
(2, 'Foto da entrada do predio principal', '2019-11-26 15:02:21', 'g1_foto2.jpg', 1),
(3, 'Foto aerea do Campus', '2019-11-26 15:02:57', 'g1_foto3.jpg', 1),
(4, 'Bloco A', '2019-11-26 15:02:57', 'g1_foto4.jpg', 1),
(5, 'Campeonato de e-Games 2018', '2019-11-26 15:03:44', 'g2_foto1.png', 2),
(6, 'Palestra e-TIC 2018', '2019-11-26 15:03:44', 'g2_foto2.png', 2),
(7, 'Encerramento e-TIC2018', '2019-11-26 15:04:27', 'g2_foto3.jpg', 2),
(8, 'Encerramento e-TIC 2018', '2019-11-26 15:04:27', 'g2_foto4.jpg', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `galeria`
--
ALTER TABLE `galeria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imagem`
--
ALTER TABLE `imagem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_galeria` (`galeria_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `galeria`
--
ALTER TABLE `galeria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `imagem`
--
ALTER TABLE `imagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `imagem`
--
ALTER TABLE `imagem`
  ADD CONSTRAINT `imagem_ibfk_1` FOREIGN KEY (`galeria_id`) REFERENCES `galeria` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
