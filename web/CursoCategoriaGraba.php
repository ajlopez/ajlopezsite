<?
    include_once('Settings.inc.php');
    
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Sesion.inc.php');
	include_once('Validaciones.inc.php');

	if (!$Descripcion)
		$mensaje .= "Debe ingresar Descripci&oacute;n<br>";

	if ($mensaje)
		ErrorMuestra($mensaje);	

	Conectar();

	if (isset($Id))
		$sql = "Update cursoscategorias Set ";
	else
		$sql = "Insert cursoscategorias Set ";

	$IdPadre += 0;

	$sql = $sql .  "
		Descripcion = '$Descripcion', 
		Detalle = '$Detalle'";

	if (isset($Id))
		$sql = $sql . " where Id = $Id";

	mysql_query($sql);
	$id = mysql_insert_id();

	$CursoCategoriaEnlace = SesionToma("CursoCategoriaEnlace");
	SesionSaca("CursoCategoriaEnlace");

	if (!$CursoCategoriaEnlace)
		$CursoCategoriaEnlace = "CursosCategorias.php";

	header("Location: $CursoCategoriaEnlace");
	exit;
?>