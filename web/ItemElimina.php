<?php
    include_once('Settings.inc.php');
    
	include_once('GetParameters.inc.php');
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Sesion.inc.php');
	include_once('Validaciones.inc.php');
	include_once('Usuarios.inc.php');

	Conectar();

	AdministradorControla();

	$Id += 0;

	$sql = "Delete from items where id = '$Id'";

	mysql_query($sql);

	$sql = "Delete from categoriasitems where IdItem = '$Id'";
	mysql_query($sql);

	mysql_query($sql);

	PaginaRedireccionar("Items.php");
?>