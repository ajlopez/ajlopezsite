<?
	include_once($PaginaPrefijo.'GetParameters.inc.php');
	include_once($PaginaPrefijo.'Usuarios.inc.php');
	include_once($PaginaPrefijo.'Paginas.inc.php');
	include_once($PaginaPrefijo.'Categorias.inc.php');
	include_once($PaginaPrefijo.'Utiles.inc.php');
	include_once($PaginaPrefijo.'Eventos.inc.php');

	Conectar();

	if ($Alias) {
		$sql = "select Id from categorias where Alias = '$Alias'";
		$rs = mysql_query($sql);
		list($Id) = mysql_fetch_row($rs);
		mysql_free_result($rs);
	}

	if (!$Id)
		PaginaRedireccionar(PaginaPrincipal());

	EventoPagina($Id,'Tema.php');
	CategoriaVisita($Id);

	SesionPone('ItemEnlace',PaginaActual(),0);
	SesionPone('CategoriaEnlace',PaginaActual());

	$Categorias = array();
	$Resumenes = array();

	$NMaxArticulos = 20;
	$NMaxItems = 20;

	$sql = "select * from categorias where IdPadre=$Id and Estado=0 order by descripcion";
	$rs = mysql_query($sql);
	while ($reg = mysql_fetch_object($rs)) {
		if ($reg->IdReferencia)
			$reg->Id = $reg->IdReferencia;
		$Categorias[$reg->Id] = $reg->Descripcion;
		$Resumenes[$reg->Id] = $reg->Resumen;
	}

	mysql_free_result($rs);

	CategoriaTraduce($Id,$Descripcion,$IdPadre);

	$rs = mysql_query("select Detalle from categorias where Id = $Id");

	list($Detalle)=mysql_fetch_row($rs);

	if ($Detalle)
		$Detalle = nl2br($Detalle);

//	if (strpos($Detalle,"\\\'") or strpos($Detalle,'\"'))
		$Detalle=stripSlashes($Detalle);

	mysql_free_result($rs);

	$PaginaTitulo = $Descripcion;

	include_once($PaginaPrefijo.'Inicio.inc.php');

	$sql = "select a.Id, a.Titulo, a.Resumen, a.Contenido, a.Enlace from categoriasarticulos ca, articulos a where ca.IdArticulo = a.Id and ca.IdCategoria=$Id and ca.Estado=0 and a.IdEstado=0";
	$sql .= " order by a.Prioridad, a.Visitas desc, a.Id desc";
	$sql .= " limit 0, $NMaxArticulos";
	$rsArticulos=mysql_query($sql);

	if (mysql_errno())
		echo mysql_error() . ": " . $sql;

	$sql = "Select i.* from categoriasitems ci left join items i on ci.IdItem = i.Id where ci.IdCategoria = $Id and ci.Estado=0 and i.Estado=0";
	$sql .= " order by i.Prioridad, i.Visitas desc, i.Id";
	$sql .= " limit 0, $NMaxItems";
	$rsItems = mysql_query($sql);

	if (mysql_errno())
		echo mysql_error() . ": " . $sql;

	if ($rsArticulos)
		$NArticulos = mysql_num_rows($rsArticulos);

	if ($rsItems)
		$NItems = mysql_num_rows($rsItems);
?>

<center>

<?
	if (EsAdministrador()) {
		echo "<p><a href='" . $PaginaPrefijo . "Categoria.php?Id=$Id' target='_top'>Administra</a></p>";
	}
?>
<p>
<a href="<? echo $PaginaPrefijo; ?>Temas.php" target='_top'>Temas</a>
<?
	if ($IdPadre) {
		echo "&nbsp;->&nbsp;";
		echo CategoriasEnlaces($IdPadre,$PaginaPrefijo.'Tema.php');
	}
?>
</p>

<p>
<?
	if ($NArticulos) {
?>
<a href="<? echo $PaginaPrefijo; ?>TemaArticulos.php?Id=<? echo $Id; ?>&NItems=<? echo $NItems; ?>">Art&iacute;culos</a>
<?
	}
?>
<?
	if ($NItems) {
		if ($NArticulos)
			echo "&nbsp;&nbsp";
?>
<a href="<? echo $PaginaPrefijo; ?>TemaEnlaces.php?Id=<? echo $Id; ?>&NArticulos=<? echo $NArticulos; ?>">Enlaces</a>
<?
	}
?>
</p>

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
	if ($Detalle) {
		echo "<p class=categoriadetalle>\n";
		echo $Detalle;
//		echo nl2br($Detalle);
		echo "</p>\n";
	}
?>

<p>
<br>
<center>

<?
function MuestraCategoria($Id,$Descripcion,$Resumen,$x,$y)
{
	global $PaginaPrefijo;

	$pos = $x + $y;

	if ($pos % 2)
		$clase = "categoria1";
	else
		$clase = "categoria2";

	echo "<td width='33%' class=$clase valign=top><a class=categoria target='_top' href='" . $PaginaPrefijo . "Tema.php?Id=$Id'>$Descripcion</a><br>$Resumen</td>\n";
}

function MuestraVacio($x,$y)
{
	$pos = $x + $y;

	if ($pos % 2)
		$clase = "categoria1";
	else
		$clase = "categoria2";

	echo "<td width='33%' class=$clase valign=top>&nbsp;</td>\n";
}

	reset($Categorias);

	if (count($Categorias)) {
?>
<p>
<table cellspacing=1 cellpadding=3 width=600 border=0 bgcolor=black>

<?

	$x=0; $y=0;
	$ncols = 3;
	$n=0;

	while (list($IdCategoria,$DescripcionCategoria) = each($Categorias)) {
		$Resumen = $Resumenes[$IdCategoria];
		$y = (integer) ($n / $ncols);
		$x = $n % $ncols;

		if ($x==0 && $n)
			echo "</tr>\n";

		if ($x==0)
			echo "<tr>\n";

		MuestraCategoria($IdCategoria,$DescripcionCategoria,$Resumen,$x,$y);
		$n++;
	}



	$x++;

	while ($x<$ncols) {
		MuestraVacio($x,$y);
		$x++;
	}

	echo "</tr>\n";
?>

</table>

<?
	}


function ArticuloMuestra($Id,$Titulo,$Resumen,$Contenido,$Url) {
	global $PaginaPrefijo;

	if ($Url && !$Contenido) {
?>
<tr>
<td class=item valign=top>
<a class=item target='_blank' href="<? echo $PaginaPrefijo; ?>ArticuloVe.php?Id=<? echo $Id; ?>">
<? echo $Titulo; ?>
</a>
<?
	if (EsAdministrador()) {
?>
&nbsp;
&nbsp;
<a href="<? echo $PaginaPrefijo; ?>Articulo.php?Id=<? echo $Id; ?>">Administra</a>
<?
	}
?>
<br>
<? echo NormalizaHtml($Resumen); ?>
</td>
</tr>
<?
	}
	else {
?>
<tr>
<td class=item valign=top>
<a class=item href="<? echo $PaginaPrefijo; ?>ArticuloMuestra.php?Id=<? echo $Id; ?>">
<? echo $Titulo; ?>
</a>
<?
	if (EsAdministrador()) {
?>
&nbsp;
&nbsp;
<a href="<? echo $PaginaPrefijo; ?>Articulo.php?Id=<? echo $Id; ?>">Administra</a>
<?
	}
?>
<br>
<? echo NormalizaHtml($Resumen); ?>
</td>
</tr>
<?
	}
}
	if ($rsArticulos && mysql_num_rows($rsArticulos)) {
?>

<p>
<h2>Art&iacute;culos</h2>
<p>
<a href='<? echo $PaginaPrefijo; ?>TemaArticulos.php?Id=<? echo $Id; ?>&NItems=<? echo $NItems; ?>'>Todos los art&iacute;culos</a>
</p>
<p>
<table width="100%" cellspacing=0 cellpadding=3>
<?
		while ($reg=mysql_fetch_object($rsArticulos))
			ArticuloMuestra($reg->Id, $reg->Titulo, $reg->Resumen, $reg->Contenido, $reg->Enlace);
?>
</table>
</p>
<?
	if ($NArticulos>=$NMaxArticulos) {
?>
<p align=right>
<a href='<? echo $PaginaPrefijo; ?>TemaArticulos.php?Id=<? echo $Id; ?>&NItems=<? echo $NItems; ?>'>M&aacute;s art&iacute;culos...</a>
</p>
<?
	}
?>
<?		
	}	

	mysql_free_result($rsArticulos);
?>

<?
function ItemMuestra($Id,$Descripcion,$Detalle,$Url)
{
	global $PaginaPrefijo;

	if (!strpos($Url,":/"))
		$Url = "http://" . $Url;
?>
<tr>
<td class=item valign=top>
<a class=item target='_blank' href="<? echo $PaginaPrefijo; ?>ItemVe.php?Id=<? echo $Id; ?>">
<? echo $Descripcion; ?>
</a>
<?
	if (EsAdministrador()) {
?>
&nbsp;
&nbsp;
<a href="<? echo $PaginaPrefijo; ?>Item.php?Id=<? echo $Id; ?>">Administra</a>
<?
	}
?>
<br>
<? echo NormalizaHtml($Detalle); ?>
</td>
</tr>
<?
}
?>

<?
	$sql = "Select i.* from categoriasitems ci left join items i on ci.IdItem = i.Id where ci.IdCategoria = $Id and ci.Estado=0 and i.Estado=0";
	$sql .= " order by i.Prioridad, i.Visitas desc, i.Id";
	$sql .= " limit 0, 10";
	$rsItems = mysql_query($sql);

	if (mysql_errno())
		echo mysql_error() . ": " . $sql;

	if ($rsItems && mysql_num_rows($rsItems)) {
?>
<h2>Enlaces</h2>
<p>
<a href='<? echo $PaginaPrefijo; ?>TemaEnlaces.php?Id=<? echo $Id; ?>&NArticulos=<? echo $NArticulos; ?>'>Todos los enlaces</a>
</p>
<p>
<table width="100%" cellspacing=0 cellpadding=3>
<?
		while ($reg=mysql_fetch_object($rsItems))
			ItemMuestra($reg->Id, $reg->Descripcion, $reg->Detalle, $reg->Url);
?>
</table>
<p>
<?
	if ($NItems>=$NMaxItems) {
?>
<p align=right>
<a href='<? echo $PaginaPrefijo; ?>TemaEnlaces.php?Id=<? echo $Id; ?>&NArticulos=<? echo $NArticulos; ?>'>M&aacute;s enlaces...</a>
</p>
<?
	}
?>
<?		
	}
?>



</center>

<?
	Desconectar();

	include($PaginaPrefijo.'Final.inc.php');
?>

