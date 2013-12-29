<?
	include('Usuarios.inc.php');
	include('Paginas.inc.php');
	include('Categorias.inc.php');
	include('Utiles.inc.php');

	Conectar();

	$IdCategoria += 0;
	$IdHijo += 0;

	$Subparametros = "IdHijo=$IdHijo";
	$Parametros = "$Subparametros&IdCategoria=$IdCategoria";

	$Categorias = array();
	$Resumenes = array();

	$sql = "select * from categorias where IdPadre=$IdCategoria order by descripcion";
	$rs = mysql_query($sql);
	while ($reg = mysql_fetch_object($rs)) {
		$Categorias[$reg->Id] = $reg->Descripcion;
		$Resumenes[$reg->Id] = $reg->Resumen;
	}

	CategoriaTraduce($IdCategoria,$Descripcion,$IdPadre);

	$PaginaTitulo = $Descripcion;

	include('Inicio.inc.php');
?>

<center>

<?
	if ($IdCategoria) {
?>
<p>
<a href="CategoriaPadreGraba.php?<? echo $Parametros; ?>">Selecciona esta Categor&iacute;a</a>
</p>
<p>
<a href="CategoriaSeleccionaPadre.php?<? echo $Subparametros ?>">Categor&iacute;as</a>
<?
	if ($IdPadre) {
		echo "&nbsp;->&nbsp;";
		echo CategoriasEnlaces($IdPadre,"CategoriaSeleccionaPadre.php?$Subparametros","IdCategoria");
	}
?>
</p>
<?
	}
?>

<table width="100%" cellspacing=1 cellpadding=2 bgcolor=black>

<?
function MuestraCategoria($Id,$Descripcion,$Resumen,$x,$y)
{
	global $Subparametros;
	global $Parametros;

	$pos = $x + $y;

	if ($pos % 2)
		$fondo = "#eeeeee";
	else
		$fondo = "#dddddd";

	echo "<td width='33%' height=30 class=categoria valign=top bgcolor=$fondo><a class=categoria href='CategoriaSeleccionaPadre.php?IdCategoria=$Id&$Subparametros'>$Descripcion</a><br>$Resumen</td>\n";
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

</center>

<?
	Desconectar();

	include('Final.inc.php');
?>

