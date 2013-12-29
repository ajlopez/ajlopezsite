<?
	if (!$PaginaPrefijo)
		$PaginaPrefijo = '../';

	include($PaginaPrefijo.'Usuarios.inc.php');
	include($PaginaPrefijo.'Paginas.inc.php');
	include($PaginaPrefijo.'Categorias.inc.php');
	include($PaginaPrefijo.'Utiles.inc.php');
	include($PaginaPrefijo.'Eventos.inc.php');

	Conectar();

	if ($Alias) {
		$sql = "select Id from categorias where Alias = '$Alias'";
		$rs = mysql_query($sql);
		list($Id) = mysql_fetch_row($rs);
		mysql_free_result($rs);
	}

	if (!$Id)
		PaginaRedireccionar(PaginaPrincipal());

	EventoPagina($Id,'Topic.php');
	CategoriaVisita($Id);

	SesionPone('ItemEnlace',PaginaActual(),0);
	SesionPone('CategoriaEnlace',PaginaActual());

	$Categorias = array();
	$Abstracts = array();

	$NMaxArticulos = 20;
	$NMaxItems = 20;

	$sql = "select * from categorias where IdPadre=$Id and Estado=0 and Description>'' order by descripcion";
	$rs = mysql_query($sql);
	while ($reg = mysql_fetch_object($rs)) {
		if ($reg->IdReferencia)
			$reg->Id = $reg->IdReferencia;
		$Categorias[$reg->Id] = $reg->Description;
		$Abstracts[$reg->Id] = $reg->Abstract;
	}

	mysql_free_result($rs);

	CategoriaTranslate($Id,$Description,$IdPadre);

	$rs = mysql_query("select Detail from categorias where Id = $Id");

	list($Detail)=mysql_fetch_row($rs);

	if ($Detail)
		$Detail = nl2br($Detail);

	$Detail=stripSlashes($Detail);

	mysql_free_result($rs);

	$PaginaTitulo = $Description;

	include($PaginaPrefijo.'en/Header.inc.php');

	$sql = "select a.Id, a.Titulo, a.Resumen, a.Contenido, a.Enlace from categoriasarticulos ca, articulos a where ca.IdArticulo = a.Id and ca.IdCategoria=$Id and ca.Estado=0 and a.IdEstado=0 and a.IdIdioma=2";
	$sql .= " order by a.Prioridad, a.Visitas desc, a.Id desc";
	$sql .= " limit 0, $NMaxArticulos";
	$rsArticulos=mysql_query($sql);

	if (mysql_errno())
		echo mysql_error() . ": " . $sql;

	$sql = "Select i.* from categoriasitems ci left join items i on ci.IdItem = i.Id where ci.IdCategoria = $Id and ci.Estado=0 and i.Estado=0 and i.IdIdioma=2";
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
		echo "<p><a href='" . $PaginaPrefijo . "Categoria.php?Id=$Id' target='_top'>Administer</a></p>";
	}
?>
<p>
<a href="<? echo $PaginaPrefijo; ?>en/Topics.php" target='_top'>Topics</a>
<?
	if ($IdPadre) {
		echo "&nbsp;->&nbsp;";
		echo CategoriasLinks($IdPadre,$PaginaPrefijo.'en/Topic.php');
	}
?>
</p>

<p>
<?
	if ($NArticulos) {
?>
<a href="TopicArticles.php?Id=<? echo $Id; ?>&NItems=<? echo $NItems; ?>">Articles</a>
<?
	}
?>
<?
	if ($NItems) {
		if ($NArticulos)
			echo "&nbsp;&nbsp";
?>
<a href="<? echo $PaginaPrefijo; ?>en/TopicLinks.php?Id=<? echo $Id; ?>&NArticulos=<? echo $NArticulos; ?>">Links</a>
<?
	}
?>
</p>

</center>

<?
	if ($Detail) {
		echo "<p class=categoriadetalle>\n";
		echo $Detail;
//		echo nl2br($Detail);
		echo "</p>\n";
	}
?>

<p>
<br>
<center>

<?
function MuestraCategoria($Id,$Description,$Resumen,$x,$y)
{
	global $PaginaPrefijo;

	$pos = $x + $y;

	if ($pos % 2)
		$clase = "categoria1";
	else
		$clase = "categoria2";

	echo "<td width='33%' class=$clase valign=top><a class=categoria target='_top' href='" . $PaginaPrefijo . "en/Topic.php?Id=$Id'>$Description</a><br>$Resumen</td>\n";
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

	while (list($IdCategoria,$DescriptionCategoria) = each($Categorias)) {
		$Resumen = $Abstracts[$IdCategoria];
		$y = (integer) ($n / $ncols);
		$x = $n % $ncols;

		if ($x==0 && $n)
			echo "</tr>\n";

		if ($x==0)
			echo "<tr>\n";

		MuestraCategoria($IdCategoria,$DescriptionCategoria,$Resumen,$x,$y);
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
<a class=item target='_blank' href="Article.php?Id=<? echo $Id; ?>">
<? echo $Titulo; ?>
</a>
<?
	if (EsAdministrador()) {
?>
&nbsp;
&nbsp;
<a href="<? echo $PaginaPrefijo; ?>Articulo.php?Id=<? echo $Id; ?>">Administer</a>
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
<a class=item href="Article.php?Id=<? echo $Id; ?>">
<? echo $Titulo; ?>
</a>
<?
	if (EsAdministrador()) {
?>
&nbsp;
&nbsp;
<a href="<? echo $PaginaPrefijo; ?>Articulo.php?Id=<? echo $Id; ?>">Administer</a>
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
<h2>Articles</h2>
<p>
<a href='<?=$PaginaPrefijo?>en/TopicArticles.php?Id=<? echo $Id; ?>&NItems=<? echo $NItems; ?>'>All Articles in Topic</a>
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
<a href='<?=$PaginaPrefijo?>en/TopicArticles.php?Id=<? echo $Id; ?>&NItems=<? echo $NItems; ?>'>More articles...</a>
</p>
<?
	}
?>
<?		
	}	

	mysql_free_result($rsArticulos);
?>

<?
function ItemMuestra($Id,$Description,$Detail,$Url)
{
	global $PaginaPrefijo;

	if (!strpos($Url,":/"))
		$Url = "http://" . $Url;
?>
<tr>
<td class=item valign=top>
<a class=item target='_blank' href="<? echo $PaginaPrefijo; ?>en/Item.php?Id=<? echo $Id; ?>">
<? echo $Description; ?>
</a>
<?
	if (EsAdministrador()) {
?>
&nbsp;
&nbsp;
<a href="<? echo $PaginaPrefijo; ?>Item.php?Id=<? echo $Id; ?>">Administer</a>
<?
	}
?>
<br>
<? echo NormalizaHtml($Detail); ?>
</td>
</tr>
<?
}
?>

<?
	$sql = "Select i.* from categoriasitems ci left join items i on ci.IdItem = i.Id where ci.IdCategoria = $Id and ci.Estado=0 and i.Estado=0 and i.IdIdioma=2";
	$sql .= " order by i.Prioridad, i.Visitas desc, i.Id";
	$sql .= " limit 0, 10";
	$rsItems = mysql_query($sql);

	if (mysql_errno())
		echo mysql_error() . ": " . $sql;

	if ($rsItems && mysql_num_rows($rsItems)) {
?>
<h2>Links</h2>
<p>
<a href='<? echo $PaginaPrefijo; ?>en/TopicLinks.php?Id=<? echo $Id; ?>&NArticulos=<? echo $NArticulos; ?>'>All links in topic</a>
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
<a href='<?=$PaginaPrefijo?>en/TopicLinks.php?Id=<? echo $Id; ?>&NArticulos=<? echo $NArticulos; ?>'>More links...</a>
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

	include($PaginaPrefijo.'en/Footer.inc.php');
?>

