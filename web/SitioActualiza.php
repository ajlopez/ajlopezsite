<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Usuarios.inc.php');
	include('Paginas.inc.php');

	Conectar();
	
	if (isset($Id)) {
		$sql = "select * from sitios where Id = $Id"; 
		$rs = mysql_query($sql);
		$reg = mysql_fetch_object($rs);
		$Descripcion = $reg->Descripcion;
		$Enlace = $reg->Enlace;
		$Dominio = $reg->Dominio;
		mysql_free_result($rs);
		$PaginaTitulo = "Actualiza Sitio";
		$EsNuevo = 0;
	}	
	else {
		$PaginaTitulo = "Nuevo Sitio";
		$EsNuevo = 1;
	}

	require('Inicio.inc.php');
?>

<center>

<p>
<?
	if (!$EsNuevo) {
?>
&nbsp;
&nbsp;
<a href="Sitio.php?Id=<? echo $Id; ?>">Sitio</a>
&nbsp;
&nbsp;
<a href="SitioElimina.php?Id=<? echo $Id; ?>">Sitio</a>
<?
	}
?>
</p>

<p>

<form action="SitioGraba.php" method=post>

<table cellspacing=1 cellpadding=2 class="Formulario">
<?
	if (!$EsNuevo)
		CampoEstaticoGenera("Id",$Id);
	CampoTextoGenera("Descripcion","Descripci&oacute;n",$Descripcion,50);
	CampoTextoGenera("Enlace", "Enlace", $Enlace, 50);
	CampoTextoGenera("Dominio","Dominio",$Dominio,50);

	CampoAceptarGenera();
?>
</table>

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

