<?php
    include_once('Settings.inc.php');

	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Usuarios.inc.php');
	include_once('Paginas.inc.php');

	Conectar();
	
	AdministradorControla('');

	if (isset($Id)) {
		$sql = "select Titulo, IdClase, IdIdioma, IdSitio, Resumen, Copete, Contenido, EsHTML, Archivo, Imagen, Enlace, VigenciaDesde, VigenciaHasta, Comentarios, Prioridad, EsNuevo from articulos where Id = $Id";
		$rs = mysql_query($sql);
		list($Titulo, $IdClase, $IdIdioma, $IdSitio, $Resumen, $Copete, $Contenido, $EsHTML, $Archivo, $Imagen, $Enlace, $VigenciaDesde, $VigenciaHasta, $Comentarios, $Prioridad, $EsNuevo) = mysql_fetch_row($rs);
		mysql_free_result($rs);
		$PaginaTitulo = "Actualiza Art&iacute;culo";
	}	
	else {
		$PaginaTitulo = "Nuevo Art&iacute;culo";
	}

	$rsClases = mysql_query("select id, descripcion from articulosclases order by id");
	$rsIdiomas = mysql_query("select id, descripcion from idiomas order by id");
	$rsSitios = mysql_query("select id, descripcion from sitios order by descripcion");

	$Contenido=stripSlashes($Contenido);
	$Resumen=stripSlashes($Resumen);

	include('Inicio.inc.php');
?>

<center>

<p>
<?php
	if ($Id) {
?>
&nbsp;
&nbsp;
<a href="Articulo.php?Id=<?php echo $Id; ?>">Art&iacute;culo</a>
&nbsp;
&nbsp;
<a href="ArticuloElimina.php?Id=<?php echo $Id; ?>">Elimina</a>
<?php
	}
?>
</p>

<p>

<form action="ArticuloGraba.php" method=post>

<table cellspacing=1 cellpadding=2 class="Formulario" width="90%">
<?php
	if ($Id)
		CampoEstaticoGenera("Id",$Id);
	CampoTextoGenera("Titulo","T&iacute;tulo",$Titulo,40);
	CampoComboRsGenera("IdClase","Clase", $rsClases, $IdClase);
	CampoComboRsGenera("IdIdioma","Idioma", $rsIdiomas, $IdIdioma);
	CampoComboRsGenera("IdSitio","Sitio", $rsSitios, $IdSitio, 'id', 'descripcion', true);
	CampoTextoGenera("Prioridad","Prioridad",$Prioridad,3);
	CampoCheckGenera("EsNuevo","Es Nuevo", $EsNuevo);
	CampoMemoGenera("Resumen","Resumen",$Resumen);
	CampoMemoGenera("Copete","Copete",$Copete);
	CampoMemoGenera("Contenido","Contenido", $Contenido, 30, 60);
	CampoCheckGenera("EsHTML","Es HTML", $EsHTML);
	CampoTextoGenera("Archivo","Archivo", $Archivo, 60);
	CampoTextoGenera("Imagen","Imagen", $Imagen, 40);
	CampoMemoGenera("TextoImagen","Texto de Imagen", $TextoImagen);
	CampoTextoGenera("Enlace","Enlace", $Enlace, 60);
	CampoFechaGenera("VigenciaDesde","Vigente Desde",$VigenciaDesde);
	CampoFechaGenera("VigenciaHasta","Vigente Hasta",$VigenciaHasta);

	CampoAceptarGenera();
?>
</table>

<input type="hidden" name="IdCategoria" value="<?php echo $IdCategoria; ?>">

<?php
	if ($Id)
		IdGenera($Id);
?>

</form>

</center>

<?php
	mysql_free_result($rsClases);
	Desconectar();
	include('Final.inc.php');
?>

