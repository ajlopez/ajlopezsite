<?
    include_once('Settings.inc.php');
    
	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Paginas.inc.php');

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

	include('Inicio.inc.php');
?>

<center>

<p>
<a href="TablasDatos.php?IdTabla=<?php echo $IdTabla; ?>"><?php echo $Plural; ?></a>

<?php
	if (!$EsNuevo) {
?>
&nbsp;
&nbsp;
<a href="TablaDato.php?IdTabla=<?php echo $IdTabla; ?>&Id=<?php echo $Id; ?>"><?php echo $Singular; ?></a>
&nbsp;
&nbsp;
<a href="TablaDatoElimina.php?IdTabla=<?php echo $IdTabla; ?>&Id=<?php echo $Id; ?>">Elimina</a>
<?php
	}
?>
</p>

<p>

<form action="TablaDatoGraba.php" method=post>

<table class="Formulario" width="80%">
<?php
	if (!$EsNuevo)
		CampoEstaticoGenera("Id",$Id);

	CampoTextoGenera("Descripcion","Descripción",$Descripcion,40);

	CampoAceptarGenera();
?>
</table>
<input type="hidden" name="IdTabla" value="<?php echo $IdTabla; ?>">
<?php
	if (!$EsNuevo)
		IdGenera($Id);
?>
</form>

</center>

<?php
	Desconectar();
	include('Final.inc.php');
?>

