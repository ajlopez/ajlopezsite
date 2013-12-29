<?
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Sesion.inc.php');
	include('Validaciones.inc.php');
	include('Usuarios.inc.php');

	Conectar();

	AdministradorControla();

	$Id += 0;
	$Estado += 0;

	$sql = "Update referencias set Estado = $Estado where Id = $Id";
	mysql_query($sql);

	PaginaRedireccionar("Referencia.php?Id=$Id");
?>