<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');

	if (!isset($IdTabla))
		PaginaSalir();
	if (!isset($Id))
		PaginaSalir();

	Conectar();
	
	SesionPone('TablaEnlace',PaginaActual());

	$sql = "select Codigo, Descripcion, Singular, Plural, IdGenero from tablas where Id = $IdTabla";
	$rs = mysql_query($sql);
	list($Codigo, $TablaDescripcion, $Singular, $Plural, $IdGenero) = mysql_fetch_row($rs);
	mysql_free_result($rs);

	$sql = "select * from $Codigo where Id = $Id";
	$rs = mysql_query($sql);
	list($Id, $Descripcion) = mysql_fetch_row($rs);
	mysql_free_result($rs);

	$PaginaTitulo = $Singular;

	require('Inicio.inc.php');
?>

<center>

<p>
<a href="TablasDatos.php?IdTabla=<? echo $IdTabla; ?>"><? echo $Plural; ?></a>
&nbsp;
&nbsp;
<a href="TablaDatoActualiza.php?IdTabla=<? echo $IdTabla; ?>&Id=<? echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="TablaDatoElimina.php?IdTabla=<? echo $IdTabla; ?>&Id=<? echo $Id; ?>">Elimina</a>
</p>
<p>

<table class="Formulario" width="80%">
<?
	CampoEstaticoGenera("Id",$Id);
	CampoEstaticoGenera("Descripción",$Descripcion);
?>
</table>

</center>

<?
	Desconectar();
	require('Final.inc.php');
?>

