<?
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Sesion.inc.php');
	include('Validaciones.inc.php');
	include('Usuarios.inc.php');
	include('Categorias.inc.php');

	Conectar();

	AdministradorControla();

	$Id += 0;

	CategoriaPoneEstado($Id,CATEGORIAS_ESTADO_DESHABILITADA,1);

	$sql = "Delete from categorias where id = $Id";

	mysql_query($sql);

	$sql = "Delete from categoriasarticulos where IdCategoria = $Id";
	mysql_query($sql);

	$sql = "Delete from categoriasitems where IdCategoria = $Id";
	mysql_query($sql);

	$sql = "Delete from categoriasnoticias where IdCategoria = $Id";
	mysql_query($sql);

	$sql = "Update categorias set IdPadre = 0 where IdPadre = $Id";

	mysql_query($sql);

	PaginaRedireccionar("Categorias.php");
?>