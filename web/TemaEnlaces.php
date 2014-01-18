<?
    include_once('Settings.inc.php');

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

	$PaginaTitulo = "Enlaces de $Descripcion";

	include($PaginaPrefijo.'Inicio.inc.php');

	$sql = "Select i.* from categoriasitems ci left join items i on ci.IdItem = i.Id where ci.IdCategoria = $Id and ci.Estado=0 and i.Estado=0";
	$sql .= " order by i.Prioridad, i.Visitas desc, i.Id";
	$rsItems = mysql_query($sql);

	if (mysql_errno())
		echo mysql_error() . ": " . $sql;

	if ($rsItems)
		$NItems = mysql_num_rows($rsItems);
?>

<center>

<?php
	if (EsAdministrador()) {
		echo "<p><a href='" . $PaginaPrefijo . "Categoria.php?Id=$Id'>Administra</a></p>";
	}
?>
<p>
<a href="<?php echo $PaginaPrefijo; ?>Temas.php">Temas</a>
<?php
	echo "&nbsp;->&nbsp;";
	echo CategoriasEnlaces($Id,$PaginaPrefijo.'Tema.php');
?>
</p>
<?php
	if ($NArticulos) {
?>
<p>
<a href="<?php echo $PaginaPrefijo; ?>TemaArticulos.php?Id=<?php echo $Id; ?>&NItems=<?php echo $NItems; ?>">Art&iacute;culos</a>
</p>
<?php
	}
?>

<?php
function ItemMuestra($Id,$Descripcion,$Detalle,$Url)
{
	global $PaginaPrefijo;

	if (!strpos($Url,":/"))
		$Url = "http://" . $Url;
?>
<tr>
<td class=item valign=top>
<a class=item target='_blank' href="<?php echo $PaginaPrefijo; ?>ItemVe.php?Id=<?php echo $Id; ?>">
<?php echo $Descripcion; ?>
</a>
<?php
	if (EsAdministrador()) {
?>
&nbsp;
&nbsp;
<a href="<?php echo $PaginaPrefijo; ?>Item.php?Id=<?php echo $Id; ?>">Administra</a>

<?php
	}
?>
<br>
<?php echo NormalizaHtml($Detalle); ?>
</td>
</tr>
<?php
}
?>

<?php
	if ($rsItems && mysql_num_rows($rsItems)) {
?>
<p>
<table width="100%" cellspacing=0 cellpadding=3>
<?php
		while ($reg=mysql_fetch_object($rsItems))
			ItemMuestra($reg->Id, $reg->Descripcion, $reg->Detalle, $reg->Url);
?>
</table>
<?php	
	}
?>

</center>

<?php
	Desconectar();

	include($PaginaPrefijo.'Final.inc.php');
?>

