<?php
    include_once('Settings.inc.php');
    
	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Paginas.inc.php');
	include_once('Sesion.inc.php');
	include_once('Utiles.inc.php');
	include_once('Usuarios.inc.php');

	Conectar();
	
	AdministradorControla('');

	SesionPone('PaginaEnlace',PaginaActual());

	if (!isset($Id))
		PaginaSalir();

	$sql = "select Titulo, Alias, Resumen, Contenido, EsHTML, Visitas, FechaHoraAlta, FechaHoraModificacion from paginas where Id = $Id";
	$rs = mysql_query($sql);
	list($Titulo, $Alias, $Resumen, $Contenido, $EsHTML, $Visitas, $FechaHoraAlta, $FechaHoraModificacion) = mysql_fetch_row($rs);
	mysql_free_result($rs);

	$Detalle = $Resumen;
	$IdItem = 0;
	$IdArticulo = 0;
	$IdCategoria = 0;
	$IdPagina = $Id;
	$Prioridad = 1;

	$sql = "Insert referencias Set FechaHoraAlta = Now(), FechaHoraModificacion = Now(), ";

	$sql = $sql .  "
		Titulo = '$Titulo', 
		Detalle = '$Detalle',
		IdItem = $IdItem,
		IdArticulo = $IdArticulo,
		IdCategoria = $IdCategoria,
		IdPagina = $IdPagina,
		CodigoPagina = '$CodigoPagina',
		Enlace = '$Enlace',
		Prioridad = $Prioridad";

	mysql_query($sql);

	if (mysql_errno()) {
		echo $sql;
		echo mysql_error();
	}

	header("Location: Pagina.php?Id=$Id");
	exit;
?>