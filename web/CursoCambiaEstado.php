<?php
    include_once('Settings.inc.php');
    
	include_once('Conexion.inc.php');
	include_once('Sesion.inc.php');
	include_once('Usuarios.inc.php');
	include_once('Cursos.inc.php');
	include_once('Paginas.inc.php');

	Conectar();

	AdministradorControla();

	$Id += 0;
	$Estado += 0;

	CursoPoneEstado($Id,$Estado);

	Desconectar();

	PaginaRedireccionar("Curso.php?Id=$Id");
?>