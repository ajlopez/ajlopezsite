<?
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Sesion.inc.php');
	include('Validaciones.inc.php');
	include('Usuarios.inc.php');

	Conectar();

	UsuarioControla();

	$IdCategoriaItem += 0;
	$IdCategoria += 0;
	$IdItem += 0;

	if (!$IdCategoria)
		$mensaje .= "Debe especificar Categor&iacute;a<br>";
	if (!$IdItem)
		$mensaje .= "Debe especificar Enlace<br>";
	if ($mensaje)
		ErrorMuestra($mensaje);	

	if ($IdCategoriaItem)
		$sql = "Update categoriasitems Set ";
	else
		$sql = "Insert categoriasitems Set ";

	$sql = $sql .  "
		IdItem = $IdItem, 
		IdCategoria = $IdCategoria";

	if ($IdCategoriaItem)
		$sql = $sql . " where Id = $IdCategoriaItem";

	mysql_query($sql);
	$IdNuevo = mysql_insert_id();

	$ItemEnlace = SesionToma("ItemEnlace");
	SesionSaca("ItemEnlace");

	if (!$ItemEnlace)
		$ItemEnlace = "Items.php";

	header("Location: $ItemEnlace");
	exit;
?>