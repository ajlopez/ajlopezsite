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

	CategoriaTranslate($Id,$Description,$IdPadre);

	$rs = mysql_query("select Detail from categorias where Id = $Id");

	list($Detail)=mysql_fetch_row($rs);

	mysql_free_result($rs);

	$PaginaTitulo = "$Description Articles";

	include($PaginaPrefijo.'en/Header.inc.php');

	$sql = "select a.Id, a.Titulo, a.Resumen, a.Contenido, a.Enlace from categoriasarticulos ca, articulos a where ca.IdArticulo = a.Id and ca.IdCategoria=$Id and ca.Estado=0 and a.IdEstado=0 and a.IdIdioma=2";
	$sql .= " order by a.Prioridad, a.Visitas desc, a.Id desc";
	$rsArticulos=mysql_query($sql);

	if (mysql_errno())
		echo mysql_error() . ": " . $sql;

	if ($rsArticulos)
		$NArticles = mysql_num_rows($rsArticulos);
?>

<center>

<?
	if (EsAdministrador()) {
		echo "<p><a href='" . $PaginaPrefijo . "Categoria.php?Id=$Id'>Administer</a></p>";
	}
?>
<p>
<a href="<? echo $PaginaPrefijo; ?>Topics.php">Topics</a>
<?
	echo "&nbsp;->&nbsp;";
	echo CategoriasLinks($Id,$PaginaPrefijo.'en/Topic.php');
?>
</p>
<?
	if ($NItems) {
?>
<p>
<a href="<? echo $PaginaPrefijo; ?>en/TopicLinks.php?Id=<? echo $Id; ?>&NArticles=<? echo $NArticles; ?>">Links</a>
</p>
<?
	}
?>

</center>

<?
	if ($Detail) {
		echo "<p class=categoriadetalle>\n";
		echo nl2br($Detail);
		echo "</p>\n";
	}
?>

<center>


<?

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
<table width="100%" cellspacing=0 cellpadding=3>
<?
		while ($reg=mysql_fetch_object($rsArticulos))
			ArticuloMuestra($reg->Id, $reg->Titulo, $reg->Resumen, $reg->Contenido, $reg->Enlace);
?>
</table>

<?		
	}	

	mysql_free_result($rsArticulos);
?>


</center>

<?
	Desconectar();

	include($PaginaPrefijo.'en/Footer.inc.php');
?>

