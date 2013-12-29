<?
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

	EventoPagina($Id);
	CategoriaVisita($Id);

	SesionPone('ItemEnlace',PaginaActual(),0);
	SesionPone('CategoriaEnlace',PaginaActual());

	$Categorias = array();
	$Resumenes = array();

	CategoriaTraduce($Id,$Descripcion,$IdPadre);

	$rs = mysql_query("select Detail from categorias where Id = $Id");

	list($Detail)=mysql_fetch_row($rs);

	mysql_free_result($rs);

	$PaginaTitulo = "$Descripcion Links";

	include($PaginaPrefijo.'en/Header.inc.php');

	$sql = "Select i.* from categoriasitems ci left join items i on ci.IdItem = i.Id where ci.IdCategoria = $Id and ci.Estado=0 and i.Estado=0 and i.IdIdioma=2";
	$sql .= " order by i.Prioridad, i.Visitas desc, i.Id";
	$rsItems = mysql_query($sql);

	if (mysql_errno())
		echo mysql_error() . ": " . $sql;

	if ($rsItems)
		$NItems = mysql_num_rows($rsItems);
?>

<center>

<?
	if (EsAdministrador()) {
		echo "<p><a href='" . $PaginaPrefijo . "Categoria.php?Id=$Id'>Administer</a></p>";
	}
?>
<p>
<a href="<? echo $PaginaPrefijo; ?>Temas.php">Topics</a>
<?
	echo "&nbsp;->&nbsp;";
	echo CategoriasLinks($Id,$PaginaPrefijo.'en/Topic.php');
?>
</p>
<?
	if ($NArticles) {
?>
<p>
<a href="<? echo $PaginaPrefijo; ?>en/TopicArticles.php?Id=<? echo $Id; ?>&NItems=<? echo $NItems; ?>">Articles</a>
</p>
<?
	}
?>


<?
function ItemMuestra($Id,$Descripcion,$Detail,$Url)
{
	global $PaginaPrefijo;

	if (!strpos($Url,":/"))
		$Url = "http://" . $Url;
?>
<tr>
<td class=item valign=top>
<a class=item target='_blank' href="Item.php?Id=<? echo $Id; ?>">
<? echo $Descripcion; ?>
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
	if ($rsItems && mysql_num_rows($rsItems)) {
?>
<p>
<table width="100%" cellspacing=0 cellpadding=3>
<?
		while ($reg=mysql_fetch_object($rsItems))
			ItemMuestra($reg->Id, $reg->Descripcion, $reg->Detalle, $reg->Url);
?>
</table>
<?		
	}
?>

</center>

<?
	Desconectar();

	include($PaginaPrefijo.'en/Footer.inc.php');
?>

