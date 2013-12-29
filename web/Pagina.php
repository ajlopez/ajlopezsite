<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');
	include('Utiles.inc.php');
	include('Traduccion.inc.php');
	include('Usuarios.inc.php');

	Conectar();
	
	AdministradorControla('');

	SesionPone('PaginaEnlace',PaginaActual());

	if (!isset($Id))
		PaginaSalir();

	$sql = "select Titulo, Alias, Resumen, Contenido, EsHTML, Visitas, FechaHoraAlta, FechaHoraModificacion from paginas where Id = $Id";
	$rs = mysql_query($sql);
	list($Titulo, $Alias, $Resumen, $Contenido, $EsHTML, $Visitas, $FechaHoraAlta, $FechaHoraModificacion) = mysql_fetch_row($rs);
	mysql_free_result($rs);

	$Resumen=stripSlashes($Resumen);
	$Contenido=stripSlashes($Contenido);

	$PaginaTitulo = "P&aacute;gina: $Titulo";

	$sql = "select Id from referencias where IdPagina = $Id";
	$rsPaginas = mysql_query($sql);

	if ($rsPaginas && mysql_num_rows($rsPaginas)>0) {
		list($IdReferencia) = mysql_fetch_row($rsPaginas);
	}

	require('Inicio.inc.php');
?>

<center>

<p>
<a href="Paginas.php">P&aacute;ginas</a>
&nbsp;
&nbsp;
<a href="PaginaMuestra.php?Id=<? echo $Id; ?>">Muestra</a>
&nbsp;
&nbsp;
<a href="PaginaActualiza.php?Id=<? echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="PaginaElimina.php?Id=<? echo $Id; ?>">Elimina</a>
<?
	if ($IdReferencia) {
?>
&nbsp;
&nbsp;
<a href="Referencia.php?Id=<? echo $IdReferencia; ?>">Referencia</a>
<?
	} else {
?>
&nbsp;
&nbsp;
<a href="PaginaArmaReferencia.php?Id=<? echo $Id; ?>">Crea Referencia</a>
<?
	}
?>
<br>
<a href="Eventos.php?Tipo=PA&IdParametro=<? echo $Id; ?>">Visitas</a>
</p>
<p>

<table cellspacing=1 cellpadding=2 class="Formulario" width='90%'>
<?
	CampoEstaticoGenera("Id",$Id);
	CampoEstaticoGenera("Título", $Titulo);
	CampoEstaticoGenera("Alias", $Alias);
	CampoMemoEstaticoGenera("Resumen", $Resumen);
	if ($EsHTML)
		CampoHTMLEstaticoGenera("Contenido", $Contenido);
	else
		CampoMemoEstaticoGenera("Contenido", $Contenido);
	CampoEstaticoGenera("Es HTML?", TextoSiNo($EsHTML));
	CampoEstaticoGenera("Visitas",$Visitas);
	CampoEstaticoGenera("Fecha/Hora Alta",$FechaHoraAlta);
	CampoEstaticoGenera("Fecha/Hora Modificación",$FechaHoraModificacion);
?>
</table>

</center>

<?
	Desconectar();
	require('Final.inc.php');
?>

