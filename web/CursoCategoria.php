<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');
	include('Utiles.inc.php');

	Conectar();
	
	SesionPone('CursoCategoriaEnlace',PaginaActual());

	if (!isset($Id))
		PaginaSale();

	$sql = "select Descripcion, Detalle
		 from cursoscategorias where Id = $Id";		 
	$res = mysql_query($sql);
	list($Descripcion, $Detalle)
		= mysql_fetch_row($res);
	mysql_free_result($res);
	$PaginaTitulo = "Categor&iacute;a de Curso: $Descripcion";

	require('Inicio.inc.php');
?>

<center>

<p>

<p>
<a href="CursosCategorias.php">Categor&iacute;as</a>
&nbsp;
&nbsp;
<a href="CursoCategoriaActualiza.php?Id=<? echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="CursoCategoriaElimina.php?Id=<? echo $Id; ?>">Elimina</a>
</p>
<p>

<table class="Formulario" width="80%">
<?
	CampoEstaticoGenera("Id",$Id);
	CampoEstaticoGenera("Descripci&oacute;n",$Descripcion);
	CampoEstaticoGenera("Detalle",NormalizaHtml($Detalle));
?>
</table>


</center>

<?
	Desconectar();
	require('Final.inc.php');
?>

