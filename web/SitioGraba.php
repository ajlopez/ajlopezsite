<?
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Sesion.inc.php');
	include('Validaciones.inc.php');
	include('Usuarios.inc.php');

	if (!$Descripcion)
		$mensaje .= "Debe ingresar Descripci&oacute;n<br>";

	if (!$Enlace)
		$mensaje .= "Debe ingresar Enlace<br>";

	if ($mensaje)
		ErrorMuestra($mensaje);	

	Conectar();

	if (isset($Id))
		$sql = "Update sitios Set ";
	else
		$sql = "Insert sitios Set ";

	$sql = $sql .  "
		Descripcion = '$Descripcion', 
		Enlace = '$Enlace',
		Dominio = '$Dominio'";

	if (isset($Id))
		$sql = $sql . " where Id = $Id";

	mysql_query($sql);
	$IdNuevo = mysql_insert_id();

	$SitioEnlace = SesionToma("SitioEnlace");
	SesionSaca("SitioEnlace");

	if (!$SitioEnlace)
		$SitioEnlace = "Items.php";

	header("Location: $SitioEnlace");
	exit;
?>