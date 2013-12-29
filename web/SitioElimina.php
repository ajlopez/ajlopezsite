<?
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Sesion.inc.php');
	include('Validaciones.inc.php');
	include('Usuarios.inc.php');

	Conectar();

	AdministradorControla();

	$Id += 0;

	$sql = "Delete from sitios where id = $Id";
	mysql_query($sql);

	$sql = "Update articulos set IdSitio = 0 where IdSitio = $Id";
	mysql_query($sql);

	$sql = "Update items set IdSitio = 0 where IdSitio = $Id";
	mysql_query($sql);

	PaginaRedireccionar("Sitios.php");
?>