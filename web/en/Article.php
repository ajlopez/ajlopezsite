<?
	$PaginaPrefijo = '../';

	include($PaginaPrefijo.'Campos.inc.php');
	include($PaginaPrefijo.'Conexion.inc.php');
	include($PaginaPrefijo.'Errores.inc.php');
	include($PaginaPrefijo.'Paginas.inc.php');
	include($PaginaPrefijo.'Sesion.inc.php');
	include($PaginaPrefijo.'Utiles.inc.php');
	include($PaginaPrefijo.'Categorias.inc.php');
	include($PaginaPrefijo.'Usuarios.inc.php');
	include($PaginaPrefijo.'Puntos.inc.php');
	include($PaginaPrefijo.'Articulos.inc.php');

	Conectar();
	
	if (!isset($Id))
		PaginaSalir();

	$sql = "select Titulo, Enlace, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5
		 from articulos where Id = $Id";		 
	$res = mysql_query($sql);
	list($Descripcion, $Url, $Visitas, $Votos1, $Votos2, $Votos3, $Votos4, $Votos5)
		= mysql_fetch_row($res);
	mysql_free_result($res);
	$PaginaTitulo = "$Descripcion";
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

	Desconectar();

	if (PaginaEsLocal($Url))
		PaginaRedireccionarLocal($Url);
?>

<HTML>
<HEAD>
	<TITLE><? echo $Descripcion; ?></TITLE>
</HEAD>
<frameset rows="120,*" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
	<frame name="tope" src="ArticleTop.php?Id=<? echo $Id; ?>" scrolling="NO" NORESIZE>
	<frame name="principal" src="<? echo NormalizaUrl($Url); ?>">
</frameset>
<noframes>
<BODY>
</BODY>
</noframes>
</HTML>

<?

?>