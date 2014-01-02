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
	include_once('Usuarios.inc.php');
	include_once('Puntos.inc.php');
	include_once('Articulos.inc.php');

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
	<TITLE><?php echo $Descripcion; ?></TITLE>
</HEAD>
<frameset rows="120,*" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>

	<frame name="tope" src="ArticuloVeTope.php?Id=<?php echo $Id; ?>&Title=<?= $Descripcion ?>" scrolling="NO" NORESIZE>
	<frame name="principal" src="<?php echo NormalizaUrl($Url); ?>">
</frameset>

<noframes>
<BODY>

</BODY>
</noframes>
</HTML>

<?php

?>