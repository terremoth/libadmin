-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 19-Maio-2016 às 22:14
-- Versão do servidor: 5.5.49-0ubuntu0.14.04.1
-- versão do PHP: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `db_libadmin`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_books`
--

CREATE TABLE IF NOT EXISTS `tb_books` (
  `id` int(8) NOT NULL AUTO_INCREMENT COMMENT 'Código unico da tabela',
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nome do Livro',
  `author` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Autor',
  `year` int(4) NOT NULL COMMENT 'Ano de lançamento',
  `edition` int(4) NOT NULL COMMENT 'Edição',
  `about` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tema do livro',
  `pages` int(5) NOT NULL COMMENT 'Quantidade de páginas',
  `isbn` bigint(15) DEFAULT NULL COMMENT 'Nº ISBN',
  `color` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Cor predominante',
  `grade` int(2) NOT NULL COMMENT 'Nota sobre o livro',
  `lang` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Lingua que o livro foi escrito',
  `resume` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Resumo, prefácio, resenha',
  `was_read` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Flag se o livro já foi lido',
  `publisher` varchar(60) NOT NULL COMMENT 'Editora',
  `type` smallint(10) NOT NULL DEFAULT '0' COMMENT 'Tipo do Livro',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Tabela de Cadastro de Livros' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
