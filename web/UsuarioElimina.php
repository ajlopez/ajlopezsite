<?
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Sesion.inc.php');
	include('Validaciones.inc.php');
	include('Usuarios.inc.php');

	Conectar();

	AdministradorControla();

	$Id += 0;

	$sql = "Delete from usuarios where id = $Id";

	mysql_query($sql);

	Desconectar();

	PaginaRedireccionar("Usuarios.php");
?>