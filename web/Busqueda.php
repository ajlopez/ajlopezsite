<?php
    include_once('Settings.inc.php');	include($PaginaPrefijo.'Campos.inc.php');
	include($PaginaPrefijo.'Conexion.inc.php');
	include($PaginaPrefijo.'Paginas.inc.php');
	include($PaginaPrefijo.'Sesion.inc.php');
	include($PaginaPrefijo.'Usuarios.inc.php');
	include($PaginaPrefijo.'Utiles.inc.php');
	include($PaginaPrefijo.'Eventos.inc.php');
	if (!isset($Filtro))
		PaginaSalir();
	$PaginaTitulo = "B�squeda";
	Conectar();
	EventoPagina();
	$sql = "select distinct p.Id, p.Titulo, p.Resumen from paginas p";
	$where = '';
	if ($Filtro) {
		if ($where)
			$where .= ' and ';
		$where .= "(p.Titulo like '%$Filtro%' or p.Alias like '%$Filtro%' or p.Resumen like '%$Filtro%' or p.Contenido like '%$Filtro%')";
	}
/*
	if (!EsAdministrador()) {
		if ($where)
			$where .= ' and ';
		$where .= 'ca.Estado=0 and c.Estado=0';
	}
*/
	if ($where)
		$sql .= " where $where";
	$sql .= " order by p.Id desc, p.Visitas desc";
	$rsPaginas = mysql_query($sql);
	$sql = "select distinct a.Id, a.Titulo, a.Resumen, a.Contenido, a.Enlace from (articulos a left join categoriasarticulos ca on a.Id = ca.IdArticulo) left join categorias c on ca.IdCategoria = c.Id";
	$where = '';
	if ($Filtro) {
		if ($where)
			$where .= ' and ';
		$where .= "(a.Titulo like '%$Filtro%' or a.Resumen like '%$Filtro%' or a.Contenido like '%$Filtro%' or a.Enlace like '%$Filtro%' or a.Copete like '%$Filtro%')";
	}
	if (!EsAdministrador()) {
		if ($where)
			$where .= ' and ';
		$where .= 'ca.Estado=0 and c.Estado=0';
	}
	if ($where)
		$sql .= " where $where";
	$sql .= " order by a.Prioridad, a.Visitas desc";
	$rsArticulos = mysql_query($sql);
	$sql = "select distinct i.Id, i.Descripcion, i.Detalle, i.Visitas, i.Prioridad from (items i left join categoriasitems ci on i.Id = ci.IdItem) left join categorias c on ci.IdCategoria = c.Id";
	$where = '';
	if ($Filtro) {
		if ($where)
			$where .= ' and ';
		$where .= "(i.Descripcion like '%$Filtro%' or i.Detalle like '%$Filtro%' or i.Url like '%$Filtro%')";
	}
	if (!EsAdministrador()) {
		if ($where)
			$where .= ' and ';
		$where .= 'ci.Estado=0 and c.Estado=0';
	}
	if ($where)
		$sql .= " where $where";
	$sql .= " order by i.Prioridad, i.Visitas desc";
	$rsItems = mysql_query($sql);
	SesionPone("ItemEnlace", PaginaActual());
	include('Inicio.inc.php');
?>
<center>

<p>
<?php
function PaginaMuestra($Id,$Titulo,$Resumen) {
	global $PaginaPrefijo;
?>
<tr>
<td class=item valign=top>
<a class=item href="<?php echo $PaginaPrefijo; ?>PaginaMuestra.php?Id=<?php echo $Id; ?>">
<?php echo $Titulo; ?>
</a>
<?php
	if (EsAdministrador()) {
?>
<a href="<?php echo $PaginaPrefijo; ?>Pagina.php?Id=<?php echo $Id; ?>">Administra</a>
<?php
	}
?>
<br>
<?php echo NormalizaHtml($Resumen); ?>
</td>
</tr>
<?php
}
	if ($rsPaginas && mysql_num_rows($rsPaginas)) {
?>
<p>
<h2>P�ginas</h2>
<p>
<table width="100%" cellspacing=0 cellpadding=3>
<?php
		while ($reg=mysql_fetch_object($rsPaginas))
			PaginaMuestra($reg->Id, $reg->Titulo, $reg->Resumen);
?>
</table>
</p>
<?php
	}	
	mysql_free_result($rsPaginas);
?>
<?php
function ArticuloMuestra($Id,$Titulo,$Resumen,$Contenido,$Url) {
	global $PaginaPrefijo;
	if ($Url && !$Contenido) {
?>
<tr>
<td class=item valign=top>
<a class=item target='_blank' href="<?php echo $PaginaPrefijo; ?>ArticuloVe.php?Id=<?php echo $Id; ?>">
<?php echo $Titulo; ?>
</a>
<?php
	if (EsAdministrador()) {
?>
<a href="<?php echo $PaginaPrefijo; ?>Articulo.php?Id=<?php echo $Id; ?>">Administra</a>
<?php
	}
?>
<br>
<?php echo NormalizaHtml($Resumen); ?>
</td>
</tr>
<?php
	}
	else {
?>
<tr>
<td class=item valign=top>
<a class=item href="<?php echo $PaginaPrefijo; ?>ArticuloMuestra.php?Id=<?php echo $Id; ?>">
<?php echo $Titulo; ?>
</a>
<?php
	if (EsAdministrador()) {
?>
<a href="<?php echo $PaginaPrefijo; ?>Articulo.php?Id=<?php echo $Id; ?>">Administra</a>
<?php
	}
?>
<br>
<?php echo NormalizaHtml($Resumen); ?>
</td>
</tr>
<?php
	}
}
	if ($rsArticulos && mysql_num_rows($rsArticulos)) {
?>
<p>
<h2>Art�culos</h2>
<p>
<table width="100%" cellspacing=0 cellpadding=3>
<?php
		while ($reg=mysql_fetch_object($rsArticulos))
			ArticuloMuestra($reg->Id, $reg->Titulo, $reg->Resumen, $reg->Contenido, $reg->Enlace);
?>
</table>
</p>
<?php
	}	
	mysql_free_result($rsArticulos);
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
<h2>Enlaces</h2>
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
	include('Final.inc.php');
?>
