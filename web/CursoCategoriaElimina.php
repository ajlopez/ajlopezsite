<?php
    include_once('Settings.inc.php');

	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Paginas.inc.php');
	include_once('Usuarios.inc.php');

	AdministradorControla();

	if (!isset($Id))
		PaginaSale();

	Conectar();

	mysql_query("delete from cursoscategorias where Id = $Id");

	Desconectar();

	PaginaRedireccionar("CursosCategorias.php");
?>