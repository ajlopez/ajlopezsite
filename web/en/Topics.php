<?
	$PaginaPrefijo = '../';
	include($PaginaPrefijo.'Usuarios.inc.php');
	include($PaginaPrefijo.'Paginas.inc.php');
	include($PaginaPrefijo.'Eventos.inc.php');

	Conectar();

	EventoPagina();

	$Categorias = array();
	$Abstracts = array();

	$sql = "select * from categorias where IdPadre=0 and Estado=0 and Description>'' order by description";
	$rs = mysql_query($sql);
	while ($reg = mysql_fetch_object($rs)) {
		$Categorias[$reg->Id] = $reg->Description;
		$Abstracts[$reg->Id] = $reg->Abstract;
	}

	$PaginaTitulo = "Topics";

	include($PaginaPrefijo.'en/Header.inc.php');
?>

<center>

<p>
Information, articles, links and resources about these topics.

<p>

<table cellspacing=1 cellpadding=3 width=600 bgcolor=black>

<?
function MuestraCategoria($Id,$Description,$Abstract,$x,$y)
{
	$pos = $x + $y;

	if ($pos % 2)
		$clase = "categoria1";
	else
		$clase = "categoria2";

	echo "<td width='33%' height=80 class=$clase valign=top><a class=categoria href='Topic.php?Id=$Id'>$Description</a><br>$Abstract</td>\n";
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

	$x=0; $y=0;
	$ncols = 2;
	$n=0;

	while (list($Id,$Description) = each($Categorias)) {
		$Abstract = $Abstracts[$Id];
		$y = (integer) ($n / $ncols);
		$x = $n % $ncols;

		if ($x==0 && $n)
			echo "</tr>\n";

		if ($x==0)
			echo "<tr>\n";

		MuestraCategoria($Id,$Description,$Abstract,$x,$y);
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
</center>

<?
	Desconectar();
	include($PaginaPrefijo.'en/Footer.inc.php');
?>

