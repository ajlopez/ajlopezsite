<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');
	include('Utiles.inc.php');
	include('Categorias.inc.php');

	Conectar();
	
	SesionPone('SitioEnlace',PaginaActual());

	if (!isset($Id))
		PaginaSalir();

	$sql = "select Descripcion, Enlace, Dominio from sitios where Id = $Id";		 
	$res = mysql_query($sql);
	list($Descripcion, $Enlace, $Dominio)
		= mysql_fetch_row($res);
	mysql_free_result($res);
	$PaginaTitulo = "Sitio: $Descripcion";

	require('Inicio.inc.php');
?>

<center>

<p>
<a href="Sitios.php">Sitios</a>
&nbsp;
&nbsp;
<a href="SitioActualiza.php?Id=<? echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="SitioElimina.php?Id=<? echo $Id; ?>">Elimina</a>
</p>
<p>

<table cellspacing=1 cellpadding=2 class="Formulario">
<?
	CampoEstaticoGenera("Id",$Id);
	CampoEstaticoGenera("Descripci&oacute;n",$Descripcion);
	CampoEnlaceGenera("Enlace",$Enlace,$Enlace);
	CampoEstaticoGenera("Dominio",$Dominio);
?>
</table>

<?
function MuestraArticulo($reg) {
	global $Id;

	FilaInicio();

	if ($reg["Estado"])
		$Titulo = '('.$reg['Titulo'].')';
	else
		$Titulo = $reg['Titulo'];

	DatoEnlaceGenera($Titulo,"Articulo.php?Id=" . $reg['Id']);

	FilaFinal();
}

	$rs=mysql_query("select * from articulos where IdSitio=$Id order by Id");
	if (mysql_num_rows($rs)) {
?>

<p>
<h2>Art&iacute;culos</h2>

<?			
		$titulos = array("T&iacute;tulo");

		TablaInicio($titulos,"90%");

		while ($reg=mysql_fetch_array($rs)) 
			MuestraArticulo($reg);
				
		TablaFinal();
	}
?>

<?
function MuestraItem($reg) {
	global $Id;

	FilaInicio();

	if ($reg["Estado"])
		$Descripcion = '('.$reg['Descripcion'].')';
	else
		$Descripcion = $reg['Descripcion'];

	DatoEnlaceGenera($Descripcion,"Item.php?Id=" . $reg['Id']);

	FilaFinal();
}

	$rs=mysql_query("select * from items where IdSitio=$Id order by Id");
	if (mysql_num_rows($rs)) {
?>

<p>
<h2>Items</h2>

<?			
		$titulos = array("Descripci&oacute;n");

		TablaInicio($titulos,"90%");

		while ($reg=mysql_fetch_array($rs)) 
			MuestraItem($reg);
				
		TablaFinal();
	}
?>
</center>

<?
	Desconectar();
	require('Final.inc.php');
?>

