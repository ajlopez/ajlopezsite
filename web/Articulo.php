<?php
    include_once('Settings.inc.php');

	include_once('GetParameters.inc.php');
	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Paginas.inc.php');
	include_once('Sesion.inc.php');
	include_once('Utiles.inc.php');
	include_once('Categorias.inc.php');
	include_once('Traduccion.inc.php');
	include_once('Usuarios.inc.php');

	Conectar();
	
	AdministradorControla('');

	SesionPone('ArticuloEnlace',PaginaActual());
	SesionPone('CategoriaEnlace',PaginaActual());

	if (!isset($Id))
		PaginaSalir();
        
    $Id += 0;

	$sql = "select Titulo, IdClase, IdSitio, Resumen, Copete, Contenido, EsHTML, Archivo, Imagen, TextoImagen, Enlace, Visitas, Orden, IdEstado, Votos1, Votos2, Votos3, Votos4, Votos5, VigenciaDesde, VigenciaHasta, Comentarios, IdIdioma, Prioridad, EsNuevo from articulos where Id = '$Id'";
	$rs = mysql_query($sql);
	list($Titulo, $IdClase, $IdSitio, $Resumen, $Copete, $Contenido, $EsHTML, $Archivo, $Imagen, $TextoImagen, $Enlace, $Visitas, $Orden, $IdEstado, $Votos1, $Votos2, $Votos3, $Votos4, $Votos5, $VigenciaDesde, $VigenciaHasta, $Comentarios, $IdIdioma, $Prioridad, $EsNuevo) = mysql_fetch_row($rs);
	mysql_free_result($rs);

	$Resumen=stripSlashes($Resumen);
	$Contenido=stripSlashes($Contenido);

	$PaginaTitulo = "Artículo: $Titulo";

	$ClaseDescripcion = TraduceArticuloClase($IdClase);
	$IdiomaDescripcion = TraduceIdioma($IdIdioma);
	$SitioDescripcion = TraduceSitio($IdSitio);

	require('Inicio.inc.php');
?>

<center>

<p>
<a href="Articulos.php">Art&iacute;culos</a>
&nbsp;
&nbsp;
<a href="ArticuloMuestra.php?Id=<?php echo $Id; ?>">Muestra</a>
&nbsp;
&nbsp;
<a href="en/Article.php?Id=<?php echo $Id; ?>">Show</a>
&nbsp;
&nbsp;
<a href="ArticuloActualiza.php?Id=<?php echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="ArticuloElimina.php?Id=<?php echo $Id; ?>">Elimina</a>
&nbsp;
&nbsp;
<a href="CategoriaSeleccionaArt.php?IdArticulo=<?php echo $Id; ?>">Agrega a Categor&iacute;a</a>
&nbsp;
&nbsp;
<a href="ReferenciaActualiza.php?IdArticulo=<?php echo $Id; ?>&Titulo=<?php echo $Titulo; ?>">Arma Referencia</a>
<br>
<?php
	if ($IdEstado) {
?>
<a href="ArticuloEstadoCambia.php?Id=<?php echo $Id; ?>&Estado=0">Pasa a Normal</a>
<?php
	} else {
?>
<a href="ArticuloEstadoCambia.php?Id=<?php echo $Id; ?>&Estado=1">Pasa a Pendiente</a>
<?php
	}
?>
&nbsp;
&nbsp;
<a href="Eventos.php?Tipo=AR&IdParametro=<?php echo $Id; ?>">Visitas</a>
</p>
<p>

<table cellspacing=1 cellpadding=2 class="Formulario" width='90%'>
<?php
	CampoEstaticoGenera("Id",$Id);
	CampoEstaticoGenera("Título", $Titulo);
	CampoEstaticoGenera("Clase", $ClaseDescripcion);
	CampoEstaticoGenera("Idioma", $IdiomaDescripcion);
	if ($IdSitio)
		CampoEnlaceGenera("Sitio", $SitioDescripcion, "Sitio.php?Id=$IdSitio");
	CampoEstaticoGenera("Prioridad", $Prioridad);
	CampoMemoEstaticoGenera("Resumen", $Resumen);
	CampoMemoEstaticoGenera("Copete", $Copete);
	if ($EsHTML)
		CampoHTMLEstaticoGenera("Contenido", $Contenido);
	else
		CampoMemoEstaticoGenera("Contenido", $Contenido);
	CampoEstaticoGenera("Archivo", $Archivo);
	CampoEstaticoGenera("Imagen", $Imagen);
	CampoMemoEstaticoGenera("Texto de Imagen", $TextoImagen);
	CampoEstaticoGenera("Enlace", EnlaceUrlNuevo($Enlace));
	CampoEstaticoGenera("Visitas", $Visitas);
	CampoEstaticoGenera("Comentarios", $Comentarios);
	CampoEstaticoGenera("Prioridad", $Prioridad);
	CampoEstaticoGenera("Orden", $Orden);
	CampoEstaticoGenera("Es Nuevo", TextoSiNo($EsNuevo));
	CampoEstaticoGenera("Estado", TextoEstado($IdEstado));
	CampoEstaticoGenera("Vigente Desde", $VigenciaDesde);
	CampoEstaticoGenera("Vigente Hasta", $VigenciaHasta);
	$Votos = $Votos1 + $Votos2 + $Votos3 + $Votos4 + $Votos5;
	if ($Votos)
		$Promedio = ($Votos1 + 2*$Votos2 + 3*$Votos3 + 4*$Votos4 + 5*$Votos5)/$Votos;
	else
		$Promedio = 0;
	CampoEstaticoGenera("Votos", "1=$Votos1, 2=$Votos2, 3=$Votos3, 4=$Votos4, 5=$Votos5, Promedio=$Promedio");
?>
</table>

<?php
function MuestraRegistro($reg) {
	global $Id;

	FilaInicio();

	if ($reg["Estado"])
		DatoGenera("(".CategoriasEnlaces($reg["IdCategoria"]).")");
	else
		DatoGenera(CategoriasEnlaces($reg["IdCategoria"]));		

	$accion = "<a href='CategoriaSeleccionaArt.php?IdArticulo=$Id&IdCategoria=$reg[IdCategoria]&IdCategoriaArticulo=$reg[Id]'>Modifica</a>";
	if ($reg["Estado"])
		$accion .= "&nbsp;&nbsp;<a href='CategoriaArticuloCambiaEstado.php?Id=$reg[Id]&Estado=0&IdArticulo=$Id'>Habilita</a>";
	else
		$accion .= "&nbsp;&nbsp;<a href='CategoriaArticuloCambiaEstado.php?Id=$reg[Id]&Estado=1&IdArticulo=$Id'>Deshabilita</a>";
	$accion .= "&nbsp;&nbsp;";
	$accion .= "<a href='CategoriaArticuloElimina.php?Id=$reg[Id]'>Elimina</a>";

	DatoGenera($accion);

	FilaFinal();
}

	$rs=mysql_query("select * from categoriasarticulos where IdArticulo='$Id' order by Id");
	if (mysql_num_rows($rs)) {
?>

<p>
<h2>Categor&iacute;as</h2>

<?php	
		$titulos = array("Descripci&oacute;n", "Acci&oacute;n");

		TablaInicio($titulos,"90%");

		while ($reg=mysql_fetch_array($rs)) 
			MuestraRegistro($reg);
				
		TablaFinal();
	}
?>

</center>

<?php
	Desconectar();
	require('Final.inc.php');
?>

