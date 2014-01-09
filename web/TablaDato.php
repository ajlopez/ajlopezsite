<?
    include_once('Settings.inc.php');
    
	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Paginas.inc.php');
	include_once('Sesion.inc.php');

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

	include('Inicio.inc.php');
?>

<center>

<p>
<a href="TablasDatos.php?IdTabla=<?php echo $IdTabla; ?>"><?php echo $Plural; ?></a>
&nbsp;
&nbsp;
<a href="TablaDatoActualiza.php?IdTabla=<?php echo $IdTabla; ?>&Id=<?php echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="TablaDatoElimina.php?IdTabla=<?php echo $IdTabla; ?>&Id=<?php echo $Id; ?>">Elimina</a>
</p>
<p>

<table class="Formulario" width="80%">
<?php
	CampoEstaticoGenera("Id",$Id);
	CampoEstaticoGenera("Descripción",$Descripcion);
?>
</table>

</center>

<?php
	Desconectar();
	include('Final.inc.php');
?>

