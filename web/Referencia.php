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

	SesionPone('ReferenciaEnlace',PaginaActual());

	if (!isset($Id))
		PaginaSalir();
        
    $Id += 0;

	$sql = "select Titulo, Detalle, IdItem, IdArticulo, IdCategoria, IdPagina, CodigoPagina, Enlace, Visitas, Prioridad, FechaHoraAlta, FechaHoraModificacion
		 from referencias where Id = '$Id'";		 
	$res = mysql_query($sql);
	list($Titulo, $Detalle, $IdItem, $IdArticulo, $IdCategoria, $IdPagina, $CodigoPagina, $Enlace, $Visitas, $Prioridad, $FechaHoraAlta, $FechaHoraModificacion)
		= mysql_fetch_row($res);
	mysql_free_result($res);
	$PaginaTitulo = "Referencia: $Titulo";

	require('Inicio.inc.php');
?>

<center>

<p>
<a href="Referencias.php">Referencias</a>
&nbsp;
&nbsp;
<a href="ReferenciaActualiza.php?Id=<?php echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="ReferenciaElimina.php?Id=<?php echo $Id; ?>">Elimina</a>
<?php
	if ($IdArticulo) {
?>
&nbsp;
&nbsp;
<a href="Articulo.php?Id=<?php echo $IdArticulo; ?>">Art&iacute;culo</a>
<?php
	}
?>
<?php
	if ($IdCategoria) {
?>
&nbsp;
&nbsp;
<a href="Categoria.php?Id=<?php echo $IdCategoria; ?>">Categor&iacute;a</a>
<?php
	}
?>
<?php
	if ($IdItem) {
?>
&nbsp;
&nbsp;
<a href="Item.php?Id=<?php echo $IdItem; ?>">Item</a>
<?php
	}
?>
<?php
	if ($IdPagina) {
?>
&nbsp;
&nbsp;
<a href="Pagina.php?Id=<?php echo $IdPagina; ?>">P&aacute;gina</a>
<?php
	}
?>
<br>
<?php
	if ($Estado) {
?>
<a href="ReferenciaEstadoCambia.php?Id=<?php echo $Id; ?>&Estado=0">Pasa a Normal</a>
<?php
	} else {
?>
<a href="ReferenciaEstadoCambia.php?Id=<?php echo $Id; ?>&Estado=1">Pasa a Pendiente</a>
<?php
	}
?>
&nbsp;
&nbsp;
<a href="Eventos.php?Tipo=RE&IdParametro=<?php echo $Id; ?>">Visitas</a>
</p>
<p>

<table cellspacing=1 cellpadding=2 class="Formulario" width="90%">
<?php
	CampoEstaticoGenera("Id",$Id);
	CampoEstaticoGenera("Titulo",$Titulo);
	CampoMemoEstaticoGenera("Detalle", $Detalle);
	CampoEstaticoGenera("Id Item", $IdItem);
	CampoEstaticoGenera("Id Art&iacute;culo", $IdArticulo);
	CampoEstaticoGenera("Id Categor&iacute;a", $IdCategoria);
	CampoEstaticoGenera("Id P&aacute;gina", $IdPagina);
	CampoEstaticoGenera("C&oacute;digo de P&aacute;gina", $CodigoPagina);
	CampoEstaticoGenera("Enlace",EnlaceUrlNuevo($Enlace));
	CampoEstaticoGenera("Prioridad", $Prioridad);
	CampoEstaticoGenera("Visitas",$Visitas);
	CampoEstaticoGenera("Estado", TextoEstado($Estado));
?>
</table>


</center>

<?php
	Desconectar();
	require('Final.inc.php');
?>

