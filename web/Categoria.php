<?php
    include_once('Settings.inc.php');
    
	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Paginas.inc.php');
	include_once('Sesion.inc.php');
	include_once('Utiles.inc.php');
	include_once('Categorias.inc.php');
	include_once('Usuarios.inc.php');
	include_once('Traduccion.inc.php');

	AdministradorControla();

	Conectar();
	
	SesionPone('CategoriaEnlace',PaginaActual());
	SesionPone('ArticuloEnlace',PaginaActual());
	SesionPone('ItemEnlace',PaginaActual());

	if (!isset($Id))
		PaginaSale();

	$sql = "select Descripcion, Detalle, Resumen, IdPadre, IdReferencia, Estado, Alias, Visitas, Description, Detail, Abstract
		 from categorias where Id = $Id";		 
	$res = mysql_query($sql);
	list($Descripcion, $Detalle, $Resumen, $IdPadre, $IdReferencia, $Estado, $Alias, $Visitas,$Description,$Detail,$Abstract)
		= mysql_fetch_row($res);
	mysql_free_result($res);

//	if (strpos($Detalle,"\\\'") or strpos($Detalle,'\"'))
		$Detalle=stripSlashes($Detalle);

	$PaginaTitulo = "Categor&iacute;a: $Descripcion";

 	$rsPadre = mysql_query("Select Descripcion from categorias where Id = $IdPadre");
	if ($rsPadre && mysql_num_rows($rsPadre))
		list($PadreDescripcion) = mysql_fetch_row($rsPadre);
	if ($rsPadre)
		mysql_free_result($rsPadre);

	CategoriaTraduce($IdReferencia, $DescripcionReferencia, $IdPadreReferencia);

	include('Inicio.inc.php');
?>

<center>

<p>
<a href="Categorias.php">Categor&iacute;as</a>
<?php
	$Enlaces = CategoriasEnlaces($IdPadre);

	if ($Enlaces) 
		echo "&nbsp;->&nbsp;$Enlaces";
?>
<p>

<p>
<a href="Tema.php?Id=<?php echo $Id; ?>">Muestra</a>
&nbsp;
&nbsp;
<a href="en/Topic.php?Id=<?php echo $Id; ?>">Show</a>
&nbsp;
&nbsp;
<a href="CategoriaActualiza.php?Id=<?php echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="CategoriaElimina.php?Id=<?php echo $Id; ?>">Elimina</a>
<br>
<a href="CategoriaActualiza.php?IdPadre=<?php echo $Id; ?>">Nueva Subcategor&iacute;a</a>
&nbsp;
&nbsp;
<a href="ItemActualiza.php?IdCategoria=<?php echo $Id; ?>">Nuevo Item</a>
&nbsp;
&nbsp;
<a href="ArticuloActualiza.php?IdCategoria=<?php echo $Id; ?>">Nuevo Art&iacute;culo</a>
&nbsp;
&nbsp;
<a href="ArchivosDirectorio.php?dir=busquedas&IdCategoria=<?php echo $Id; ?>">Importa Items</a>
<br>
<a href="CategoriaSeleccionaPadre.php?IdHijo=<?php echo $Id; ?>&IdCategoria=<?php echo $IdPadre; ?>">Selecciona Padre</a>
&nbsp;
&nbsp;
<a href="CategoriaSeleccionaRef.php?IdReferente=<?php echo $Id; ?>&IdCategoria=<?php echo $IdPadre; ?>">Selecciona Referencia</a>
<br>
<?php
	if ($Estado == CATEGORIAS_ESTADO_NORMAL) {
?>
<a href="CategoriaCambiaEstado.php?Id=<?php echo $Id; ?>&Estado=<?php echo CATEGORIAS_ESTADO_DESHABILITADA ?>&Expande=1">Deshabilita Categor&iacute;a y Subcategor&iacute;as</a>
<?php
	}
	else {
?>
<a href="CategoriaCambiaEstado.php?Id=<?php echo $Id; ?>&Estado=<?php echo CATEGORIAS_ESTADO_NORMAL ?>&Expande=1">Habilita Categor&iacute;a y Subcategor&iacute;as</a>
&nbsp;
&nbsp;
<a href="CategoriaCambiaEstado.php?Id=<?php echo $Id; ?>&Estado=<?php echo CATEGORIAS_ESTADO_NORMAL ?>&Expande=0">Habilita Categor&iacute;a</a>
<?php
	}
?>
&nbsp;
&nbsp;
<a href="Eventos.php?Parametro=Tema.php&IdParametro=<?php echo $Id; ?>">Visitas</a>
</p>
<p>

<table cellspacing=1 cellpadding=2 class="Formulario" width=500>
<?php
	CampoEstaticoGenera("Id",$Id);
	if ($Estado)
		CampoEstaticoGenera("Descripci&oacute;n","($Descripcion)");
	else
		CampoEstaticoGenera("Descripci&oacute;n",$Descripcion);
	CampoEstaticoGenera("Detalle",NormalizaHtml($Detalle));
	CampoEstaticoGenera("Resumen",NormalizaHtml($Resumen));

	if ($Estado)
		CampoEstaticoGenera("Description","($Description)");
	else
		CampoEstaticoGenera("Description",$Description);
	CampoEstaticoGenera("Detail",NormalizaHtml($Detail));
	CampoEstaticoGenera("Abstract",NormalizaHtml($Abstract));

	if ($IdReferencia)
		CampoEstaticoGenera("Referencia", "<a href='Categoria.php?Id=$IdReferencia'>$DescripcionReferencia</a>");

	CampoEstaticoGenera("Alias",$Alias);
	CampoEstaticoGenera("Visitas",$Visitas);
	CampoEstaticoGenera("Estado",CategoriaEstadoTraduce($Estado));
?>
</table>

<?php
function MuestraRegistro($reg) {
	FilaInicio();
	if ($reg["Estado"])
		DatoEnlaceGenera("(".$reg["Descripcion"].")", "Categoria.php?Id=".$reg["Id"]);
	else
		DatoEnlaceGenera($reg["Descripcion"], "Categoria.php?Id=".$reg["Id"]);
	DatoNumGenera($reg['Visitas']);
	FilaFinal();
}

	$rs=mysql_query("select * from categorias where IdPadre=$Id order by descripcion");
	if (mysql_num_rows($rs)) {

?>

<p>
<h2>Subcategor&iacute;as</h2>

<?php
		$titulos = array('Descripci&oacute;n', 'Visitas');

		TablaInicio($titulos,"90%");

		while ($reg=mysql_fetch_array($rs)) 
			MuestraRegistro($reg);
				
		TablaFinal();
	}

	mysql_free_result($rs);
?>

<?php
function MuestraItem($reg) {
	global $Id;

	FilaInicio();
	$accion = "<a href='CategoriaItemElimina.php?Id=$reg[IdCI]'>Elimina</a>";
	if ($reg["Estado"]) {
		DatoEnlaceGenera("(".$reg["Descripcion"].")", "Item.php?Id=".$reg["Id"]);
		$accion .= "&nbsp;&nbsp;<a href='CategoriaItemCambiaEstado.php?Id=$reg[IdCI]&Estado=0&IdCategoria=$Id'>Habilita</a>";
	}
	else {
		DatoEnlaceGenera($reg["Descripcion"], "Item.php?Id=".$reg["Id"]);
		$accion .= "&nbsp;&nbsp;<a href='CategoriaItemCambiaEstado.php?Id=$reg[IdCI]&Estado=1&IdCategoria=$Id'>Deshabilita</a>";
	}

	DatoGenera(TraduceIdioma($reg['IdIdioma']));
	DatoNumGenera($reg['Visitas']);
	DatoNumGenera($reg['Prioridad']);
	DatoGenera($accion);
	FilaFinal();
}

	$rs=mysql_query("select i.Id, i.Descripcion, ci.Estado, ci.Id as IdCI, i.Visitas, i.Prioridad, i.IdIdioma from categoriasitems ci, items i where ci.IdItem = i.Id and ci.IdCategoria=$Id order by i.descripcion");
	if (mysql_num_rows($rs)) {
?>

<p>
<h2>Items</h2>

<?php		
		$titulos = array('Descripci&oacute;n', 'Idioma', 'Visitas', 'Prio', 'Acci&oacute;n');

		TablaInicio($titulos,"90%");

		while ($reg=mysql_fetch_array($rs)) 
			MuestraItem($reg);
				
		TablaFinal();
	}

	mysql_free_result($rs);
?>

<?php
function MuestraArticulo($reg) {
	global $Id;

	FilaInicio();
	if ($reg["Estado"])
		DatoEnlaceGenera("(".$reg["Titulo"].")", "Articulo.php?Id=".$reg["Id"]);
	else
		DatoEnlaceGenera($reg["Titulo"], "Articulo.php?Id=".$reg["Id"]);

	$accion = "<a href='CategoriaArticuloElimina.php?Id=$reg[IdCA]'>Elimina</a>";

	if ($reg["Estado"])
		$accion .= "&nbsp;&nbsp;<a href='CategoriaArticuloCambiaEstado.php?Id=$reg[IdCA]&Estado=0&IdCategoria=$Id'>Habilita</a>";
	else
		$accion .= "&nbsp;&nbsp;<a href='CategoriaArticuloCambiaEstado.php?Id=$reg[IdCA]&Estado=1&IdCategoria=$Id'>Deshabilita</a>";

	DatoGenera(TraduceIdioma($reg['IdIdioma']));
	DatoNumGenera($reg['Visitas']);
	DatoNumGenera($reg['Prioridad']);
	DatoGenera($accion);
	FilaFinal();
}

	$rs=mysql_query("select a.Id, a.Titulo, ca.Estado, ca.Id as IdCA, a.Visitas, a.Prioridad, a.IdIdioma from categoriasarticulos ca, articulos a where ca.IdArticulo = a.Id and ca.IdCategoria=$Id order by a.Titulo");
	if (mysql_num_rows($rs)) {
?>

<p>
<h2>Art&iacute;culos</h2>

<?php		
		$titulos = array('T&iacute;tulo', 'Idioma', 'Visitas', 'Prio', 'Acci&oacute;n' );

		TablaInicio($titulos,"90%");

		while ($reg=mysql_fetch_array($rs)) 
			MuestraArticulo($reg);
				
		TablaFinal();
	}

	mysql_free_result($rs);
?>


</center>

<?php
	Desconectar();
	include('Final.inc.php');
?>

