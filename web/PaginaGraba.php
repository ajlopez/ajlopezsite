<?php
    include_once('Settings.inc.php');
    
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Sesion.inc.php');
	include_once('Validaciones.inc.php');
	include_once('Usuarios.inc.php');

	if (!$Titulo)
		$mensaje .= "Debe ingresar T&iacute;tulo<br>";

	if (!$Resumen && !$Contenido)
		$mensaje .= "Debe ingresar Resumen o Contenido<br>";

	if ($mensaje)
		ErrorMuestra($mensaje);	

	$EsHTML += 0;

	Conectar();

	if (isset($Id))
		$sql = "Update paginas Set FechaHoraModificacion = now(), ";
	else
		$sql = "Insert paginas Set FechaHoraAlta = now(), FechaHoraModificacion = now(), ";

	$sql = $sql .  "Titulo = '$Titulo', 
		Resumen = '$Resumen',
		Contenido = '$Contenido',
		Alias = '$Alias',
		EsHTML = $EsHTML
		";

	if (isset($Id))
		$sql = $sql . " where Id = $Id";

	mysql_query($sql);

	if (mysql_errno())
		echo mysql_error();

	$PaginaEnlace = SesionToma("PaginaEnlace");
	SesionSaca("PaginaEnlace");

	if (!isset($Id)) {
		$IdNuevo = mysql_insert_id();
		$PaginaEnlace = "Pagina.php?Id=$IdNuevo";
	}

	PaginaRedireccionar($PaginaEnlace, "Paginas.php");
?>