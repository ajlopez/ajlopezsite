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

	mysql_query("update categoriasitems set Estado = $Estado where Id = $Id");

	if ($Estado==0) {
		$rs = mysql_query("select IdItem from categoriasitems where Id = $Id");
		list($IdItem) = mysql_fetch_row($rs);
		mysql_free_result($rs);
		mysql_query("update items set Estado=0 where Id = $IdItem and Estado<>0");
	}

	Desconectar();

	if ($IdCategoria)
		PaginaRedireccionar("Categoria.php?Id=$IdCategoria");
	if ($IdItem)
		PaginaRedireccionar("Item.php?Id=$IdItem");
	PaginaSalir();
?>