-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2013 at 03:25 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ajlopez`
--
CREATE DATABASE IF NOT EXISTS `ajlopez` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ajlopez`;

-- --------------------------------------------------------

--
-- Table structure for table `articulos`
--

CREATE TABLE IF NOT EXISTS `articulos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(100) NOT NULL DEFAULT '',
  `IdClase` int(11) NOT NULL DEFAULT '0',
  `IdIdioma` int(11) NOT NULL DEFAULT '0',
  `IdSitio` int(11) NOT NULL DEFAULT '0',
  `Contenido` text NOT NULL,
  `EsHTML` tinyint(4) NOT NULL DEFAULT '0',
  `Resumen` text NOT NULL,
  `Copete` text NOT NULL,
  `Archivo` varchar(100) NOT NULL DEFAULT '',
  `IdUsuario` int(11) NOT NULL DEFAULT '0',
  `Orden` tinyint(4) NOT NULL DEFAULT '0',
  `Visitas` int(11) NOT NULL DEFAULT '0',
  `Votos1` int(11) NOT NULL DEFAULT '0',
  `Votos2` int(11) NOT NULL DEFAULT '0',
  `Votos3` int(11) NOT NULL DEFAULT '0',
  `Votos4` int(11) NOT NULL DEFAULT '0',
  `Votos5` int(11) NOT NULL DEFAULT '0',
  `Imagen` varchar(100) NOT NULL DEFAULT '',
  `TextoImagen` text NOT NULL,
  `IdEstado` tinyint(4) NOT NULL DEFAULT '0',
  `FechaHoraAlta` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `FechaHoraModificacion` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Enlace` varchar(120) NOT NULL DEFAULT '',
  `VigenciaDesde` date NOT NULL DEFAULT '0000-00-00',
  `VigenciaHasta` date NOT NULL DEFAULT '0000-00-00',
  `Comentarios` int(11) NOT NULL DEFAULT '0',
  `Prioridad` tinyint(4) NOT NULL DEFAULT '0',
  `EsNuevo` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1527 ;

-- --------------------------------------------------------

--
-- Table structure for table `articulosclases`
--

CREATE TABLE IF NOT EXISTS `articulosclases` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `articulossugeridos`
--

CREATE TABLE IF NOT EXISTS `articulossugeridos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdUsuario` int(11) NOT NULL DEFAULT '0',
  `IdCategoria` int(11) NOT NULL DEFAULT '0',
  `FechaHora` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Descripcion` varchar(100) NOT NULL DEFAULT '',
  `Url` varchar(200) NOT NULL DEFAULT '',
  `Detalle` text NOT NULL,
  `Estado` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `IdUsuario` (`IdUsuario`,`IdCategoria`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(60) NOT NULL DEFAULT '',
  `Alias` varchar(16) NOT NULL DEFAULT '',
  `Detalle` text NOT NULL,
  `Resumen` text NOT NULL,
  `IdPadre` int(11) NOT NULL DEFAULT '0',
  `IdReferencia` int(11) NOT NULL DEFAULT '0',
  `Estado` tinyint(4) NOT NULL DEFAULT '0',
  `Visitas` int(11) NOT NULL DEFAULT '0',
  `Description` varchar(60) NOT NULL DEFAULT '',
  `Detail` text NOT NULL,
  `Abstract` text NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `IdPadre` (`IdPadre`),
  KEY `IdReferencia` (`IdReferencia`),
  KEY `Alias` (`Alias`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

-- --------------------------------------------------------

--
-- Table structure for table `categoriasarticulos`
--

CREATE TABLE IF NOT EXISTS `categoriasarticulos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdArticulo` int(11) NOT NULL DEFAULT '0',
  `IdCategoria` int(11) NOT NULL DEFAULT '0',
  `Estado` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `IdArticulo` (`IdArticulo`,`IdCategoria`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1721 ;

-- --------------------------------------------------------

--
-- Table structure for table `categoriasitems`
--

CREATE TABLE IF NOT EXISTS `categoriasitems` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdItem` int(11) NOT NULL DEFAULT '0',
  `IdCategoria` int(11) NOT NULL DEFAULT '0',
  `Estado` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `IdCategoria` (`IdCategoria`),
  KEY `IdItem` (`IdItem`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3004 ;

-- --------------------------------------------------------

--
-- Table structure for table `categoriasnoticias`
--

CREATE TABLE IF NOT EXISTS `categoriasnoticias` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdNoticia` int(11) NOT NULL DEFAULT '0',
  `IdCategoria` int(11) NOT NULL DEFAULT '0',
  `Estado` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `IdNoticia` (`IdNoticia`),
  KEY `IdCategoria` (`IdCategoria`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `categoriassugeridas`
--

CREATE TABLE IF NOT EXISTS `categoriassugeridas` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdUsuario` int(11) NOT NULL DEFAULT '0',
  `IdCategoria` int(11) NOT NULL DEFAULT '0',
  `FechaHora` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Descripcion` varchar(100) NOT NULL DEFAULT '',
  `Detalle` text NOT NULL,
  `Estado` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `IdUsuario` (`IdUsuario`,`IdCategoria`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE IF NOT EXISTS `comentarios` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdItem` int(11) NOT NULL DEFAULT '0',
  `IdArticulo` int(11) NOT NULL DEFAULT '0',
  `IdPagina` int(11) NOT NULL DEFAULT '0',
  `IdUsuario` int(11) NOT NULL DEFAULT '0',
  `Nombre` varchar(100) NOT NULL DEFAULT '',
  `Email` varchar(100) NOT NULL DEFAULT '',
  `Texto` text NOT NULL,
  `Estado` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `IdItem` (`IdItem`),
  KEY `IdArticulo` (`IdArticulo`),
  KEY `IdPagina` (`IdPagina`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contactos`
--

CREATE TABLE IF NOT EXISTS `contactos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdUsuario` int(11) NOT NULL DEFAULT '0',
  `Email` varchar(100) NOT NULL DEFAULT '',
  `Motivo` varchar(100) NOT NULL DEFAULT '',
  `Texto` text NOT NULL,
  `FechaHora` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Estado` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `IdUsuario` (`IdUsuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4558 ;

-- --------------------------------------------------------

--
-- Table structure for table `cursos`
--

CREATE TABLE IF NOT EXISTS `cursos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Codigo` varchar(16) NOT NULL DEFAULT '',
  `Descripcion` varchar(60) NOT NULL DEFAULT '',
  `IdCategoria` int(11) NOT NULL DEFAULT '0',
  `Detalle` text NOT NULL,
  `Objetivos` text NOT NULL,
  `Requisitos` text NOT NULL,
  `Plan` text NOT NULL,
  `Material` text NOT NULL,
  `Modalidad` text NOT NULL,
  `Precio` text NOT NULL,
  `ImportePrecio` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ImporteMateriales` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Observaciones` text NOT NULL,
  `Inscripcion` text NOT NULL,
  `Inicio` text NOT NULL,
  `Duracion` text NOT NULL,
  `ListaCorreo` varchar(30) NOT NULL DEFAULT '',
  `Profesor` text NOT NULL,
  `EmailProfesor` varchar(50) NOT NULL DEFAULT '',
  `Estado` tinyint(4) NOT NULL DEFAULT '0',
  `Habilitado` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Codigo_2` (`Codigo`),
  KEY `Codigo` (`Codigo`),
  KEY `IdCategoria` (`IdCategoria`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cursoscategorias`
--

CREATE TABLE IF NOT EXISTS `cursoscategorias` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(60) NOT NULL DEFAULT '',
  `Detalle` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdUsuario` int(11) NOT NULL DEFAULT '0',
  `De` varchar(100) NOT NULL DEFAULT '',
  `Para` varchar(100) NOT NULL DEFAULT '',
  `Tema` varchar(100) NOT NULL DEFAULT '',
  `Texto` text NOT NULL,
  `FechaHora` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Ip` varchar(20) NOT NULL DEFAULT '',
  `Estado` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `IdUsuario` (`IdUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `eventos`
--

CREATE TABLE IF NOT EXISTS `eventos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdUsuario` int(11) NOT NULL DEFAULT '0',
  `FechaHora` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Tipo` char(2) NOT NULL DEFAULT '',
  `Parametro` varchar(255) NOT NULL DEFAULT '',
  `Subparametro` varchar(255) NOT NULL DEFAULT '',
  `IdParametro` int(11) NOT NULL DEFAULT '0',
  `Ip` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`Id`),
  KEY `IdUsuario` (`IdUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `idiomas`
--

CREATE TABLE IF NOT EXISTS `idiomas` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(100) NOT NULL DEFAULT '',
  `Sigla` char(3) NOT NULL DEFAULT '',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(100) NOT NULL DEFAULT '',
  `IdClase` int(11) NOT NULL DEFAULT '0',
  `IdIdioma` int(11) NOT NULL DEFAULT '0',
  `IdSitio` int(11) NOT NULL DEFAULT '0',
  `Detalle` text NOT NULL,
  `IdUsuario` int(11) NOT NULL DEFAULT '0',
  `Url` varchar(200) NOT NULL DEFAULT '',
  `Orden` tinyint(4) NOT NULL DEFAULT '0',
  `Visitas` int(11) NOT NULL DEFAULT '0',
  `Votos1` int(11) NOT NULL DEFAULT '0',
  `Votos2` int(11) NOT NULL DEFAULT '0',
  `Votos3` int(11) NOT NULL DEFAULT '0',
  `Votos4` int(11) NOT NULL DEFAULT '0',
  `Votos5` int(11) NOT NULL DEFAULT '0',
  `Imagen` varchar(100) NOT NULL DEFAULT '',
  `Estado` tinyint(4) NOT NULL DEFAULT '0',
  `Comentarios` int(11) NOT NULL DEFAULT '0',
  `Prioridad` tinyint(4) NOT NULL DEFAULT '0',
  `EsNuevo` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `IdUsuario` (`IdUsuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2652 ;

-- --------------------------------------------------------

--
-- Table structure for table `itemsclases`
--

CREATE TABLE IF NOT EXISTS `itemsclases` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `itemssugeridos`
--

CREATE TABLE IF NOT EXISTS `itemssugeridos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdUsuario` int(11) NOT NULL DEFAULT '0',
  `IdCategoria` int(11) NOT NULL DEFAULT '0',
  `FechaHora` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Descripcion` varchar(100) NOT NULL DEFAULT '',
  `Url` varchar(200) NOT NULL DEFAULT '',
  `Detalle` text NOT NULL,
  `Estado` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `IdUsuario` (`IdUsuario`,`IdCategoria`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lecciones`
--

CREATE TABLE IF NOT EXISTS `lecciones` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(255) NOT NULL DEFAULT '',
  `IdCurso` int(11) NOT NULL DEFAULT '0',
  `Orden` int(11) NOT NULL DEFAULT '0',
  `Nivel` int(11) NOT NULL DEFAULT '0',
  `IdAnterior` int(11) NOT NULL DEFAULT '0',
  `IdSiguiente` int(11) NOT NULL DEFAULT '0',
  `IdPadre` int(11) NOT NULL DEFAULT '0',
  `Archivo` varchar(255) NOT NULL DEFAULT '',
  `Visitas` int(11) NOT NULL DEFAULT '0',
  `Votos1` int(11) NOT NULL DEFAULT '0',
  `Votos2` int(11) NOT NULL DEFAULT '0',
  `Votos3` int(11) NOT NULL DEFAULT '0',
  `Votos4` int(11) NOT NULL DEFAULT '0',
  `Votos5` int(11) NOT NULL DEFAULT '0',
  `Estado` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `IdCurso` (`IdCurso`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(100) NOT NULL DEFAULT '',
  `Resumen` text NOT NULL,
  `IdUsuario` int(11) NOT NULL DEFAULT '0',
  `Copete` text NOT NULL,
  `Texto` text NOT NULL,
  `Imagen` varchar(100) NOT NULL DEFAULT '',
  `TextoImagen` text NOT NULL,
  `Orden` tinyint(4) NOT NULL DEFAULT '0',
  `Visitas` int(11) NOT NULL DEFAULT '0',
  `IdEstado` tinyint(4) NOT NULL DEFAULT '0',
  `VigenciaDesde` date DEFAULT NULL,
  `VigenciaHasta` date DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `IdUsuario` (`IdUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `paginas`
--

CREATE TABLE IF NOT EXISTS `paginas` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(200) NOT NULL DEFAULT '',
  `Alias` varchar(16) NOT NULL DEFAULT '',
  `Resumen` text NOT NULL,
  `Contenido` text NOT NULL,
  `EsHTML` tinyint(4) NOT NULL DEFAULT '0',
  `FechaHoraAlta` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `FechaHoraModificacion` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Visitas` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `Alias` (`Alias`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=267 ;

-- --------------------------------------------------------

--
-- Table structure for table `pagos`
--

CREATE TABLE IF NOT EXISTS `pagos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdUsuario` int(11) NOT NULL DEFAULT '0',
  `IdCurso` int(11) NOT NULL DEFAULT '0',
  `Fecha` date NOT NULL DEFAULT '0000-00-00',
  `Importe` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Divisa` varchar(30) NOT NULL DEFAULT '',
  `Apellido` varchar(50) NOT NULL DEFAULT '',
  `Nombre` varchar(50) NOT NULL DEFAULT '',
  `Comprobante` varchar(30) NOT NULL DEFAULT '',
  `Tipo` char(2) NOT NULL DEFAULT '',
  `Observaciones` text NOT NULL,
  `Estado` tinyint(4) NOT NULL DEFAULT '0',
  `FechaHora` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Id`),
  KEY `IdUsuario` (`IdUsuario`,`IdCurso`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `paises`
--

CREATE TABLE IF NOT EXISTS `paises` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`Id`),
  KEY `Descripcion` (`Descripcion`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Table structure for table `preferencias`
--

CREATE TABLE IF NOT EXISTS `preferencias` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdUsuario` int(11) NOT NULL DEFAULT '0',
  `Novedades` tinyint(4) NOT NULL DEFAULT '0',
  `Html` tinyint(4) NOT NULL DEFAULT '0',
  `Internet` tinyint(4) NOT NULL DEFAULT '0',
  `Deportes` tinyint(4) NOT NULL DEFAULT '0',
  `Educacion` tinyint(4) NOT NULL DEFAULT '0',
  `Ciencia` tinyint(4) NOT NULL DEFAULT '0',
  `Tecnologia` tinyint(4) NOT NULL DEFAULT '0',
  `Computacion` tinyint(4) NOT NULL DEFAULT '0',
  `Negocios` tinyint(4) NOT NULL DEFAULT '0',
  `Empleo` tinyint(4) NOT NULL DEFAULT '0',
  `Finanzas` tinyint(4) NOT NULL DEFAULT '0',
  `Viajes` tinyint(4) NOT NULL DEFAULT '0',
  `Compras` tinyint(4) NOT NULL DEFAULT '0',
  `Juegos` tinyint(4) NOT NULL DEFAULT '0',
  `Entretenimiento` tinyint(4) NOT NULL DEFAULT '0',
  `Salud` tinyint(4) NOT NULL DEFAULT '0',
  `Familia` tinyint(4) NOT NULL DEFAULT '0',
  `FechaHoraCreacion` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `FechaHoraModificacion` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `IdUsuario` (`IdUsuario`),
  KEY `IdUsuario_2` (`IdUsuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=176 ;

-- --------------------------------------------------------

--
-- Table structure for table `puntos`
--

CREATE TABLE IF NOT EXISTS `puntos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdUsuario` int(11) NOT NULL DEFAULT '0',
  `FechaHora` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Puntos` int(11) NOT NULL DEFAULT '0',
  `Cantidad` int(11) NOT NULL DEFAULT '0',
  `Tipo` tinyint(4) NOT NULL DEFAULT '0',
  `IdParametro` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `IdUsuario` (`IdUsuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7455 ;

-- --------------------------------------------------------

--
-- Table structure for table `recomendados`
--

CREATE TABLE IF NOT EXISTS `recomendados` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdUsuario` int(11) NOT NULL DEFAULT '0',
  `De` varchar(60) NOT NULL DEFAULT '',
  `Para` varchar(60) NOT NULL DEFAULT '',
  `FechaHora` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `IP` varchar(20) NOT NULL DEFAULT '',
  `Enviado` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `IdUsuario` (`IdUsuario`,`De`,`Para`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `referencias`
--

CREATE TABLE IF NOT EXISTS `referencias` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(100) NOT NULL DEFAULT '',
  `Detalle` text NOT NULL,
  `Enlace` varchar(150) NOT NULL DEFAULT '',
  `IdItem` int(11) NOT NULL DEFAULT '0',
  `IdArticulo` int(11) NOT NULL DEFAULT '0',
  `IdCategoria` int(11) NOT NULL DEFAULT '0',
  `IdPagina` int(11) NOT NULL DEFAULT '0',
  `CodigoPagina` varchar(20) NOT NULL DEFAULT '',
  `Prioridad` int(11) NOT NULL DEFAULT '0',
  `Visitas` int(11) NOT NULL DEFAULT '0',
  `Estado` tinyint(4) NOT NULL DEFAULT '0',
  `FechaHoraAlta` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `FechaHoraModificacion` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=269 ;

-- --------------------------------------------------------

--
-- Table structure for table `sitios`
--

CREATE TABLE IF NOT EXISTS `sitios` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(100) NOT NULL DEFAULT '',
  `Enlace` varchar(100) NOT NULL DEFAULT '',
  `Dominio` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `tablas`
--

CREATE TABLE IF NOT EXISTS `tablas` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Codigo` varchar(30) NOT NULL DEFAULT '',
  `Descripcion` varchar(50) NOT NULL DEFAULT '',
  `Singular` varchar(50) NOT NULL DEFAULT '',
  `Plural` varchar(50) NOT NULL DEFAULT '',
  `IdGenero` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Codigo` (`Codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Codigo` varchar(16) NOT NULL DEFAULT '',
  `Contrasenia` varchar(16) NOT NULL DEFAULT '',
  `IdReferente` int(11) NOT NULL DEFAULT '0',
  `Nombre` varchar(40) NOT NULL DEFAULT '',
  `Apellido` varchar(40) NOT NULL DEFAULT '',
  `Email` varchar(50) NOT NULL DEFAULT '',
  `NosConoce` char(2) NOT NULL DEFAULT '',
  `Comentarios` text NOT NULL,
  `IdSexo` tinyint(4) NOT NULL DEFAULT '0',
  `IdPais` int(11) NOT NULL DEFAULT '0',
  `Provincia` varchar(30) NOT NULL DEFAULT '',
  `Ciudad` varchar(40) NOT NULL DEFAULT '',
  `CodigoPostal` varchar(10) NOT NULL DEFAULT '',
  `FechaNacimiento` date NOT NULL DEFAULT '0000-00-00',
  `EsAdministrador` tinyint(4) NOT NULL DEFAULT '0',
  `EsTutor` tinyint(4) NOT NULL DEFAULT '0',
  `EsCliente` tinyint(4) NOT NULL DEFAULT '0',
  `EsAfiliado` tinyint(4) NOT NULL DEFAULT '0',
  `FechaHoraAlta` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `FechaHoraModificacion` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `FechaHoraUltimoIngreso` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Ingresos` int(11) NOT NULL DEFAULT '0',
  `Puntos` int(11) NOT NULL DEFAULT '0',
  `PuntosAnteriores` int(11) NOT NULL DEFAULT '0',
  `PuntosPendientes` int(11) NOT NULL DEFAULT '0',
  `Verificado` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Codigo` (`Codigo`),
  KEY `Email` (`Email`),
  KEY `IdReferente` (`IdReferente`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=179 ;

-- --------------------------------------------------------

--
-- Table structure for table `usuarioscursos`
--

CREATE TABLE IF NOT EXISTS `usuarioscursos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdUsuario` int(11) NOT NULL DEFAULT '0',
  `IdCurso` int(11) NOT NULL DEFAULT '0',
  `FechaHoraInscripcion` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Precio` decimal(10,2) NOT NULL DEFAULT '0.00',
  `PrecioOriginal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Puntos` int(11) NOT NULL DEFAULT '0',
  `FechaHoraPago` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Estado` tinyint(4) NOT NULL DEFAULT '0',
  `Visitas` int(11) NOT NULL DEFAULT '0',
  `Importe` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Habilitado` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `IdUsuario` (`IdUsuario`,`IdCurso`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `sesion` (
   `Id` int(10) unsigned NOT NULL auto_increment,
   `Codigo` varchar(20) NOT NULL,
   `Texto` text NOT NULL,
   `Tiempo` int(11) DEFAULT '0' NOT NULL,
   PRIMARY KEY (`Id`),
   UNIQUE `Codigo_2` (`Codigo`),
   KEY `Codigo` (`Codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
