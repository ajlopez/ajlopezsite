<?php
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
        
    $Id += 0;
    $IdPadre += 0;
    $NItems += 0;

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

	$sql = "select a.Id, a.Titulo, a.Resumen, a.Contenido, a.Enlace from categoriasarticulos ca, articulos a where ca.IdArticulo = a.Id and ca.IdCategoria='$Id' and ca.Estado=0 and a.IdEstado=0";
	$sql .= " order by a.Prioridad, a.Visitas desc, a.Id desc";
	$rsArticulos=mysql_query($sql);

	if (mysql_errno())
		echo mysql_error() . ": " . $sql;

	if ($rsArticulos)
		$NArticulos = mysql_num_rows($rsArticulos);
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
	if ($NItems) {
?>
<p>
<a href="<?php echo $PaginaPrefijo; ?>TemaEnlaces.php?Id=<?php echo $Id; ?>&NArticulos=<?php echo $NArticulos; ?>">Enlaces</a>
</p>
<?php
	}
?>

</center>

<?php
	if ($Detalle) {
		echo "<p class=categoriadetalle>\n";
		echo nl2br($Detalle);
		echo "</p>\n";
	}
?>

<center>


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
&nbsp;
&nbsp;
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
&nbsp;
&nbsp;
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
<table width="100%" cellspacing=0 cellpadding=3>
<?php
		while ($reg=mysql_fetch_object($rsArticulos))
			ArticuloMuestra($reg->Id, $reg->Titulo, $reg->Resumen, $reg->Contenido, $reg->Enlace);
?>
</table>

<?php	
	}	

	mysql_free_result($rsArticulos);
?>


</center>

<?php
	Desconectar();

	include($PaginaPrefijo.'Final.inc.php');
?>

