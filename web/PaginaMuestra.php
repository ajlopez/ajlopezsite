<?
	include_once('GetParameters.inc.php');
	include_once($PaginaPrefijo.'Campos.inc.php');
	include_once($PaginaPrefijo.'Conexion.inc.php');
	include_once($PaginaPrefijo.'Errores.inc.php');
	include_once($PaginaPrefijo.'Paginas.inc.php');
	include_once($PaginaPrefijo.'PaginasEx.inc.php');
	include_once($PaginaPrefijo.'Sesion.inc.php');
	include_once($PaginaPrefijo.'Utiles.inc.php');
	include_once($PaginaPrefijo.'Categorias.inc.php');
	include_once($PaginaPrefijo.'Traduccion.inc.php');
	include_once($PaginaPrefijo.'Usuarios.inc.php');
	include_once($PaginaPrefijo.'Articulos.inc.php');
	include_once($PaginaPrefijo.'Formato.inc.php');

	Conectar();

	if ($Alias) {
		$sql = "select Id, Titulo, Resumen, Contenido, EsHTML, Visitas, FechaHoraAlta, FechaHoraModificacion from paginas where Alias = '$Alias'";
		$rs = mysql_query($sql);
		list($Id, $Titulo, $Resumen, $Contenido, $EsHTML, $Visitas, $FechaHoraAlta, $FechaHoraModificacion) = mysql_fetch_row($rs);
		mysql_free_result($rs);
	}
	else if (!isset($Id))
		PaginaSalir();
	else {
		$sql = "select Titulo, Alias, Resumen, Contenido, EsHTML, Visitas, FechaHoraAlta, FechaHoraModificacion from paginas where Id = $Id";
		$rs = mysql_query($sql);
		list($Titulo, $Alias, $Resumen, $Contenido, $EsHTML, $Visitas, $FechaHoraAlta, $FechaHoraModificacion) = mysql_fetch_row($rs);
		mysql_free_result($rs);
	}
	
	PaginaVisita($Id);
	EventoVisitaPagina($Id);

	//if (strpos($Contenido,"\\\'") or strpos($Contenido,'\"'))
		$Contenido=stripSlashes($Contenido);

	$PaginaTitulo = $Titulo;

	require($PaginaPrefijo.'Inicio.inc.php');

	if (EsAdministrador()) {
		echo "<center><p><a href='${PaginaPrefijo}Pagina.php?Id=$Id'>Administra</a></p></center>";
	}
?>
<center>

<script type="text/javascript"><!--
google_ad_client = "pub-8624135492444658";
//728x90, created 12/12/07
google_ad_slot = "1011191902";
google_ad_width = 728;
google_ad_height = 90;
//--></script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>



</center>
<?

	if ($Contenido) {
		if ($EsHTML)
			echo $Contenido;
		else {
			echo "<p class=noticiatexto>";
			echo nl2br($Contenido);
			echo "</p>";
		}
	}
?>

<?
	Desconectar();
	require($PaginaPrefijo.'Final.inc.php');
?>

