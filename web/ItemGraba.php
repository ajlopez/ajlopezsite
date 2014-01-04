<?php
    include_once('Settings.inc.php');
    
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Sesion.inc.php');
	include_once('Validaciones.inc.php');
	include_once('Usuarios.inc.php');

	if (!$Descripcion)
		$mensaje .= "Debe ingresar Descripci&oacute;n<br>";

	if (!$Url)
		$mensaje .= "Debe ingresar Enlace<br>";

	if ($mensaje)
		ErrorMuestra($mensaje);	

	Conectar();

	$IdClase += 0;
	$IdIdioma += 0;
	$IdSitio += 0;
	$Prioridad += 0;
	$EsNuevo += 0;

	if (!$Prioridad)
		$Prioridad = 5;

	if (isset($Id))
		$sql = "Update items Set ";
	else
		$sql = "Insert items Set IdUsuario = " . (UsuarioId()+0) . ", ";

	if (!EsAdministrador() && !$Id)
		$sql .= "IdEstado = 1,";

	$sql = $sql .  "
		Descripcion = '$Descripcion', 
		Detalle = '$Detalle',
		Url = '$Url',
		IdClase = $IdClase,
		IdIdioma = $IdIdioma,
		IdSitio = $IdSitio,
		Prioridad = $Prioridad,
		EsNuevo = $EsNuevo";

	if (isset($Id))
		$sql = $sql . " where Id = $Id";

	mysql_query($sql);
	$IdNuevo = mysql_insert_id();

	if (!$Id && $IdCategoria) {
		$sql = "Insert categoriasitems Set IdCategoria = $IdCategoria, IdItem = $IdNuevo";
		mysql_query($sql);
	}

	$ItemEnlace = SesionToma("ItemEnlace");
	SesionSaca("ItemEnlace");

	if (!$ItemEnlace)
		$ItemEnlace = "Items.php";

	header("Location: $ItemEnlace");
	exit;
?>