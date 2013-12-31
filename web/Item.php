<?php
    include_once('Settings.inc.php');
    
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

	SesionPone('ItemEnlace',PaginaActual());
	SesionPone('CategoriaEnlace',PaginaActual());

	if (!isset($Id))
		PaginaSalir();

	$sql = "select Descripcion, IdClase, IdSitio, IdIdioma, Estado, Detalle, Url, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5, Comentarios, Prioridad, EsNuevo
		 from items where Id = $Id";		 
	$res = mysql_query($sql);
	list($Descripcion, $IdClase, $IdSitio, $IdIdioma, $Estado, $Detalle, $Url, $Visitas, $Votos1, $Votos2, $Votos3, $Votos4, $Votos5, $Comentarios, $Prioridad, $EsNuevo)
		= mysql_fetch_row($res);
	mysql_free_result($res);
	$PaginaTitulo = "Item: $Descripcion";

	$ClaseDescripcion = TraduceArticuloClase($IdClase);
	$IdiomaDescripcion = TraduceIdioma($IdIdioma);
	$SitioDescripcion = TraduceSitio($IdSitio);

	include('Inicio.inc.php');
?>

<center>

<p>
<a href="Items.php">Items</a>
&nbsp;
&nbsp;
<a href="ItemVe.php?Id=<?php echo $Id; ?>">Muestra</a>
&nbsp;
&nbsp;
<a href="en/Item.php?Id=<?php echo $Id; ?>">Show</a>
&nbsp;
&nbsp;
<a href="ItemActualiza.php?Id=<?php echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="ItemElimina.php?Id=<?php echo $Id; ?>">Elimina</a>
&nbsp;
&nbsp;
<a href="CategoriaSelecciona.php?IdItem=<?php echo $Id; ?>">Agrega a Categor&iacute;a</a>
&nbsp;
&nbsp;
<a href="ReferenciaActualiza.php?IdItem=<?php echo $Id; ?>&Titulo=<?php echo $Descripcion; ?>">Arma Referencia</a>
<br>
<?php
	if ($Estado) {
?>
<a href="ItemEstadoCambia.php?Id=<?php echo $Id; ?>&Estado=0">Pasa a Normal</a>
<?php
	} else {
?>
<a href="ItemEstadoCambia.php?Id=<?php echo $Id; ?>&Estado=1">Pasa a Pendiente</a>
<?php
	}
?>
&nbsp;
&nbsp;
<a href="Eventos.php?Tipo=IT&IdParametro=<?php echo $Id; ?>">Visitas</a>
</p>
<p>

<table cellspacing=1 cellpadding=2 class="Formulario">
<?php
	CampoEstaticoGenera("Id",$Id);
	CampoEstaticoGenera("Descripci&oacute;n",$Descripcion);
	CampoEstaticoGenera("Clase", $ClaseDescripcion);
	CampoEstaticoGenera("Idioma", $IdiomaDescripcion);
	if ($IdSitio)
		CampoEnlaceGenera("Sitio", $SitioDescripcion, "Sitio.php?Id=$IdSitio");
	CampoEstaticoGenera("Prioridad", $Prioridad);
	CampoEstaticoGenera("Detalle",NormalizaHtml($Detalle));
	CampoEstaticoGenera("Enlace",EnlaceUrlNuevo($Url));
	CampoEstaticoGenera("Visitas",$Visitas);
	CampoEstaticoGenera("Comentarios", $Comentarios);
	CampoEstaticoGenera("Prioridad", $Prioridad);
	CampoEstaticoGenera("Orden", $Orden);
	CampoEstaticoGenera("Es Nuevo", TextoSiNo($EsNuevo));
	CampoEstaticoGenera("Estado", TextoEstado($Estado));
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

	$accion = "<a href='CategoriaSelecciona.php?IdItem=$Id&IdCategoria=$reg[IdCategoria]&IdCategoriaItem=$reg[Id]'>Modifica</a>";
	if ($reg["Estado"])
		$accion .= "&nbsp;&nbsp;<a href='CategoriaItemCambiaEstado.php?Id=$reg[Id]&Estado=1&IdItem=$reg[IdItem]'>Habilita</a>";
	else
		$accion .= "&nbsp;&nbsp;<a href='CategoriaItemCambiaEstado.php?Id=$reg[Id]&Estado=1&IdItem=$reg[IdItem]'>Deshabilita</a>";
	$accion .= "&nbsp;&nbsp;";
	$accion .= "<a href='CategoriaItemElimina.php?Id=$reg[Id]'>Elimina</a>";

	DatoGenera($accion);

	FilaFinal();
}

	$rs=mysql_query("select * from categoriasitems where IdItem=$Id order by Id");
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
	include('Final.inc.php');
?>

