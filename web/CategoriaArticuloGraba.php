<?
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Sesion.inc.php');
	include('Validaciones.inc.php');
	include('Usuarios.inc.php');

	Conectar();

	UsuarioControla();

	$IdCategoriaArticulo += 0;
	$IdCategoria += 0;
	$IdArticulo += 0;

	if (!$IdCategoria)
		$mensaje .= "Debe especificar Categor&iacute;a<br>";
	if (!$IdArticulo)
		$mensaje .= "Debe especificar Enlace<br>";
	if ($mensaje)
		ErrorMuestra($mensaje);	

	if ($IdCategoriaArticulo)
		$sql = "Update categoriasarticulos Set ";
	else
		$sql = "Insert categoriasarticulos Set ";

	$sql = $sql .  "
		IdArticulo = $IdArticulo, 
		IdCategoria = $IdCategoria";

	if ($IdCategoriaArticulo)
		$sql = $sql . " where Id = $IdCategoriaArticulo";

	mysql_query($sql);
	$IdNuevo = mysql_insert_id();

	$ArticuloEnlace = SesionToma("ArticuloEnlace");
	SesionSaca("ArticuloEnlace");

	PaginaRedireccionar($ArticuloEnlace,"Articulos.php");
?>