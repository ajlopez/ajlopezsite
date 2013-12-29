<?
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
	include_once('Eventos.inc.php');
	include_once('Referencias.inc.php');

	Conectar();

	if (!isset($Id))
		PaginaSalir();

	$rsReferencia = mysql_query("select Titulo, IdItem, IdArticulo, IdCategoria, IdPagina, CodigoPagina, Enlace from referencias where Id = $Id");
	list($Titulo, $IdItem, $IdArticulo, $IdCategoria, $IdPagina, $CodigoPagina, $Enlace)
		= mysql_fetch_row($rsReferencia);

	if ($IdItem)
		$Referencia = "ItemVe.php?Id=$IdItem";
	if ($IdArticulo)
		$Referencia = "ArticuloMuestra.php?Id=$IdArticulo";
	if ($IdPagina)
		$Referencia = "PaginaMuestra.php?Id=$IdPagina";
	if ($CodigoPagina)
		$Referencia = "PaginaMuestra.php?Alias=$CodigoPagina";
	if ($IdCategoria)
		$Referencia = "Tema.php?Id=$IdCategoria";
	if ($Enlace)
		$Referencia = $Enlace;

	mysql_free_result($rsReferencia);

	$PaginaTitulo = "$Titulo";
?>

<HTML>
<HEAD>
	<TITLE><? echo $Titulo; ?></TITLE>
</HEAD>
<frameset rows="*" cols="*" frameborder="0" framespacing="0" border="0" marginwidth="0" marginheight="0">
    <frame name="principal" topmargin="0" leftmargin="0" marginwidth="0" marginheight="0" src="<? echo $Referencia; ?>" border="0" scrolling="yes">
</frameset>
<noframes>
<BODY>
</BODY>
</noframes>
</HTML>

<?
	if (UsuarioIdentificado()) {
		$rsVisitas = mysql_query("select * from eventos where Tipo = 'RE' and IdUsuario = " . UsuarioId() . " and IdParametro = $Id and FechaHora >= (now() - Interval 1 day)");
		if (mysql_errno())
			echo mysql_error();
		if (!mysql_num_rows($rsVisitas))
			PuntosVisita();
		mysql_free_result($rsVisitas);
	}

	$ReferenciasVisitadas = SesionToma('ReferenciasVisitadas');

	if (!$ReferenciasVisitadas)
		$ReferenciasVisitadas = array();

	if (!$ReferenciasVisitadas[$Id]) {
		$ReferenciasVisitadas[$Id]=1;
		SesionPone('ReferenciasVisitadas',$ReferenciasVisitadas);
		EventoVisitaReferencia($Id);
		ReferenciaVisita($Id);
	}

	Desconectar();
?>
