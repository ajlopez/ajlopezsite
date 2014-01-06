<?php
    include_once('Settings.inc.php');
    
	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Usuarios.inc.php');
	include_once('Paginas.inc.php');

	Conectar();
	
	if (isset($Id)) {
		$sql = "select Titulo, Alias, Resumen, Contenido, EsHTML, Visitas, FechaHoraAlta, FechaHoraModificacion from paginas where Id = $Id";
		$rs = mysql_query($sql);
		list($Titulo, $Alias, $Resumen, $Contenido, $EsHTML, $Visitas, $FechaHoraAlta, $FechaHoraModificacion) = mysql_fetch_row($rs);
		mysql_free_result($rs);
		$PaginaTitulo = "Actualiza P&aacute;gina";
		$EsNuevo = 0;
	}	
	else {
		$PaginaTitulo = "Nueva P&aacute;gina";
		$EsNuevo = 1;
	}

//	if (strpos($Contenido,"\\\'") or strpos($Contenido,'\"'))
	$Resumen=stripSlashes($Resumen);
	$Contenido=stripSlashes($Contenido);

	require('Inicio.inc.php');
?>

<center>

<p>
<?php
	if (!$EsNuevo) {
?>
&nbsp;
&nbsp;
<a href="Pagina.php?Id=<?php echo $Id; ?>">P&aacute;gina</a>
&nbsp;
&nbsp;
<a href="PaginaElimina.php?Id=<?php echo $Id; ?>">Elimina</a>
<?php
	}
?>
</p>

<p>

<form action="PaginaGraba.php" method=post>

<table cellspacing=1 cellpadding=2 class="Formulario" width='90%'>
<?php
	if (!$EsNuevo)
		CampoEstaticoGenera("Id",$Id);

	CampoTextoGenera("Titulo","T&iacute;tulo",$Titulo,40);
	CampoTextoGenera("Alias","Alias",$Alias,16);
	CampoMemoGenera("Resumen","Resumen",$Resumen,10,60);
	CampoMemoGenera("Contenido","Contenido", $Contenido,30,60);
	CampoCheckGenera("EsHTML","Es HTML", $EsHTML);

	CampoAceptarGenera();
?>
</table>

<?php
	if (!$EsNuevo)
		IdGenera($Id);
?>

</form>

</center>

<?php
	Desconectar();
	require('Final.inc.php');
?>

