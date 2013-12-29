<?
	include('Conexion.inc.php');
	include('Sesion.inc.php');
	include('Usuarios.inc.php');
	include('Cursos.inc.php');
	include('Paginas.inc.php');

	Conectar();

	AdministradorControla();

	$Id += 0;
	$Estado += 0;

	CursoPoneEstado($Id,$Estado);

	Desconectar();

	PaginaRedireccionar("Curso.php?Id=$Id");
?>