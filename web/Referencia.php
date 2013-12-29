<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');
	include('Utiles.inc.php');
	include('Categorias.inc.php');
	include('Traduccion.inc.php');
	include('Usuarios.inc.php');

	Conectar();
	
	AdministradorControla('');

	SesionPone('ReferenciaEnlace',PaginaActual());

	if (!isset($Id))
		PaginaSalir();

	$sql = "select Titulo, Detalle, IdItem, IdArticulo, IdCategoria, IdPagina, CodigoPagina, Enlace, Visitas, Prioridad, FechaHoraAlta, FechaHoraModificacion
		 from referencias where Id = $Id";		 
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
<a href="ReferenciaActualiza.php?Id=<? echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="ReferenciaElimina.php?Id=<? echo $Id; ?>">Elimina</a>
<?
	if ($IdArticulo) {
?>
&nbsp;
&nbsp;
<a href="Articulo.php?Id=<? echo $IdArticulo; ?>">Art&iacute;culo</a>
<?
	}
?>
<?
	if ($IdCategoria) {
?>
&nbsp;
&nbsp;
<a href="Categoria.php?Id=<? echo $IdCategoria; ?>">Categor&iacute;a</a>
<?
	}
?>
<?
	if ($IdItem) {
?>
&nbsp;
&nbsp;
<a href="Item.php?Id=<? echo $IdItem; ?>">Item</a>
<?
	}
?>
<?
	if ($IdPagina) {
?>
&nbsp;
&nbsp;
<a href="Pagina.php?Id=<? echo $IdPagina; ?>">P&aacute;gina</a>
<?
	}
?>
<br>
<?
	if ($Estado) {
?>
<a href="ReferenciaEstadoCambia.php?Id=<? echo $Id; ?>&Estado=0">Pasa a Normal</a>
<?
	} else {
?>
<a href="ReferenciaEstadoCambia.php?Id=<? echo $Id; ?>&Estado=1">Pasa a Pendiente</a>
<?
	}
?>
&nbsp;
&nbsp;
<a href="Eventos.php?Tipo=RE&IdParametro=<? echo $Id; ?>">Visitas</a>
</p>
<p>

<table cellspacing=1 cellpadding=2 class="Formulario" width="90%">
<?
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

<?
	Desconectar();
	require('Final.inc.php');
?>

