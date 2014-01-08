<?php
    include_once('Settings.inc.php');
    
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Sesion.inc.php');
	include_once('Validaciones.inc.php');
	include_once('Usuarios.inc.php');

	Conectar();

	AdministradorControla();

	$Id += 0;
	$Estado += 0;

	$sql = "Update referencias set Estado = $Estado where Id = $Id";
	mysql_query($sql);

	PaginaRedireccionar("Referencia.php?Id=$Id");
?>