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

	EventoPagina($Id);
	CategoriaVisita($Id);

	SesionPone('ItemEnlace',PaginaActual(),0);
	SesionPone('CategoriaEnlace',PaginaActual());

	$Categorias = array();
	$Resumenes = array();

	CategoriaTraduce($Id,$Descripcion,$IdPadre);

	$rs = mysql_query("select Detalle from categorias where Id = $Id");

	list($Detalle)=mysql_fetch_row($rs);

	mysql_free_result($rs);

	$PaginaTitulo = "Art&iacute;culos de $Descripcion";

	include($PaginaPrefijo.'Inicio.inc.php');

	$sql = "select a.Id, a.Titulo, a.Resumen, a.Contenido, a.Enlace from categoriasarticulos ca, articulos a where ca.IdArticulo = a.Id and ca.IdCategoria=$Id and ca.Estado=0 and a.IdEstado=0";
	$sql .= " order by a.Prioridad, a.Visitas desc, a.Id desc";
	$rsArticulos=mysql_query($sql);

	if (mysql_errno())
		echo mysql_error() . ": " . $sql;

	if ($rsArticulos)
		$NArticulos = mysql_num_rows($rsArticulos);
?>

<center>

<?
	if (EsAdministrador()) {
		echo "<p><a href='" . $PaginaPrefijo . "Categoria.php?Id=$Id'>Administra</a></p>";
	}
?>
<p>
<a href="<? echo $PaginaPrefijo; ?>Temas.php">Temas</a>
<?
	echo "&nbsp;->&nbsp;";
	echo CategoriasEnlaces($Id,$PaginaPrefijo.'Tema.php');
?>
</p>
<?
	if ($NItems) {
?>
<p>
<a href="<? echo $PaginaPrefijo; ?>TemaEnlaces.php?Id=<? echo $Id; ?>&NArticulos=<? echo $NArticulos; ?>">Enlaces</a>
</p>
<?
	}
?>

</center>

<?
	if ($Detalle) {
		echo "<p class=categoriadetalle>\n";
		echo nl2br($Detalle);
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

	include($PaginaPrefijo.'Final.inc.php');
?>

