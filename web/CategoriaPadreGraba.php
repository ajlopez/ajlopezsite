<?php
    include_once('Settings.inc.php');
    
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Sesion.inc.php');
	include_once('Validaciones.inc.php');
	include_once('Usuarios.inc.php');

	Conectar();

	UsuarioControla();

	$IdCategoria += 0;
	$IdHijo += 0;

	$sql = "Update categorias Set IdPadre = $IdCategoria where Id = $IdHijo";

	mysql_query($sql);

	$CategoriaEnlace = SesionToma("CategoriaEnlace");
	SesionSaca("CategoriaEnlace");

	PaginaRedireccionar($CategoriaEnlace,"Categorias.php");
?>