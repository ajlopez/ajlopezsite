<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Usuarios.inc.php');
	include('Paginas.inc.php');
	include('Categorias.inc.php');

	Conectar();
	
	if (isset($Id)) {
		$sql = "select * from categorias where Id = $Id"; 
		$rs = mysql_query($sql);
		$reg = mysql_fetch_object($rs);
		$Descripcion = $reg->Descripcion;
		$Detalle = $reg->Detalle;
		$Resumen = $reg->Resumen;
		$Description = $reg->Description;
		$Detail = $reg->Detail;
		$Abstract = $reg->Abstract;
		$IdPadre = $reg->IdPadre;
		$Alias = $reg->Alias;
		mysql_free_result($rs);
		$PaginaTitulo = "Actualiza Categor&iacute;a";
		$EsNuevo = 0;

		//if (strpos($Detalle,"\\\'") or strpos($Detalle,'\"'))
			$Detalle=stripSlashes($Detalle);

	}	
	else {
		$PaginaTitulo = "Nueva Categor&iacute;a";
		$EsNuevo = 1;
	}

	require('Inicio.inc.php');
?>

<center>

<?
	$Enlaces = CategoriasEnlaces($IdPadre);

	if ($Enlaces) {
?>
<p>
<? echo $Enlaces; ?>
</p>
<?
	}
?>

<p>
<a href="Categorias.php">Categor&iacute;as</a>

<?
	if (!$EsNuevo) {
?>
&nbsp;
&nbsp;
<a href="Categoria.php?Id=<? echo $Id; ?>">Categor&iacute;a</a>
&nbsp;
&nbsp;
<a href="CategoriaElimina.php?Id=<? echo $Id; ?>">Elimina</a>
<?
	}
?>
</p>

<p>

<form action="CategoriaGraba.php" method=post>

<table cellspacing=1 cellpadding=2 class="Formulario">
<?
	if (!$EsNuevo)
		CampoEstaticoGenera("Id",$Id);
	CampoTextoGenera("Descripcion","Descripci&oacute;n",$Descripcion,50);
	CampoTextoGenera("Alias","Alias",$Alias,16);
	CampoMemoGenera("Detalle","Detalle",$Detalle,10,50);
	CampoMemoGenera("Resumen","Resumen",$Resumen,5,50);

	CampoTextoGenera("Description","Description",$Description,50);
	CampoMemoGenera("Detail","Detail",$Detail,10,50);
	CampoMemoGenera("Abstract","Abstract",$Abstract,5,50);

	CampoAceptarGenera();
?>
</table>

<input type="hidden" name="IdPadre" value="<? echo $IdPadre; ?>">
<?
	if (!$EsNuevo)
		IdGenera($Id);
?>
</form>

</center>

<?
	Desconectar();
	require('Final.inc.php');
?>

