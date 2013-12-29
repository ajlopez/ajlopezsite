<?
	$PaginaPrefijo = '../';

	include($PaginaPrefijo.'Campos.inc.php');
	include($PaginaPrefijo.'Conexion.inc.php');
	include($PaginaPrefijo.'Errores.inc.php');
	include($PaginaPrefijo.'Paginas.inc.php');
	include($PaginaPrefijo.'PaginasEx.inc.php');
	include($PaginaPrefijo.'Sesion.inc.php');
	include($PaginaPrefijo.'Utiles.inc.php');
	include($PaginaPrefijo.'Categorias.inc.php');
	include($PaginaPrefijo.'Traduccion.inc.php');
	include($PaginaPrefijo.'Usuarios.inc.php');
	include($PaginaPrefijo.'Articulos.inc.php');
	include($PaginaPrefijo.'Formato.inc.php');

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

	require('Header.inc.php');

	if (EsAdministrador()) {
		echo "<center><p><a href='<?=$PaginaPrefijo?>Pagina.php?Id=$Id'>Administer</a></p></center>";
	}

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
	require('Footer.inc.php');
?>

