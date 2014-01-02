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
	include_once('Articulos.inc.php');
	include_once('Formato.inc.php');

	Conectar();
	
	if (!isset($Id))
		PaginaSalir();

	$sql = "select Titulo, IdClase, Resumen, Copete, Contenido, EsHTML, Archivo, Imagen, TextoImagen, Enlace, Visitas, Orden, IdEstado, Votos1, Votos2, Votos3, Votos4, Votos5, VigenciaDesde, VigenciaHasta from articulos where Id = $Id";
	$rs = mysql_query($sql);
	list($Titulo, $IdClase, $Resumen, $Copete, $Contenido, $EsHTML, $Archivo, $Imagen, $TextoImagen, $Enlace, $Visitas, $Orden, $IdEstado, $Votos1, $Votos2, $Votos3, $Votos4, $Votos5, $VigenciaDesde, $VigenciaHasta) = mysql_fetch_row($rs);
	mysql_free_result($rs);

	if (!EsAdministrador()) {
		$sql = "select c.Id from categorias c, categoriasarticulos ca where ca.IdArticulo = $Id and ca.IdCategoria = c.Id and ca.Estado=0 and c.Estado=0";
		$rsCats = mysql_query($sql);
		if (!mysql_num_rows($rsCats)) {
			mysql_free_result($rsCats);
			AdministradorControla();
		}
		else
			mysql_free_result($rsCats);
	}

	if (UsuarioIdentificado()) {
		$rsVisitas = mysql_query("select * from eventos where Tipo = 'AR' and IdUsuario = " . UsuarioId() . " and IdParametro = $Id and FechaHora >= (now() - Interval 1 day)");
		if (mysql_errno())
			echo mysql_error();
		if (!mysql_num_rows($rsVisitas))
			PuntosVisita();
		mysql_free_result($rsVisitas);
	}

	$ArticulosVisitados = SesionToma('ArticulosVisitados');

	if (!$ArticulosVisitados)
		$ArticulosVisitados = array();

	if (!$ArticulosVisitados[$Id]) {
		$ArticulosVisitados[$Id]=1;
		SesionPone('ArticulosVisitados',$ArticulosVisitados);
		EventoVisitaArticulo($Id);
		ArticuloVisita($Id);
	}

	$Contenido=stripSlashes($Contenido);

	$PaginaTitulo = "Artículo: $Titulo";

	$ClaseDescripcion = TraduceArticuloClase($IdClase);

	$PaginaTitulo = $Titulo;

	require('Inicio.inc.php');

	if (EsAdministrador()) {
		echo "<center><p><a href='Articulo.php?Id=$Id'>Administra</a></p></center>";
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

<?php
	if ($Copete) {
		echo "<p class=noticiacopete>";
		echo nl2br($Copete);
		echo "</p>";
	}

	if ($Imagen) {
		echo "<center>\n";
		echo "<img src='$Imagen'>\n";
		echo "</center>\n";
	}

	if ($Archivo) {
		$file = fopen($Archivo,"r");
		ProcesaArchivo($file);

		fclose($file);		
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

	if ($Enlace) {
		echo "<p>";
		echo "<a href='$Enlace'>$Enlace</a>";
		echo "</p>";
	}
?>

<?php
	Desconectar();
	require('Final.inc.php');
?>

