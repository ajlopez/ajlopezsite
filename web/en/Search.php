<?
	if (!$PaginaPrefijo)
		$PaginaPrefijo = '../';

	include($PaginaPrefijo.'Campos.inc.php');
	include($PaginaPrefijo.'Conexion.inc.php');
	include($PaginaPrefijo.'Paginas.inc.php');
	include($PaginaPrefijo.'Sesion.inc.php');
	include($PaginaPrefijo.'Usuarios.inc.php');
	include($PaginaPrefijo.'Utiles.inc.php');
	include($PaginaPrefijo.'Eventos.inc.php');

	if (!isset($Filter))

		PaginaSalir();



	$PaginaTitulo = "Search";



	Conectar();



	EventoPagina();



	$sql = "select distinct p.Id, p.Titulo, p.Resumen from paginas p";



	$where = '';



	if ($Filter) {

		if ($where)

			$where .= ' and ';

		$where .= "(p.Titulo like '%$Filter%' or p.Alias like '%$Filter%' or p.Resumen like '%$Filter%' or p.Contenido like '%$Filter%')";

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



	$where = 'a.IdIdioma=2';



	if ($Filter) {

		if ($where)

			$where .= ' and ';

		$where .= "(a.Titulo like '%$Filter%' or a.Resumen like '%$Filter%' or a.Contenido like '%$Filter%' or a.Enlace like '%$Filter%' or a.Copete like '%$Filter%')";

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



	$where = 'i.IdIdioma=2';



	if ($Filter) {

		if ($where)

			$where .= ' and ';

		$where .= "(i.Descripcion like '%$Filter%' or i.Detalle like '%$Filter%' or i.Url like '%$Filter%')";

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



	include('Header.inc.php');

?>



<center>



<p>



<?

function PaginaMuestra($Id,$Titulo,$Resumen) {

	global $PaginaPrefijo;



?>

<tr>

<td class=item valign=top>

<a class=item href="<? echo $PaginaPrefijo; ?>en/Page.php?Id=<? echo $Id; ?>">

<? echo $Titulo; ?>

</a>

<?

	if (EsAdministrador()) {

?>

 

 

<a href="<? echo $PaginaPrefijo; ?>Pagina.php?Id=<? echo $Id; ?>">Administer</a>

<?

	}

?>

<br>

<? echo NormalizaHtml($Resumen); ?>

</td>

</tr>

<?

}

//	if ($rsPaginas && mysql_num_rows($rsPaginas)) {
	if (false) {

?>



<p>

<h2>Pages</h2>

<p>

<table width="100%" cellspacing=0 cellpadding=3>

<?

		while ($reg=mysql_fetch_object($rsPaginas))

			PaginaMuestra($reg->Id, $reg->Titulo, $reg->Resumen);

?>

</table>

</p>

<?		

	}	



	mysql_free_result($rsPaginas);

?>







<?

function ArticuloMuestra($Id,$Titulo,$Resumen,$Contenido,$Url) {

	global $PaginaPrefijo;



	if ($Url && !$Contenido) {

?>

<tr>

<td class=item valign=top>

<a class=item target='_blank' href="<? echo $PaginaPrefijo; ?>en/Article.php?Id=<? echo $Id; ?>">

<? echo $Titulo; ?>

</a>

<?

	if (EsAdministrador()) {

?>

 

 

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

<a class=item href="<? echo $PaginaPrefijo; ?>en/Article.php?Id=<? echo $Id; ?>">

<? echo $Titulo; ?>

</a>

<?

	if (EsAdministrador()) {

?>

 

 

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

<h2>Articles</h2>

<p>

<table width="100%" cellspacing=0 cellpadding=3>

<?

		while ($reg=mysql_fetch_object($rsArticulos))

			ArticuloMuestra($reg->Id, $reg->Titulo, $reg->Resumen, $reg->Contenido, $reg->Enlace);

?>

</table>

</p>

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

 

 

<a href="<? echo $PaginaPrefijo; ?>Item.php?Id=<? echo $Id; ?>">Administer</a>

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

	if ($rsItems && mysql_num_rows($rsItems)) {

?>

<h2>Links</h2>

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

	include('Footer.inc.php');

?>

