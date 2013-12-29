<?
	include('Conexion.inc.php');
	include('Sesion.inc.php');
	include('Usuarios.inc.php');
	include('Categorias.inc.php');
	include('Paginas.inc.php');

	Conectar();

	AdministradorControla();

	$Id += 0;
	$Estado += 0;
	$Expande += 0;

	CategoriaPoneEstado($Id,$Estado,$Expande);

	Desconectar();

	PaginaRedireccionar("Categoria.php?Id=$Id");
?>