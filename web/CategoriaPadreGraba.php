<?
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Sesion.inc.php');
	include('Validaciones.inc.php');
	include('Usuarios.inc.php');

	Conectar();

	UsuarioControla();

	$IdCategoria += 0;
	$IdHijo += 0;

	$sql = "Update categorias Set IdPadre = $IdCategoria where Id = $IdHijo";

	mysql_query($sql);

	$CategoriaEnlace = SesionToma("CategoriaEnlace");
	SesionSaca("CategoriaEnlace");

	PaginaRedireccionar($CategoriaEnlace,"Categorias.php");
?>