# phpMyAdmin MySQL-Dump
# http://phpwizard.net/phpMyAdmin/
#
# Host: localhost Database : ajlopez

# --------------------------------------------------------
#
# Table structure for table 'articulos'
#

DROP TABLE IF EXISTS articulos;
CREATE TABLE articulos (
   Id int(11) NOT NULL auto_increment,
   Titulo varchar(100) NOT NULL,
   IdClase int(11) DEFAULT '0' NOT NULL,
   Contenido text NOT NULL,
   Resumen text NOT NULL,
   Copete text NOT NULL,
   Archivo varchar(100) NOT NULL,
   IdUsuario int(11) DEFAULT '0' NOT NULL,
   Orden tinyint(4) DEFAULT '0' NOT NULL,
   Visitas int(11) DEFAULT '0' NOT NULL,
   Votos1 int(11) DEFAULT '0' NOT NULL,
   Votos2 int(11) DEFAULT '0' NOT NULL,
   Votos3 int(11) DEFAULT '0' NOT NULL,
   Votos4 int(11) DEFAULT '0' NOT NULL,
   Votos5 int(11) DEFAULT '0' NOT NULL,
   Imagen varchar(100) NOT NULL,
   TextoImagen text NOT NULL,
   IdEstado tinyint(4) DEFAULT '0' NOT NULL,
   FechaHoraAlta datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   FechaHoraModificacion datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   Enlace varchar(100) NOT NULL,
   VigenciaDesde date DEFAULT '0000-00-00' NOT NULL,
   VigenciaHasta date DEFAULT '0000-00-00' NOT NULL,
   PRIMARY KEY (Id)
);

#
# Dumping data for table 'articulos'
#

INSERT INTO articulos (Id, Titulo, IdClase, Contenido, Resumen, Copete, Archivo, IdUsuario, Orden, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5, Imagen, TextoImagen, IdEstado, FechaHoraAlta, FechaHoraModificacion, Enlace, VigenciaDesde, VigenciaHasta) VALUES ( '1', 'Nuestro primer programa en Java', '1', '', 'Para no romper la tradición, el primer programa en Java será un simple \"Hola, mundo\".', '', 'text/javahola.txt', '1', '0', '1', '0', '0', '0', '0', '0', '', '', '0', '2002-04-23 21:54:24', '2002-04-23 22:54:46', '', '0000-00-00', '0000-00-00');
INSERT INTO articulos (Id, Titulo, IdClase, Contenido, Resumen, Copete, Archivo, IdUsuario, Orden, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5, Imagen, TextoImagen, IdEstado, FechaHoraAlta, FechaHoraModificacion, Enlace, VigenciaDesde, VigenciaHasta) VALUES ( '4', 'Nuestra primer applet en Java', '1', '', 'Primer ejemplo de un applet, una aplicación Java a ejecutar en el \"browser\"', '', 'text/javaapplet.txt', '1', '0', '1', '0', '0', '0', '0', '0', '', '', '0', '2002-04-23 22:50:43', '2002-04-23 22:50:43', '', '0000-00-00', '0000-00-00');
INSERT INTO articulos (Id, Titulo, IdClase, Contenido, Resumen, Copete, Archivo, IdUsuario, Orden, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5, Imagen, TextoImagen, IdEstado, FechaHoraAlta, FechaHoraModificacion, Enlace, VigenciaDesde, VigenciaHasta) VALUES ( '2', 'Java como lenguaje y tecnología', '1', '', 'Una introducción a Java', '', 'text/javaintro.txt', '1', '0', '1', '0', '0', '0', '0', '0', '', '', '0', '2002-04-23 22:33:39', '2002-04-23 22:33:39', '', '0000-00-00', '0000-00-00');
INSERT INTO articulos (Id, Titulo, IdClase, Contenido, Resumen, Copete, Archivo, IdUsuario, Orden, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5, Imagen, TextoImagen, IdEstado, FechaHoraAlta, FechaHoraModificacion, Enlace, VigenciaDesde, VigenciaHasta) VALUES ( '3', 'El JDK', '1', '', 'El Java Development Kit', '', 'text/javajdk.txt', '1', '0', '1', '0', '0', '0', '0', '0', '', '', '0', '2002-04-23 22:41:05', '2002-04-23 22:41:05', '', '0000-00-00', '0000-00-00');

# --------------------------------------------------------
#
# Table structure for table 'articulosclases'
#

DROP TABLE IF EXISTS articulosclases;
CREATE TABLE articulosclases (
   Id int(11) NOT NULL auto_increment,
   Descripcion varchar(50) NOT NULL,
   PRIMARY KEY (Id)
);

#
# Dumping data for table 'articulosclases'
#

INSERT INTO articulosclases (Id, Descripcion) VALUES ( '1', 'Artículos');
INSERT INTO articulosclases (Id, Descripcion) VALUES ( '2', 'Noticias');

# --------------------------------------------------------
#
# Table structure for table 'articulossugeridos'
#

DROP TABLE IF EXISTS articulossugeridos;
CREATE TABLE articulossugeridos (
   Id int(11) NOT NULL auto_increment,
   IdUsuario int(11) DEFAULT '0' NOT NULL,
   IdCategoria int(11) DEFAULT '0' NOT NULL,
   FechaHora datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   Descripcion varchar(100) NOT NULL,
   Url varchar(200) NOT NULL,
   Detalle text NOT NULL,
   Estado tinyint(4) DEFAULT '0' NOT NULL,
   PRIMARY KEY (Id),
   KEY IdUsuario (IdUsuario, IdCategoria)
);

#
# Dumping data for table 'articulossugeridos'
#


# --------------------------------------------------------
#
# Table structure for table 'categorias'
#

DROP TABLE IF EXISTS categorias;
CREATE TABLE categorias (
   Id int(11) NOT NULL auto_increment,
   Descripcion varchar(60) NOT NULL,
   Alias varchar(16) NOT NULL,
   Detalle text NOT NULL,
   Resumen text NOT NULL,
   IdPadre int(11) DEFAULT '0' NOT NULL,
   IdReferencia int(11) DEFAULT '0' NOT NULL,
   Estado tinyint(4) DEFAULT '0' NOT NULL,
   Visitas int(11) DEFAULT '0' NOT NULL,
   PRIMARY KEY (Id),
   KEY IdPadre (IdPadre),
   KEY IdReferencia (IdReferencia),
   KEY Alias (Alias)
);

#
# Dumping data for table 'categorias'
#

INSERT INTO categorias (Id, Descripcion, Alias, Detalle, Resumen, IdPadre, IdReferencia, Estado, Visitas) VALUES ( '1', 'Programación', 'programacion', 'La programación de computadoras, es un tema fascinante e interminable. Abarca desde lenguajes hasta plataformas, desde diseño hasta la implementación, desde base de datos hasta objetos. Veamos apenas algunos de estos temas.', 'Todo sobre el desarrollo de software', '0', '0', '0', '39');
INSERT INTO categorias (Id, Descripcion, Alias, Detalle, Resumen, IdPadre, IdReferencia, Estado, Visitas) VALUES ( '2', 'Webmasters', 'webmasters', 'El desarrollo de sitios es un arte y una ciencia. Un webmaster, hoy, tiene que conocer de múltiples temas.', 'Las tecnologías de desarrollo de sitios', '0', '0', '0', '7');
INSERT INTO categorias (Id, Descripcion, Alias, Detalle, Resumen, IdPadre, IdReferencia, Estado, Visitas) VALUES ( '3', 'Internet', 'internet', 'Internet es un mundo virtual en paralelo al real. Una moderna biblioteca de babel, examinemos algunos de sus temas.', 'Sitios, recursos e información sobre la red de redes.', '0', '0', '0', '5');
INSERT INTO categorias (Id, Descripcion, Alias, Detalle, Resumen, IdPadre, IdReferencia, Estado, Visitas) VALUES ( '4', 'Java', 'java', 'El lenguaje Java ya tiene varios años, y sigue siendo una sólida ayuda para el desarrollador de software. Siendo multiplataforma desde el principio, totalmente basado en clases y objetos, actualmente ofrece una gran cantidad de librerías y tecnologías, tanto en el cliente como el servidor.', 'El lenguaje Java y su tecnología.', '1', '0', '0', '30');
INSERT INTO categorias (Id, Descripcion, Alias, Detalle, Resumen, IdPadre, IdReferencia, Estado, Visitas) VALUES ( '5', 'HTML', 'html', '', '', '2', '0', '0', '0');
INSERT INTO categorias (Id, Descripcion, Alias, Detalle, Resumen, IdPadre, IdReferencia, Estado, Visitas) VALUES ( '6', 'DHTML', 'dhtml', '', '', '2', '0', '0', '0');
INSERT INTO categorias (Id, Descripcion, Alias, Detalle, Resumen, IdPadre, IdReferencia, Estado, Visitas) VALUES ( '7', 'PHP', 'php', '', '', '2', '0', '0', '0');
INSERT INTO categorias (Id, Descripcion, Alias, Detalle, Resumen, IdPadre, IdReferencia, Estado, Visitas) VALUES ( '8', 'Java Server Pages', 'jsp', '', '', '2', '0', '0', '0');
INSERT INTO categorias (Id, Descripcion, Alias, Detalle, Resumen, IdPadre, IdReferencia, Estado, Visitas) VALUES ( '9', 'Active Server Pages', 'asp', '', '', '2', '0', '0', '1');
INSERT INTO categorias (Id, Descripcion, Alias, Detalle, Resumen, IdPadre, IdReferencia, Estado, Visitas) VALUES ( '10', 'Visual Basic', 'vb', '', '', '1', '0', '0', '0');
INSERT INTO categorias (Id, Descripcion, Alias, Detalle, Resumen, IdPadre, IdReferencia, Estado, Visitas) VALUES ( '11', 'C/C++', 'c', '', '', '1', '0', '0', '0');
INSERT INTO categorias (Id, Descripcion, Alias, Detalle, Resumen, IdPadre, IdReferencia, Estado, Visitas) VALUES ( '12', 'Pascal', 'pascal', '', '', '1', '0', '0', '0');
INSERT INTO categorias (Id, Descripcion, Alias, Detalle, Resumen, IdPadre, IdReferencia, Estado, Visitas) VALUES ( '13', 'COBOL', 'cobol', '', '', '1', '0', '0', '0');
INSERT INTO categorias (Id, Descripcion, Alias, Detalle, Resumen, IdPadre, IdReferencia, Estado, Visitas) VALUES ( '14', 'Smalltalk', 'smalltalk', '', '', '1', '0', '0', '0');

# --------------------------------------------------------
#
# Table structure for table 'categoriasarticulos'
#

DROP TABLE IF EXISTS categoriasarticulos;
CREATE TABLE categoriasarticulos (
   Id int(11) NOT NULL auto_increment,
   IdArticulo int(11) DEFAULT '0' NOT NULL,
   IdCategoria int(11) DEFAULT '0' NOT NULL,
   Estado tinyint(4) DEFAULT '0' NOT NULL,
   PRIMARY KEY (Id),
   KEY IdArticulo (IdArticulo, IdCategoria)
);

#
# Dumping data for table 'categoriasarticulos'
#

INSERT INTO categoriasarticulos (Id, IdArticulo, IdCategoria, Estado) VALUES ( '1', '2', '4', '0');
INSERT INTO categoriasarticulos (Id, IdArticulo, IdCategoria, Estado) VALUES ( '2', '3', '4', '0');
INSERT INTO categoriasarticulos (Id, IdArticulo, IdCategoria, Estado) VALUES ( '3', '4', '4', '0');
INSERT INTO categoriasarticulos (Id, IdArticulo, IdCategoria, Estado) VALUES ( '4', '1', '4', '0');

# --------------------------------------------------------
#
# Table structure for table 'categoriasitems'
#

DROP TABLE IF EXISTS categoriasitems;
CREATE TABLE categoriasitems (
   Id int(11) NOT NULL auto_increment,
   IdItem int(11) DEFAULT '0' NOT NULL,
   IdCategoria int(11) DEFAULT '0' NOT NULL,
   Estado tinyint(4) DEFAULT '0' NOT NULL,
   PRIMARY KEY (Id),
   KEY IdCategoria (IdCategoria),
   KEY IdItem (IdItem)
);

#
# Dumping data for table 'categoriasitems'
#

INSERT INTO categoriasitems (Id, IdItem, IdCategoria, Estado) VALUES ( '1', '1', '4', '0');

# --------------------------------------------------------
#
# Table structure for table 'categoriasnoticias'
#

DROP TABLE IF EXISTS categoriasnoticias;
CREATE TABLE categoriasnoticias (
   Id int(11) NOT NULL auto_increment,
   IdNoticia int(11) DEFAULT '0' NOT NULL,
   IdCategoria int(11) DEFAULT '0' NOT NULL,
   Estado tinyint(4) DEFAULT '0' NOT NULL,
   PRIMARY KEY (Id),
   KEY IdNoticia (IdNoticia),
   KEY IdCategoria (IdCategoria)
);

#
# Dumping data for table 'categoriasnoticias'
#


# --------------------------------------------------------
#
# Table structure for table 'categoriassugeridas'
#

DROP TABLE IF EXISTS categoriassugeridas;
CREATE TABLE categoriassugeridas (
   Id int(11) NOT NULL auto_increment,
   IdUsuario int(11) DEFAULT '0' NOT NULL,
   IdCategoria int(11) DEFAULT '0' NOT NULL,
   FechaHora datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   Descripcion varchar(100) NOT NULL,
   Detalle text NOT NULL,
   Estado tinyint(4) DEFAULT '0' NOT NULL,
   PRIMARY KEY (Id),
   KEY IdUsuario (IdUsuario, IdCategoria)
);

#
# Dumping data for table 'categoriassugeridas'
#


# --------------------------------------------------------
#
# Table structure for table 'contactos'
#

DROP TABLE IF EXISTS contactos;
CREATE TABLE contactos (
   Id int(11) NOT NULL auto_increment,
   IdUsuario int(11) DEFAULT '0' NOT NULL,
   Email varchar(100) NOT NULL,
   Motivo varchar(100) NOT NULL,
   Texto text NOT NULL,
   FechaHora datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   Estado tinyint(4) DEFAULT '0' NOT NULL,
   PRIMARY KEY (Id),
   KEY IdUsuario (IdUsuario)
);

#
# Dumping data for table 'contactos'
#


# --------------------------------------------------------
#
# Table structure for table 'cursos'
#

DROP TABLE IF EXISTS cursos;
CREATE TABLE cursos (
   Id int(11) NOT NULL auto_increment,
   Codigo varchar(16) NOT NULL,
   Descripcion varchar(60) NOT NULL,
   IdCategoria int(11) DEFAULT '0' NOT NULL,
   Detalle text NOT NULL,
   Objetivos text NOT NULL,
   Requisitos text NOT NULL,
   Plan text NOT NULL,
   Material text NOT NULL,
   Modalidad text NOT NULL,
   Precio text NOT NULL,
   ImportePrecio decimal(10,2) DEFAULT '0.00' NOT NULL,
   ImporteMateriales decimal(10,2) DEFAULT '0.00' NOT NULL,
   Observaciones text NOT NULL,
   Inscripcion text NOT NULL,
   Inicio text NOT NULL,
   Duracion text NOT NULL,
   ListaCorreo varchar(30) NOT NULL,
   Profesor text NOT NULL,
   EmailProfesor varchar(50) NOT NULL,
   Estado tinyint(4) DEFAULT '0' NOT NULL,
   Habilitado tinyint(4) DEFAULT '0' NOT NULL,
   PRIMARY KEY (Id),
   UNIQUE Codigo_2 (Codigo),
   KEY Codigo (Codigo),
   KEY IdCategoria (IdCategoria)
);

#
# Dumping data for table 'cursos'
#


# --------------------------------------------------------
#
# Table structure for table 'cursoscategorias'
#

DROP TABLE IF EXISTS cursoscategorias;
CREATE TABLE cursoscategorias (
   Id int(11) NOT NULL auto_increment,
   Descripcion varchar(60) NOT NULL,
   Detalle text NOT NULL,
   PRIMARY KEY (Id)
);

#
# Dumping data for table 'cursoscategorias'
#


# --------------------------------------------------------
#
# Table structure for table 'emails'
#

DROP TABLE IF EXISTS emails;
CREATE TABLE emails (
   Id int(11) NOT NULL auto_increment,
   IdUsuario int(11) DEFAULT '0' NOT NULL,
   De varchar(100) NOT NULL,
   Para varchar(100) NOT NULL,
   Tema varchar(100) NOT NULL,
   Texto text NOT NULL,
   FechaHora datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   Ip varchar(20) NOT NULL,
   Estado tinyint(4) DEFAULT '0' NOT NULL,
   PRIMARY KEY (Id),
   KEY IdUsuario (IdUsuario)
);

#
# Dumping data for table 'emails'
#


# --------------------------------------------------------
#
# Table structure for table 'eventos'
#

DROP TABLE IF EXISTS eventos;
CREATE TABLE eventos (
   Id int(11) NOT NULL auto_increment,
   IdUsuario int(11) DEFAULT '0' NOT NULL,
   FechaHora datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   Tipo char(2) NOT NULL,
   Parametro varchar(255) NOT NULL,
   Subparametro varchar(255) NOT NULL,
   IdParametro int(11) DEFAULT '0' NOT NULL,
   Ip varchar(20) NOT NULL,
   PRIMARY KEY (Id),
   KEY IdUsuario (IdUsuario)
);

#
# Dumping data for table 'eventos'
#

INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '1', '0', '2002-04-19 08:16:27', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '2', '0', '2002-04-19 08:20:54', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '3', '0', '2002-04-19 08:22:00', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '4', '0', '2002-04-19 08:23:38', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '5', '0', '2002-04-19 08:24:29', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '6', '1', '2002-04-19 08:27:02', 'IN', 'ajlopez', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '7', '1', '2002-04-19 08:30:30', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '8', '1', '2002-04-19 08:30:48', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '9', '1', '2002-04-19 08:30:55', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '10', '1', '2002-04-19 08:31:02', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '11', '1', '2002-04-19 08:31:14', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '12', '1', '2002-04-19 08:31:21', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '13', '1', '2002-04-19 08:33:28', 'PG', 'Tema.php', 'Id=3', '3', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '14', '1', '2002-04-19 08:33:51', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '15', '1', '2002-04-19 08:43:44', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '16', '1', '2002-04-19 08:45:09', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '17', '1', '2002-04-19 08:46:11', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '18', '1', '2002-04-19 08:46:52', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '19', '1', '2002-04-19 08:48:09', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '20', '1', '2002-04-19 08:48:17', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '21', '1', '2002-04-19 08:48:46', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '22', '1', '2002-04-19 08:48:49', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '23', '1', '2002-04-19 08:49:05', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '24', '1', '2002-04-19 08:51:44', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '25', '1', '2002-04-19 08:55:54', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '26', '1', '2002-04-19 08:55:56', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '27', '1', '2002-04-19 08:56:03', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '28', '1', '2002-04-19 08:58:47', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '29', '0', '2002-04-19 08:58:59', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '30', '0', '2002-04-19 09:00:03', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '31', '0', '2002-04-19 09:00:43', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '32', '0', '2002-04-19 09:01:10', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '33', '0', '2002-04-19 09:01:15', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '34', '0', '2002-04-19 09:01:17', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '35', '0', '2002-04-19 09:01:21', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '36', '0', '2002-04-19 09:02:11', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '37', '0', '2002-04-19 09:02:29', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '38', '0', '2002-04-19 09:02:42', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '39', '0', '2002-04-19 09:04:08', 'PG', 'Proyectos.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '40', '0', '2002-04-19 09:07:10', 'PG', 'Proyectos.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '41', '0', '2002-04-19 09:08:17', 'PG', 'Proyectos.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '42', '0', '2002-04-19 09:08:29', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '43', '0', '2002-04-19 09:08:33', 'PG', 'Proyectos.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '44', '0', '2002-04-19 09:08:41', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '45', '0', '2002-04-19 09:08:44', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '46', '0', '2002-04-19 09:08:47', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '47', '0', '2002-04-19 09:08:49', 'PG', 'Proyectos.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '48', '0', '2002-04-19 09:08:52', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '49', '0', '2002-04-19 09:08:55', 'PG', 'Proyectos.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '50', '0', '2002-04-19 09:09:01', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '51', '0', '2002-04-19 09:09:03', 'PG', 'Proyectos.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '52', '0', '2002-04-19 09:10:20', 'PG', 'Tema.php', 'Id=10', '10', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '53', '0', '2002-04-19 09:10:30', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '54', '0', '2002-04-19 09:11:13', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '55', '0', '2002-04-19 09:11:17', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '56', '0', '2002-04-19 09:11:21', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '57', '0', '2002-04-19 09:11:27', 'PG', 'Proyectos.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '58', '0', '2002-04-19 09:11:34', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '59', '0', '2002-04-19 09:11:37', 'PG', 'Proyectos.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '60', '0', '2002-04-19 09:11:43', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '61', '0', '2002-04-19 09:11:45', 'PG', 'Proyectos.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '62', '0', '2002-04-19 09:11:50', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '63', '0', '2002-04-19 09:11:52', 'PG', 'Proyectos.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '64', '0', '2002-04-19 09:11:59', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '65', '0', '2002-04-19 09:12:01', 'PG', 'Proyectos.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '66', '0', '2002-04-19 09:12:06', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '67', '0', '2002-04-19 09:12:08', 'PG', 'Proyectos.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '68', '0', '2002-04-19 09:12:11', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '69', '0', '2002-04-19 09:12:14', 'PG', 'Proyectos.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '70', '0', '2002-04-19 09:12:21', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '71', '0', '2002-04-19 09:12:24', 'PG', 'Proyectos.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '72', '0', '2002-04-19 09:12:28', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '73', '0', '2002-04-19 09:12:30', 'PG', 'Proyectos.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '74', '0', '2002-04-19 09:12:37', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '75', '0', '2002-04-19 09:12:39', 'PG', 'Proyectos.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '76', '0', '2002-04-19 09:12:42', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '77', '0', '2002-04-19 09:12:45', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '78', '0', '2002-04-19 09:12:48', 'PG', 'Proyectos.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '79', '0', '2002-04-19 09:12:50', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '80', '0', '2002-04-19 09:12:53', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '81', '0', '2002-04-19 09:12:56', 'PG', 'Proyectos.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '82', '0', '2002-04-19 09:13:02', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '83', '0', '2002-04-19 09:13:04', 'PG', 'Proyectos.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '84', '0', '2002-04-19 09:13:10', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '85', '0', '2002-04-19 09:13:15', 'PG', 'Contacto.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '86', '0', '2002-04-19 09:14:39', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '87', '0', '2002-04-19 09:14:42', 'PG', 'Proyectos.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '88', '0', '2002-04-19 09:14:46', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '89', '0', '2002-04-19 09:14:50', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '90', '0', '2002-04-19 09:14:56', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '91', '0', '2002-04-19 09:15:10', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '92', '0', '2002-04-19 09:15:12', 'PG', 'Proyectos.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '93', '0', '2002-04-19 09:15:15', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '94', '0', '2002-04-19 09:15:20', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '95', '0', '2002-04-19 09:15:24', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '96', '0', '2002-04-23 21:27:42', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '97', '0', '2002-04-23 21:27:49', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '98', '0', '2002-04-23 21:28:37', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '99', '0', '2002-04-23 21:28:47', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '100', '0', '2002-04-23 21:28:54', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '101', '0', '2002-04-23 21:30:07', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '102', '0', '2002-04-23 21:35:40', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '103', '0', '2002-04-23 21:35:45', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '104', '0', '2002-04-23 21:35:51', 'PG', 'Proyectos.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '105', '0', '2002-04-23 21:35:53', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '106', '0', '2002-04-23 21:35:56', 'PG', 'Tema.php', 'Id=3', '3', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '107', '0', '2002-04-23 21:35:58', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '108', '0', '2002-04-23 21:36:00', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '109', '0', '2002-04-23 21:36:04', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '110', '0', '2002-04-23 21:36:12', 'PG', 'Proyectos.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '111', '0', '2002-04-23 21:36:14', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '112', '0', '2002-04-23 21:36:16', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '113', '0', '2002-04-23 21:37:20', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '114', '1', '2002-04-23 21:37:31', 'IN', 'ajlopez', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '115', '1', '2002-04-23 21:42:46', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '116', '1', '2002-04-23 21:42:49', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '117', '1', '2002-04-23 21:48:11', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '118', '1', '2002-04-23 21:48:14', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '119', '1', '2002-04-23 21:49:42', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '120', '1', '2002-04-23 21:54:46', 'AR', '', '', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '121', '1', '2002-04-23 21:55:36', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '122', '1', '2002-04-23 21:55:44', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '123', '1', '2002-04-23 21:56:03', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '124', '1', '2002-04-23 21:59:31', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '125', '1', '2002-04-23 22:04:30', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '126', '1', '2002-04-23 22:04:34', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '127', '1', '2002-04-23 22:04:36', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '128', '1', '2002-04-23 22:04:47', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '129', '1', '2002-04-23 22:07:04', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '130', '1', '2002-04-23 22:11:33', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '131', '1', '2002-04-23 22:12:00', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '132', '1', '2002-04-23 22:12:05', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '133', '1', '2002-04-23 22:12:50', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '134', '1', '2002-04-23 22:14:15', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '135', '1', '2002-04-23 22:14:41', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '136', '1', '2002-04-23 22:14:58', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '137', '1', '2002-04-23 22:15:38', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '138', '1', '2002-04-23 22:16:06', 'IT', '', '', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '139', '1', '2002-04-23 22:16:40', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '140', '1', '2002-04-23 22:16:45', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '141', '1', '2002-04-23 22:16:51', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '142', '1', '2002-04-23 22:17:02', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '143', '1', '2002-04-23 22:17:09', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '144', '1', '2002-04-23 22:17:12', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '145', '1', '2002-04-23 22:18:54', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '146', '1', '2002-04-23 22:19:08', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '147', '1', '2002-04-23 22:19:34', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '148', '1', '2002-04-23 22:21:56', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '149', '1', '2002-04-23 22:22:02', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '150', '1', '2002-04-23 22:22:10', 'PG', 'Tema.php', 'Id=2', '2', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '151', '1', '2002-04-23 22:22:13', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '152', '1', '2002-04-23 22:22:15', 'PG', 'Tema.php', 'Id=2', '2', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '153', '1', '2002-04-23 22:23:31', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '154', '1', '2002-04-23 22:24:05', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '155', '1', '2002-04-23 22:24:09', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '156', '1', '2002-04-23 22:24:12', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '157', '1', '2002-04-23 22:24:15', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '158', '1', '2002-04-23 22:24:19', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '159', '1', '2002-04-23 22:24:22', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '160', '1', '2002-04-23 22:24:26', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '161', '1', '2002-04-23 22:24:56', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '162', '1', '2002-04-23 22:24:59', 'PG', 'Tema.php', 'Id=3', '3', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '163', '1', '2002-04-23 22:26:21', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '164', '1', '2002-04-23 22:26:25', 'PG', 'Tema.php', 'Id=3', '3', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '165', '1', '2002-04-23 22:26:32', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '166', '1', '2002-04-23 22:26:35', 'PG', 'Tema.php', 'Id=2', '2', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '167', '1', '2002-04-23 22:26:46', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '168', '1', '2002-04-23 22:27:11', 'PG', 'Contacto.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '169', '1', '2002-04-23 22:27:19', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '170', '1', '2002-04-23 22:27:22', 'PG', 'Tema.php', 'Id=3', '3', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '171', '1', '2002-04-23 22:31:09', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '172', '1', '2002-04-23 22:34:01', 'AR', '', '', '2', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '173', '1', '2002-04-23 22:39:15', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '174', '1', '2002-04-23 22:39:18', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '175', '1', '2002-04-23 22:39:24', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '176', '1', '2002-04-23 22:41:28', 'AR', '', '', '3', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '177', '1', '2002-04-23 22:43:01', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '178', '1', '2002-04-23 22:43:07', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '179', '1', '2002-04-23 22:43:11', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '180', '1', '2002-04-23 22:43:33', 'PG', 'Tema.php', 'Id=10', '10', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '181', '1', '2002-04-23 22:43:45', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '182', '1', '2002-04-23 22:43:50', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '183', '1', '2002-04-23 22:44:50', 'PG', 'Proyectos.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '184', '1', '2002-04-23 22:44:53', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '185', '1', '2002-04-23 22:44:56', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '186', '1', '2002-04-23 22:44:59', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '187', '1', '2002-04-23 22:51:00', 'AR', '', '', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '188', '1', '2002-04-23 22:53:04', 'PG', 'Tema.php', 'Id=10', '10', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '189', '1', '2002-04-23 22:53:10', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '190', '1', '2002-04-23 22:53:13', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '191', '1', '2002-04-23 22:53:16', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '192', '1', '2002-04-23 22:55:19', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '193', '1', '2002-04-23 22:55:22', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '194', '1', '2002-04-23 22:55:26', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '195', '1', '2002-04-23 22:55:29', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '196', '1', '2002-04-23 22:55:33', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '197', '1', '2002-04-23 22:55:36', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '198', '1', '2002-04-23 22:55:39', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '199', '1', '2002-04-23 22:55:43', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '200', '1', '2002-04-23 22:55:46', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '201', '1', '2002-04-23 22:55:58', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '202', '1', '2002-04-23 22:56:24', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '203', '1', '2002-04-23 22:56:26', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '204', '1', '2002-04-23 22:56:42', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '205', '1', '2002-04-23 22:56:45', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '206', '1', '2002-04-23 22:57:10', 'PG', 'Tema.php', 'Id=10', '10', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '207', '1', '2002-04-23 22:57:13', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '208', '1', '2002-04-23 22:57:16', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '209', '1', '2002-04-23 22:57:26', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '210', '1', '2002-04-23 22:58:04', 'PG', 'Tema.php', 'Id=10', '10', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '211', '1', '2002-04-23 22:58:08', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '212', '1', '2002-04-23 22:58:12', 'PG', 'Tema.php', 'Id=2', '2', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '213', '1', '2002-04-23 22:58:41', 'PG', 'Tema.php', 'Id=2', '2', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '214', '1', '2002-04-23 22:58:57', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '215', '1', '2002-04-23 22:59:01', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '216', '1', '2002-04-23 23:00:31', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '217', '1', '2002-04-23 23:00:34', 'PG', 'default.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '218', '1', '2002-04-23 23:00:37', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '219', '1', '2002-04-23 23:00:41', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '220', '1', '2002-04-23 23:00:45', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '221', '1', '2002-04-23 23:00:48', 'PG', 'Tema.php', 'Id=4', '4', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '222', '1', '2002-04-23 23:00:57', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '223', '1', '2002-04-23 23:01:08', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '224', '1', '2002-04-23 23:01:17', 'PG', 'Tema.php', 'Id=2', '2', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '225', '1', '2002-04-23 23:02:31', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '226', '1', '2002-04-23 23:02:34', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '227', '1', '2002-04-23 23:02:37', 'PG', 'Tema.php', 'Id=2', '2', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '228', '1', '2002-04-23 23:02:53', 'PG', 'Tema.php', 'Id=9', '9', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '229', '1', '2002-04-23 23:03:13', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '230', '1', '2002-04-23 23:03:16', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '231', '1', '2002-04-23 23:05:25', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '232', '1', '2002-04-23 23:05:43', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '233', '1', '2002-04-23 23:05:51', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '234', '1', '2002-04-23 23:06:02', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '235', '1', '2002-04-23 23:06:11', 'PG', 'Temas.php', '', '0', '127.0.0.1');
INSERT INTO eventos (Id, IdUsuario, FechaHora, Tipo, Parametro, Subparametro, IdParametro, Ip) VALUES ( '236', '1', '2002-04-23 23:06:14', 'PG', 'Tema.php', 'Id=1', '1', '127.0.0.1');

# --------------------------------------------------------
#
# Table structure for table 'items'
#

DROP TABLE IF EXISTS items;
CREATE TABLE items (
   Id int(11) NOT NULL auto_increment,
   Descripcion varchar(100) NOT NULL,
   IdClase int(11) DEFAULT '0' NOT NULL,
   Detalle text NOT NULL,
   IdUsuario int(11) DEFAULT '0' NOT NULL,
   Url varchar(100) NOT NULL,
   Orden tinyint(4) DEFAULT '0' NOT NULL,
   Visitas int(11) DEFAULT '0' NOT NULL,
   Votos1 int(11) DEFAULT '0' NOT NULL,
   Votos2 int(11) DEFAULT '0' NOT NULL,
   Votos3 int(11) DEFAULT '0' NOT NULL,
   Votos4 int(11) DEFAULT '0' NOT NULL,
   Votos5 int(11) DEFAULT '0' NOT NULL,
   Imagen varchar(100) NOT NULL,
   Estado tinyint(4) DEFAULT '0' NOT NULL,
   PRIMARY KEY (Id),
   KEY IdUsuario (IdUsuario)
);

#
# Dumping data for table 'items'
#

INSERT INTO items (Id, Descripcion, IdClase, Detalle, IdUsuario, Url, Orden, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5, Imagen, Estado) VALUES ( '1', 'Java en Sun', '0', 'El sitio de Sun sobre Java. Todo sobre el lenguaje y la tecnología. Software para bajarse, tutoriales, noticias y código fuente. Nuevas tendencias. Librerías, información para el desarrollador Java. Imperdible.', '1', 'http://java.sun.com', '0', '1', '0', '0', '0', '0', '0', '', '0');

# --------------------------------------------------------
#
# Table structure for table 'itemsclases'
#

DROP TABLE IF EXISTS itemsclases;
CREATE TABLE itemsclases (
   Id int(11) NOT NULL auto_increment,
   Descripcion varchar(50) NOT NULL,
   PRIMARY KEY (Id)
);

#
# Dumping data for table 'itemsclases'
#

INSERT INTO itemsclases (Id, Descripcion) VALUES ( '1', 'Enlaces');

# --------------------------------------------------------
#
# Table structure for table 'itemssugeridos'
#

DROP TABLE IF EXISTS itemssugeridos;
CREATE TABLE itemssugeridos (
   Id int(11) NOT NULL auto_increment,
   IdUsuario int(11) DEFAULT '0' NOT NULL,
   IdCategoria int(11) DEFAULT '0' NOT NULL,
   FechaHora datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   Descripcion varchar(100) NOT NULL,
   Url varchar(200) NOT NULL,
   Detalle text NOT NULL,
   Estado tinyint(4) DEFAULT '0' NOT NULL,
   PRIMARY KEY (Id),
   KEY IdUsuario (IdUsuario, IdCategoria)
);

#
# Dumping data for table 'itemssugeridos'
#


# --------------------------------------------------------
#
# Table structure for table 'lecciones'
#

DROP TABLE IF EXISTS lecciones;
CREATE TABLE lecciones (
   Id int(11) NOT NULL auto_increment,
   Descripcion varchar(255) NOT NULL,
   IdCurso int(11) DEFAULT '0' NOT NULL,
   Orden int(11) DEFAULT '0' NOT NULL,
   Nivel int(11) DEFAULT '0' NOT NULL,
   IdAnterior int(11) DEFAULT '0' NOT NULL,
   IdSiguiente int(11) DEFAULT '0' NOT NULL,
   IdPadre int(11) DEFAULT '0' NOT NULL,
   Archivo varchar(255) NOT NULL,
   Visitas int(11) DEFAULT '0' NOT NULL,
   Votos1 int(11) DEFAULT '0' NOT NULL,
   Votos2 int(11) DEFAULT '0' NOT NULL,
   Votos3 int(11) DEFAULT '0' NOT NULL,
   Votos4 int(11) DEFAULT '0' NOT NULL,
   Votos5 int(11) DEFAULT '0' NOT NULL,
   Estado tinyint(4) DEFAULT '0' NOT NULL,
   PRIMARY KEY (Id),
   KEY IdCurso (IdCurso)
);

#
# Dumping data for table 'lecciones'
#


# --------------------------------------------------------
#
# Table structure for table 'noticias'
#

DROP TABLE IF EXISTS noticias;
CREATE TABLE noticias (
   Id int(10) unsigned NOT NULL auto_increment,
   Titulo varchar(100) NOT NULL,
   Resumen text NOT NULL,
   IdUsuario int(11) DEFAULT '0' NOT NULL,
   Copete text NOT NULL,
   Texto text NOT NULL,
   Imagen varchar(100) NOT NULL,
   TextoImagen text NOT NULL,
   Orden tinyint(4) DEFAULT '0' NOT NULL,
   Visitas int(11) DEFAULT '0' NOT NULL,
   IdEstado tinyint(4) DEFAULT '0' NOT NULL,
   VigenciaDesde date,
   VigenciaHasta date,
   PRIMARY KEY (Id),
   KEY IdUsuario (IdUsuario)
);

#
# Dumping data for table 'noticias'
#


# --------------------------------------------------------
#
# Table structure for table 'pagos'
#

DROP TABLE IF EXISTS pagos;
CREATE TABLE pagos (
   Id int(11) NOT NULL auto_increment,
   IdUsuario int(11) DEFAULT '0' NOT NULL,
   IdCurso int(11) DEFAULT '0' NOT NULL,
   Fecha date DEFAULT '0000-00-00' NOT NULL,
   Importe decimal(10,2) DEFAULT '0.00' NOT NULL,
   Divisa varchar(30) NOT NULL,
   Apellido varchar(50) NOT NULL,
   Nombre varchar(50) NOT NULL,
   Comprobante varchar(30) NOT NULL,
   Tipo char(2) NOT NULL,
   Observaciones text NOT NULL,
   Estado tinyint(4) DEFAULT '0' NOT NULL,
   FechaHora datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   PRIMARY KEY (Id),
   KEY IdUsuario (IdUsuario, IdCurso)
);

#
# Dumping data for table 'pagos'
#


# --------------------------------------------------------
#
# Table structure for table 'paises'
#

DROP TABLE IF EXISTS paises;
CREATE TABLE paises (
   Id int(11) NOT NULL auto_increment,
   Descripcion varchar(40) NOT NULL,
   PRIMARY KEY (Id),
   KEY Descripcion (Descripcion)
);

#
# Dumping data for table 'paises'
#

INSERT INTO paises (Id, Descripcion) VALUES ( '1', 'Argentina');
INSERT INTO paises (Id, Descripcion) VALUES ( '2', 'España');
INSERT INTO paises (Id, Descripcion) VALUES ( '3', 'México');
INSERT INTO paises (Id, Descripcion) VALUES ( '4', 'Estados Unidos');
INSERT INTO paises (Id, Descripcion) VALUES ( '5', 'Venezuela');
INSERT INTO paises (Id, Descripcion) VALUES ( '6', 'Uruguay');
INSERT INTO paises (Id, Descripcion) VALUES ( '7', 'Chile');
INSERT INTO paises (Id, Descripcion) VALUES ( '8', 'Bolivia');
INSERT INTO paises (Id, Descripcion) VALUES ( '9', 'Paraguay');
INSERT INTO paises (Id, Descripcion) VALUES ( '10', 'Brasil');
INSERT INTO paises (Id, Descripcion) VALUES ( '11', 'Perú');
INSERT INTO paises (Id, Descripcion) VALUES ( '12', 'Colombia');
INSERT INTO paises (Id, Descripcion) VALUES ( '13', 'Ecuador');
INSERT INTO paises (Id, Descripcion) VALUES ( '14', 'Cuba');
INSERT INTO paises (Id, Descripcion) VALUES ( '15', 'Nicaragua');
INSERT INTO paises (Id, Descripcion) VALUES ( '16', 'San Salvador');
INSERT INTO paises (Id, Descripcion) VALUES ( '17', 'Costa Rica');
INSERT INTO paises (Id, Descripcion) VALUES ( '18', 'Canadá');
INSERT INTO paises (Id, Descripcion) VALUES ( '19', 'Portugal');
INSERT INTO paises (Id, Descripcion) VALUES ( '20', 'Reino Unido');
INSERT INTO paises (Id, Descripcion) VALUES ( '21', 'Francia');
INSERT INTO paises (Id, Descripcion) VALUES ( '22', 'Italia');
INSERT INTO paises (Id, Descripcion) VALUES ( '23', 'Alemania');
INSERT INTO paises (Id, Descripcion) VALUES ( '24', 'Holanda');
INSERT INTO paises (Id, Descripcion) VALUES ( '25', 'República Dominicana');
INSERT INTO paises (Id, Descripcion) VALUES ( '26', 'Panamá');

# --------------------------------------------------------
#
# Table structure for table 'preferencias'
#

DROP TABLE IF EXISTS preferencias;
CREATE TABLE preferencias (
   Id int(11) NOT NULL auto_increment,
   IdUsuario int(11) DEFAULT '0' NOT NULL,
   Novedades tinyint(4) DEFAULT '0' NOT NULL,
   Html tinyint(4) DEFAULT '0' NOT NULL,
   Internet tinyint(4) DEFAULT '0' NOT NULL,
   Deportes tinyint(4) DEFAULT '0' NOT NULL,
   Educacion tinyint(4) DEFAULT '0' NOT NULL,
   Ciencia tinyint(4) DEFAULT '0' NOT NULL,
   Tecnologia tinyint(4) DEFAULT '0' NOT NULL,
   Computacion tinyint(4) DEFAULT '0' NOT NULL,
   Negocios tinyint(4) DEFAULT '0' NOT NULL,
   Empleo tinyint(4) DEFAULT '0' NOT NULL,
   Finanzas tinyint(4) DEFAULT '0' NOT NULL,
   Viajes tinyint(4) DEFAULT '0' NOT NULL,
   Compras tinyint(4) DEFAULT '0' NOT NULL,
   Juegos tinyint(4) DEFAULT '0' NOT NULL,
   Entretenimiento tinyint(4) DEFAULT '0' NOT NULL,
   Salud tinyint(4) DEFAULT '0' NOT NULL,
   Familia tinyint(4) DEFAULT '0' NOT NULL,
   FechaHoraCreacion datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   FechaHoraModificacion datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   PRIMARY KEY (Id),
   UNIQUE IdUsuario (IdUsuario),
   KEY IdUsuario_2 (IdUsuario)
);

#
# Dumping data for table 'preferencias'
#


# --------------------------------------------------------
#
# Table structure for table 'puntos'
#

DROP TABLE IF EXISTS puntos;
CREATE TABLE puntos (
   Id int(11) NOT NULL auto_increment,
   IdUsuario int(11) DEFAULT '0' NOT NULL,
   FechaHora datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   Puntos int(11) DEFAULT '0' NOT NULL,
   Cantidad int(11) DEFAULT '0' NOT NULL,
   Tipo tinyint(4) DEFAULT '0' NOT NULL,
   IdParametro int(11) DEFAULT '0' NOT NULL,
   PRIMARY KEY (Id),
   KEY IdUsuario (IdUsuario)
);

#
# Dumping data for table 'puntos'
#

INSERT INTO puntos (Id, IdUsuario, FechaHora, Puntos, Cantidad, Tipo, IdParametro) VALUES ( '1', '1', '2002-04-23 21:37:31', '50', '1', '4', '0');
INSERT INTO puntos (Id, IdUsuario, FechaHora, Puntos, Cantidad, Tipo, IdParametro) VALUES ( '2', '1', '2002-04-23 21:54:45', '5', '1', '6', '0');
INSERT INTO puntos (Id, IdUsuario, FechaHora, Puntos, Cantidad, Tipo, IdParametro) VALUES ( '3', '1', '2002-04-23 22:16:06', '5', '1', '6', '0');
INSERT INTO puntos (Id, IdUsuario, FechaHora, Puntos, Cantidad, Tipo, IdParametro) VALUES ( '4', '1', '2002-04-23 22:34:01', '5', '1', '6', '0');
INSERT INTO puntos (Id, IdUsuario, FechaHora, Puntos, Cantidad, Tipo, IdParametro) VALUES ( '5', '1', '2002-04-23 22:41:28', '5', '1', '6', '0');
INSERT INTO puntos (Id, IdUsuario, FechaHora, Puntos, Cantidad, Tipo, IdParametro) VALUES ( '6', '1', '2002-04-23 22:51:00', '5', '1', '6', '0');

# --------------------------------------------------------
#
# Table structure for table 'recomendados'
#

DROP TABLE IF EXISTS recomendados;
CREATE TABLE recomendados (
   Id int(11) NOT NULL auto_increment,
   IdUsuario int(11) DEFAULT '0' NOT NULL,
   De varchar(60) NOT NULL,
   Para varchar(60) NOT NULL,
   FechaHora datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   IP varchar(20) NOT NULL,
   Enviado tinyint(4) DEFAULT '0' NOT NULL,
   PRIMARY KEY (Id),
   KEY IdUsuario (IdUsuario, De, Para)
);

#
# Dumping data for table 'recomendados'
#


# --------------------------------------------------------
#
# Table structure for table 'sesion'
#

DROP TABLE IF EXISTS sesion;
CREATE TABLE sesion (
   id int(10) unsigned NOT NULL auto_increment,
   codigo varchar(20) NOT NULL,
   texto text NOT NULL,
   tiempo int(11) DEFAULT '0' NOT NULL,
   PRIMARY KEY (id),
   UNIQUE codigo_2 (codigo),
   KEY codigo (codigo)
);

#
# Dumping data for table 'sesion'
#

INSERT INTO sesion (id, codigo, texto, tiempo) VALUES ( '3', 'nkbcqfrfuewjamet', 'a:0:{}', '1019608206');
INSERT INTO sesion (id, codigo, texto, tiempo) VALUES ( '4', 'rleywdbkufmadulg', 'a:16:{s:9:\"UsuarioId\";s:1:\"1\";s:13:\"UsuarioCodigo\";s:7:\"ajlopez\";s:13:\"UsuarioNombre\";s:5:\"Angel\";s:15:\"UsuarioApellido\";s:5:\"Lopez\";s:22:\"UsuarioEsAdministrador\";s:1:\"1\";s:11:\"UsuarioSexo\";N;s:13:\"UsuarioIdPais\";s:1:\"0\";s:12:\"UsuarioEmail\";s:21:\"webmaster@ajlopez.com\";s:17:\"UsuarioVerificado\";s:1:\"0\";s:13:\"UsuarioPuntos\";i:75;s:13:\"UsuarioEnlace\";s:25:\"/ajlopez2002/Usuarios.php\";s:18:\"ArticulosVisitados\";a:4:{i:1;i:1;i:2;i:1;i:3;i:1;i:4;i:1;}s:10:\"ItemEnlace\";s:26:\"/ajlopez2002/Tema.php?Id=1\";s:14:\"ItemsVisitados\";a:1:{i:1;i:1;}s:14:\"ArticuloEnlace\";s:32:\"/ajlopez2002/Categoria.php?Id=12\";s:15:\"CategoriaEnlace\";s:26:\"/ajlopez2002/Tema.php?Id=1\";}', '1019613977');

# --------------------------------------------------------
#
# Table structure for table 'tablas'
#

DROP TABLE IF EXISTS tablas;
CREATE TABLE tablas (
   Id int(11) NOT NULL auto_increment,
   Codigo varchar(30) NOT NULL,
   Descripcion varchar(50) NOT NULL,
   Singular varchar(50) NOT NULL,
   Plural varchar(50) NOT NULL,
   IdGenero tinyint(4) DEFAULT '0' NOT NULL,
   PRIMARY KEY (Id),
   UNIQUE Codigo (Codigo)
);

#
# Dumping data for table 'tablas'
#


# --------------------------------------------------------
#
# Table structure for table 'usuarios'
#

DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios (
   Id int(11) NOT NULL auto_increment,
   Codigo varchar(16) NOT NULL,
   Contrasenia varchar(16) NOT NULL,
   IdReferente int(11) DEFAULT '0' NOT NULL,
   Nombre varchar(40) NOT NULL,
   Apellido varchar(40) NOT NULL,
   Email varchar(50) NOT NULL,
   NosConoce char(2) NOT NULL,
   Comentarios text NOT NULL,
   IdSexo tinyint(4) DEFAULT '0' NOT NULL,
   IdPais int(11) DEFAULT '0' NOT NULL,
   Provincia varchar(30) NOT NULL,
   Ciudad varchar(40) NOT NULL,
   CodigoPostal varchar(10) NOT NULL,
   FechaNacimiento date DEFAULT '0000-00-00' NOT NULL,
   EsAdministrador tinyint(4) DEFAULT '0' NOT NULL,
   EsTutor tinyint(4) DEFAULT '0' NOT NULL,
   EsCliente tinyint(4) DEFAULT '0' NOT NULL,
   EsAfiliado tinyint(4) DEFAULT '0' NOT NULL,
   FechaHoraAlta datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   FechaHoraModificacion datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   FechaHoraUltimoIngreso datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   Ingresos int(11) DEFAULT '0' NOT NULL,
   Puntos int(11) DEFAULT '0' NOT NULL,
   PuntosAnteriores int(11) DEFAULT '0' NOT NULL,
   PuntosPendientes int(11) DEFAULT '0' NOT NULL,
   Verificado tinyint(4) DEFAULT '0' NOT NULL,
   PRIMARY KEY (Id),
   UNIQUE Codigo (Codigo),
   KEY Email (Email),
   KEY IdReferente (IdReferente)
);

#
# Dumping data for table 'usuarios'
#

INSERT INTO usuarios (Id, Codigo, Contrasenia, IdReferente, Nombre, Apellido, Email, NosConoce, Comentarios, IdSexo, IdPais, Provincia, Ciudad, CodigoPostal, FechaNacimiento, EsAdministrador, EsTutor, EsCliente, EsAfiliado, FechaHoraAlta, FechaHoraModificacion, FechaHoraUltimoIngreso, Ingresos, Puntos, PuntosAnteriores, PuntosPendientes, Verificado) VALUES ( '1', 'ajlopez', 'ajcarolina2002', '0', 'Angel', 'Lopez', 'webmaster@ajlopez.com', '', '', '0', '0', '', '', '', '0000-00-00', '1', '0', '0', '0', '2002-04-19 08:09:26', '2002-04-19 08:09:26', '2002-04-23 21:37:31', '2', '75', '0', '0', '0');

# --------------------------------------------------------
#
# Table structure for table 'usuarioscursos'
#

DROP TABLE IF EXISTS usuarioscursos;
CREATE TABLE usuarioscursos (
   Id int(11) NOT NULL auto_increment,
   IdUsuario int(11) DEFAULT '0' NOT NULL,
   IdCurso int(11) DEFAULT '0' NOT NULL,
   FechaHoraInscripcion datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   Precio decimal(10,2) DEFAULT '0.00' NOT NULL,
   PrecioOriginal decimal(10,2) DEFAULT '0.00' NOT NULL,
   Puntos int(11) DEFAULT '0' NOT NULL,
   FechaHoraPago datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   Estado tinyint(4) DEFAULT '0' NOT NULL,
   Visitas int(11) DEFAULT '0' NOT NULL,
   Importe decimal(10,2) DEFAULT '0.00' NOT NULL,
   Habilitado tinyint(4) DEFAULT '0' NOT NULL,
   PRIMARY KEY (Id),
   KEY IdUsuario (IdUsuario, IdCurso)
);

#
# Dumping data for table 'usuarioscursos'
#

