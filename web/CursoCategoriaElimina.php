<?
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Paginas.inc.php');
	include('Usuarios.inc.php');

	AdministradorControla();

	if (!isset($Id))
		PaginaSale();

	Conectar();

	mysql_query("delete from cursoscategorias where Id = $Id");

	Desconectar();

	PaginaRedireccionar("CursosCategorias.php");
?>