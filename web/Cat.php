<?php
    include_once('Settings.inc.php');
    
	include_once('Usuarios.inc.php');
	include_once('Paginas.inc.php');
	include_once('Categorias.inc.php');
	include_once('Utiles.inc.php');
	include_once('Eventos.inc.php');

	if (!$Id)
		PaginaRedireccionar(PaginaPrincipal());

	Conectar();

	AdministradorControla();

	EventoPagina();
	CategoriaVisita($Id);

	SesionPone('ItemEnlace',PaginaActual(),0);
	SesionPone('CategoriaEnlace',PaginaActual());

	$Categorias = array();
	$Resumenes = array();

	$sql = "select * from categorias where IdPadre=$Id order by descripcion";
	$rs = mysql_query($sql);
	while ($reg = mysql_fetch_object($rs)) {
		if ($reg->IdReferencia)
			$reg->Id = $reg->IdReferencia;
		$Categorias[$reg->Id] = $reg->Descripcion;
		$Resumenes[$reg->Id] = $reg->Resumen;
	}

	CategoriaTraduce($Id,$Descripcion,$IdPadre);

	$PaginaTitulo = $Descripcion;

	include('Inicio.inc.php');
?>

<center>

<p>
<a href="ItemActualiza.php?IdCategoria=<?php echo $Id; ?>">Agregar Enlace en esta Categor&iacute;a</a>
&nbsp;
&nbsp;
<a href="CategoriaActualiza.php?IdPadre=<?php echo $Id; ?>">Sugerir Subcategor&iacute;a</a>
<?php
	if (EsAdministrador()) {
		echo "&nbsp;&nbsp;";
		echo "<a href='Categoria.php?Id=$Id'>Administra</a>";
	}
?>
</p>
<p>
<a href="default.php">Categor&iacute;as</a>
<?php
	if ($IdPadre) {
		echo "&nbsp;->&nbsp;";
		echo CategoriasEnlaces($IdPadre,'Cat.php');
	}
?>
</p>

<table width="100%" border=0 cellspacing=0 cellpadding=3>

<?php
function MuestraCategoria($Id,$Descripcion,$Resumen,$x,$y)
{
	$pos = $x + $y;

	if ($pos % 2)
		$fondo = "#eeeeee";
	else
		$fondo = "#dddddd";

	echo "<td width='33%' height=30 class=categoria valign=top bgcolor=$fondo><a class=categoria href='Cat.php?Id=$Id'>$Descripcion</a><br>$Resumen</td>\n";
}

	reset($Categorias);

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

	echo "</tr>\n";
?>

</table>

<?php
function ItemMuestra($Id,$Descripcion,$Detalle,$Url)
{
	if (!strpos($Url,":/"))
		$Url = "http://" . $Url;
?>
<tr>
<td class=item valign=top>
<a class=item target='_blank' href="<?php echo $Url; ?>">
<?php echo $Descripcion; ?>
</a>
<br>
<?php echo NormalizaHtml($Detalle); ?>
</td>
</tr>
<?php
}
?>

<?php
	$sql = "Select i.* from categoriasitems ci left join items i on ci.IdItem = i.Id where ci.IdCategoria = $Id";
	$rsItems = mysql_query($sql);

	if (mysql_errno())
		echo mysql_error() . ": " . $sql;

	if ($rsItems && mysql_num_rows($rsItems)) {
?>
<h2><?php echo $Descripcion; ?> en Internet</h2>
<table width="100%" cellspacing=0 cellpadding=3>
<?php
		while ($reg=mysql_fetch_object($rsItems))
			ItemMuestra($reg->Id, $reg->Descripcion, $reg->Detalle, $reg->Url);
?>
</table>
<?php	
	}
?>


<?php
function ArticuloMuestra($Id,$Titulo,$Resumen) {
?>
<tr>
<td class=item valign=top>
<a class=item href="ArticuloMuestra.php?Id=<?php echo $Id; ?>">
<?php echo $Titulo; ?>
</a>
<br>
<?php echo NormalizaHtml($Resumen); ?>
</td>
</tr>
<?php
}
	$rsArticulos=mysql_query("select a.Id, a.Titulo, a.Resumen from categoriasarticulos ca, articulos a where ca.IdArticulo = a.Id and ca.IdCategoria=$Id order by a.Titulo");
	if ($rsArticulos && mysql_num_rows($rsArticulos)) {
?>

<p>
<h2>Art&iacute;culos</h2>
<table width="100%" cellspacing=0 cellpadding=3>
<?php
		while ($reg=mysql_fetch_object($rsArticulos))
			ArticuloMuestra($reg->Id, $reg->Titulo, $reg->Resumen);
?>
</table>

<?php	
	}	

	mysql_free_result($rsArticulos);
?>


</center>

<?php
	Desconectar();

	include('Final.inc.php');
?>

