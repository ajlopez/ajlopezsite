<?php
	$PaginaPrefijo = '../';

    include_once($PaginaPrefijo.'Settings.inc.php');
    
	include_once($PaginaPrefijo.'GetParameters.inc.php');
	include_once($PaginaPrefijo.'Campos.inc.php');
	include_once($PaginaPrefijo.'Conexion.inc.php');
	include_once($PaginaPrefijo.'Errores.inc.php');
	include_once($PaginaPrefijo.'Paginas.inc.php');
	include_once($PaginaPrefijo.'Sesion.inc.php');
	include_once($PaginaPrefijo.'Utiles.inc.php');
	include_once($PaginaPrefijo.'Categorias.inc.php');
	include_once($PaginaPrefijo.'Usuarios.inc.php');
	include_once($PaginaPrefijo.'Puntos.inc.php');
	include_once($PaginaPrefijo.'Items.inc.php');

	Conectar();
	
	if (!isset($Id))
		PaginaSalir();
        
    $Id += 0;

	$sql = "select Descripcion, Url, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5
		 from items where Id = '$Id'";		 
	$res = mysql_query($sql);
	list($Descripcion, $Url, $Visitas, $Votos1, $Votos2, $Votos3, $Votos4, $Votos5)
		= mysql_fetch_row($res);
	mysql_free_result($res);
	$PaginaTitulo = "$Descripcion";
?>

<HTML>
<HEAD>
	<TITLE><?php echo $Descripcion; ?></TITLE>
</HEAD>
<frameset rows="120,*" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
	<frame name="tope" src="ItemTop.php?Id=<?php echo $Id; ?>" scrolling="NO" NORESIZE>
	<frame name="principal" src="<?php echo NormalizaUrl($Url); ?>">
</frameset>
<noframes>
<BODY>
</BODY>
</noframes>
</HTML>

<?php
	if (UsuarioIdentificado()) {
		$rsVisitas = mysql_query("select * from eventos where Tipo = 'IT' and IdUsuario = '" . UsuarioId() . "' and IdParametro = '$Id' and FechaHora >= (now() - Interval 1 day)");
		if (mysql_errno())
			echo mysql_error();
		if (!mysql_num_rows($rsVisitas))
			PuntosVisita();
		mysql_free_result($rsVisitas);
	}

	$ItemsVisitados = SesionToma('ItemsVisitados');

	if (!$ItemsVisitados)
		$ItemsVisitados = array();

	if (!$ItemsVisitados[$Id]) {
		$ItemsVisitados[$Id]=1;
		SesionPone('ItemsVisitados',$ItemsVisitados);
		EventoVisitaItem($Id);
		ItemVisita($Id);
	}

	Desconectar();
?>
