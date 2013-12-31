<?php
    include_once('Settings.inc.php');
    
	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Paginas.inc.php');
	include_once('Sesion.inc.php');
	include_once('Utiles.inc.php');

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

	include('Inicio.inc.php');
?>

<center>

<p>

<p>
<a href="CursosCategorias.php">Categor&iacute;as</a>
&nbsp;
&nbsp;
<a href="CursoCategoriaActualiza.php?Id=<?php echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="CursoCategoriaElimina.php?Id=<?php echo $Id; ?>">Elimina</a>
</p>
<p>

<table class="Formulario" width="80%">
<?php
	CampoEstaticoGenera("Id",$Id);
	CampoEstaticoGenera("Descripci&oacute;n",$Descripcion);
	CampoEstaticoGenera("Detalle",NormalizaHtml($Detalle));
?>
</table>


</center>

<?php
	Desconectar();
	include('Final.inc.php');
?>

