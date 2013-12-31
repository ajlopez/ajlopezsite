<?php
    include_once('Settings.inc.php');
    
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Sesion.inc.php');
	include_once('Validaciones.inc.php');
	include_once('Usuarios.inc.php');
	include_once('Categorias.inc.php');

	Conectar();

	AdministradorControla();

	$Id += 0;

	CategoriaPoneEstado($Id,CATEGORIAS_ESTADO_DESHABILITADA,1);

	$sql = "Delete from categorias where id = $Id";

	mysql_query($sql);

	$sql = "Delete from categoriasarticulos where IdCategoria = $Id";
	mysql_query($sql);

	$sql = "Delete from categoriasitems where IdCategoria = $Id";
	mysql_query($sql);

	$sql = "Delete from categoriasnoticias where IdCategoria = $Id";
	mysql_query($sql);

	$sql = "Update categorias set IdPadre = 0 where IdPadre = $Id";

	mysql_query($sql);

	PaginaRedireccionar("Categorias.php");
?>