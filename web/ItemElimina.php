<?
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Sesion.inc.php');
	include('Validaciones.inc.php');
	include('Usuarios.inc.php');

	Conectar();

	AdministradorControla();

	$Id += 0;

	$sql = "Delete from items where id = $Id";

	mysql_query($sql);

	$sql = "Delete from categoriasitems where IdItem = $Id";
	mysql_query($sql);

	mysql_query($sql);

	PaginaRedireccionar("Items.php");
?>