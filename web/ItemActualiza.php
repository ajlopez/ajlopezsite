<?php
    include_once('Settings.inc.php');
    
	include_once('GetParameters.inc.php');
	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Usuarios.inc.php');
	include_once('Paginas.inc.php');

	Conectar();
	
	AdministradorControla('');

	if (isset($Id)) {
        $Id += 0;
		$sql = "select * from items where Id = '$Id'"; 
		$rs = mysql_query($sql);
		$reg = mysql_fetch_object($rs);
		$Descripcion = $reg->Descripcion;
		$Detalle = $reg->Detalle;
		$Url = $reg->Url;
		$IdUsuario = $reg->IdUsuario;
		$IdClase = $reg->IdClase;
		$IdIdioma = $reg->IdIdioma;
		$IdSitio = $reg->IdSitio;
		$Comentarios = $reg->Comentarios;
		$Prioridad = $reg->Prioridad;
		$EsNuevo = $reg->EsNuevo;
		mysql_free_result($rs);
		$PaginaTitulo = "Actualiza Item";
	}	
	else {
		$PaginaTitulo = "Nuevo Item";
	}

	$rsClases = mysql_query("select id, descripcion from articulosclases order by id");
	$rsIdiomas = mysql_query("select id, descripcion from idiomas order by id");
	$rsSitios = mysql_query("select id, descripcion from sitios order by descripcion");

	require('Inicio.inc.php');
?>

<center>

<p>
<?php
	if ($Id) {
?>
&nbsp;
&nbsp;
<a href="Item.php?Id=<?php echo $Id; ?>">Item</a>
&nbsp;
&nbsp;
<a href="ItemElimina.php?Id=<?php echo $Id; ?>">Elimina</a>
<?php
	}
?>
</p>

<p>

<form action="ItemGraba.php" method=post>

<table cellspacing=1 cellpadding=2 class="Formulario">
<?php
	if ($Id)
		CampoEstaticoGenera("Id",$Id);
	CampoTextoGenera("Descripcion","Descripci&oacute;n",$Descripcion,50);
	CampoTextoGenera("Url", "Enlace", $Url, 50);
	CampoMemoGenera("Detalle","Detalle",$Detalle,10,50);

	CampoComboRsGenera("IdClase","Clase", $rsClases, $IdClase);
	CampoComboRsGenera("IdIdioma","Idioma", $rsIdiomas, $IdIdioma);
	CampoComboRsGenera("IdSitio","Sitio", $rsSitios, $IdSitio, 'id', 'descripcion', true);
	CampoTextoGenera("Prioridad","Prioridad",$Prioridad,3);
	CampoCheckGenera("EsNuevo","Es Nuevo", $EsNuevo);

	CampoAceptarGenera();
?>
</table>

<input type="hidden" name="IdCategoria" value="<?php echo $IdCategoria; ?>">

<?php
	if ($Id)
		IdGenera($Id);
?>

</form>

</center>

<?php
	Desconectar();
	require('Final.inc.php');
?>

