<?
	$PaginaPrefijo = '../';
	include($PaginaPrefijo.'Usuarios.inc.php');
	include($PaginaPrefijo.'Paginas.inc.php');
	include($PaginaPrefijo.'Eventos.inc.php');
	include($PaginaPrefijo.'Categorias.inc.php');

	Conectar();

	EventoPagina();

	$Categorias = array();
	$Abstracts = array();

	$sql = "select * from categorias where IdPadre=0 and Description>''";
	if (!EsAdministrador())
		$sql .= " and Estado = " . CATEGORIAS_ESTADO_NORMAL;
	$sql .= " order by description";
	$rs = mysql_query($sql);
	while ($reg = mysql_fetch_object($rs)) {
		if ($reg->Estado)
			$Categorias[$reg->Id] = "($reg->Description)";
		else
			$Categorias[$reg->Id] = $reg->Description;
		$Abstracts[$reg->Id] = $reg->Abstract;
	}

	$PaginaTitulo = "Angel \"Java\" Lopez Website";

	include('Header.inc.php');
?>

<center>

<p>
Welcome to my site <a href="<? echo PaginaPrincipal(); ?>">ajlopez</a>, where you find resources, links, pages and articles about programming, computer science and others topics.
</p>

</center>

<center>

<h2>Topics</h2>

<p>

<table cellspacing=1 cellpadding=3 width=600 border=0 bgcolor=black>

<?
function ShowCategory($Id,$Description,$Abstract,$x,$y)
{
	$pos = $x + $y;

	if ($pos % 2)
		$fondo = "#eeeeee";
	else
		$fondo = "#dddddd";

	echo "<td width='33%' class=categoria valign=top bgcolor=$fondo><a class=categoria href='Topic.php?Id=$Id'>$Description</a></td>\n";
}

function MuestraVacio($x,$y)
{
	$pos = $x + $y;

	if ($pos % 2)
		$fondo = "#eeeeee";
	else
		$fondo = "#dddddd";

	echo "<td width='33%' class=categoria valign=top bgcolor=$fondo>&nbsp;</td>\n";
}

	reset($Categorias);

	$x=0; $y=0;
	$ncols = 3;
	$n=0;

	while (list($Id,$Description) = each($Categorias)) {
		$Abstract = $Abstracts[$Id];
		$y = (integer) ($n / $ncols);
		$x = $n % $ncols;

		if ($x==0 && $n)
			echo "</tr>\n";

		if ($x==0)
			echo "<tr>\n";

		ShowCategory($Id,$Description,$Abstract,$x,$y);
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

<br>
<br>
      <!-- Del.icio.us Tags -->

<script type="text/javascript" src="http://del.icio.us/feeds/js/tags/ajlopez?icon;size=12-23;color=87ceeb-000080;title=My%20del.icio.us%20Tags;name;showadd"></script>

<br>
<br>

      <!-- Del.icio.us Links -->

	<script type="text/javascript" src="http://del.icio.us/feeds/js/ajlopez?title=My Links;icon=rss"></script>
<noscript><a href="http://del.icio.us/ajlopez">Links</a></noscript>

</center>

<?
	Desconectar();
	include('Footer.inc.php');
?>

