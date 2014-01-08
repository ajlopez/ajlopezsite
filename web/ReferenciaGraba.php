<?php
    include_once('Settings.inc.php');
    
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Sesion.inc.php');
	include('Validaciones.inc.php');
	include('Usuarios.inc.php');

	AdministradorControla('Referencias.php');

	if (!$Titulo)
		$mensaje .= "Debe ingresar T&iacute;tulo<br>";

	if (!$Detalle)
		$mensaje .= "Debe ingresar Detalle<br>";

	if ($mensaje)
		ErrorMuestra($mensaje);	

	Conectar();

	$IdItem += 0;
	$IdArticulo += 0;
	$IdCategoria += 0;
	$IdPagina += 0;
	$Prioridad += 0;

	if (!$Prioridad)
		$Prioridad = 100;

	if (isset($Id))
		$sql = "Update referencias Set FechaHoraModificacion = Now(), ";
	else
		$sql = "Insert referencias Set FechaHoraAlta = Now(), FechaHoraModificacion = Now(), ";

	if (!EsAdministrador() && !$Id)
		$sql .= "IdEstado = 1,";

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

	if (isset($Id))
		$sql = $sql . " where Id = $Id";

	mysql_query($sql);

	if (mysql_errno()) {
		echo $sql;
		echo mysql_error();
	}

	$IdNuevo = mysql_insert_id();

	$ReferenciaEnlace = SesionToma("ReferenciaEnlace");
	SesionSaca("ReferenciaEnlace");

	if (!$ReferenciaEnlace)
		$ReferenciaEnlace = "Referencias.php";

	header("Location: $ReferenciaEnlace");
	exit;
?>