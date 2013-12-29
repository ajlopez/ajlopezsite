<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Paginas.inc.php');

	Conectar();

	if (!isset($IdTabla))
		PaginaSalir();
	
	$sql = "select Codigo, Descripcion, Singular, Plural, IdGenero from tablas where Id = $IdTabla";
	$rs = mysql_query($sql);
	list($Codigo, $TablaDescripcion, $Singular, $Plural, $IdGenero) = mysql_fetch_row($rs);
	mysql_free_result($rs);

	if (isset($Id)) {
		$sql = "select * from $Codigo where Id = $Id"; 
		$rs = mysql_query($sql);
		$reg = mysql_fetch_object($rs);
		$Codigo = $reg->Codigo;
		$Descripcion = $reg->Descripcion;
		mysql_free_result($rs);
		$PaginaTitulo = "Actualiza $Singular";
		$EsNuevo = 0;
	}	
	else {
		 $PaginaTitulo = "Nuevo $Singular";
		 $EsNuevo = 1;
	}

	require('Inicio.inc.php');
?>

<center>

<p>
<a href="TablasDatos.php?IdTabla=<? echo $IdTabla; ?>"><? echo $Plural; ?></a>

<?
	if (!$EsNuevo) {
?>
&nbsp;
&nbsp;
<a href="TablaDato.php?IdTabla=<? echo $IdTabla; ?>&Id=<? echo $Id; ?>"><? echo $Singular; ?></a>
&nbsp;
&nbsp;
<a href="TablaDatoElimina.php?IdTabla=<? echo $IdTabla; ?>&Id=<? echo $Id; ?>">Elimina</a>
<?
	}
?>
</p>

<p>

<form action="TablaDatoGraba.php" method=post>

<table class="Formulario" width="80%">
<?
	if (!$EsNuevo)
		CampoEstaticoGenera("Id",$Id);

	CampoTextoGenera("Descripcion","Descripción",$Descripcion,40);

	CampoAceptarGenera();
?>
</table>
<input type="hidden" name="IdTabla" value="<? echo $IdTabla; ?>">
<?
	if (!$EsNuevo)
		IdGenera($Id);
?>
</form>

</center>

<?
	Desconectar();
	require('Final.inc.php');
?>

