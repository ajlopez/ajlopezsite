<?php
    include_once('Settings.inc.php');
    
	include_once('Conexion.inc.php');
	include_once('Sesion.inc.php');
	include_once('Usuarios.inc.php');
	include_once('Categorias.inc.php');
	include_once('Paginas.inc.php');

	Conectar();

	AdministradorControla();

	$Id += 0;
	$Estado += 0;
	$Expande += 0;

	CategoriaPoneEstado($Id,$Estado,$Expande);

	Desconectar();

	PaginaRedireccionar("Categoria.php?Id=$Id");
?>