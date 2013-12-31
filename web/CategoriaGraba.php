<?php
    include_once('Settings.inc.php');
    
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Sesion.inc.php');
	include_once('Validaciones.inc.php');
	include_once('Categorias.inc.php');

	if (!$Descripcion)
		$mensaje .= "Debe ingresar Descripci&oacute;n<br>";

	if ($mensaje)
		ErrorMuestra($mensaje);	

	Conectar();

	if (isset($Id))
		$sql = "Update categorias Set ";
	else
		$sql = "Insert categorias Set ";

	$IdPadre += 0;

	if ($IdPadre) {
		$rsPadre = mysql_query("select Estado from categorias where Id = $IdPadre");
		list($Estado) = mysql_fetch_row($rsPadre);
		mysql_free_result($rsPadre);
	}
	else
		$Estado = CATEGORIAS_ESTADO_NORMAL;

	$sql = $sql .  "
		Descripcion = '$Descripcion', 
		Detalle = '$Detalle',
		Resumen = '$Resumen',
		Description = '$Description', 
		Detail = '$Detail',
		Abstract = '$Abstract',
		IdPadre = $IdPadre,
		Alias = '$Alias',
		Estado = $Estado";

	if (isset($Id))
		$sql = $sql . " where Id = $Id";

	mysql_query($sql);
	$id = mysql_insert_id();

	$CategoriaEnlace = SesionToma("CategoriaEnlace");
	SesionSaca("CategoriaEnlace");

	if (!$CategoriaEnlace)
		$CategoriaEnlace = "Categorias.php";

	header("Location: $CategoriaEnlace");
	exit;
?>