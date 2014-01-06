<?php
    include_once('Settings.inc.php');
    
	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Paginas.inc.php');
	include_once('Sesion.inc.php');
	include_once('Utiles.inc.php');
	include_once('Traduccion.inc.php');
	include_once('Usuarios.inc.php');

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
<a href="PaginaMuestra.php?Id=<?php echo $Id; ?>">Muestra</a>
&nbsp;
&nbsp;
<a href="PaginaActualiza.php?Id=<?php echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="PaginaElimina.php?Id=<?php echo $Id; ?>">Elimina</a>
<?php
	if ($IdReferencia) {
?>
&nbsp;
&nbsp;
<a href="Referencia.php?Id=<?php echo $IdReferencia; ?>">Referencia</a>
<?php
	} else {
?>
&nbsp;
&nbsp;
<a href="PaginaArmaReferencia.php?Id=<?php echo $Id; ?>">Crea Referencia</a>
<?php
	}
?>
<br>
<a href="Eventos.php?Tipo=PA&IdParametro=<?php echo $Id; ?>">Visitas</a>
</p>
<p>

<table cellspacing=1 cellpadding=2 class="Formulario" width='90%'>
<?php
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

<?php
	Desconectar();
	require('Final.inc.php');
?>

