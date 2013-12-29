<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');

	$PaginaTitulo = "Sitios";

	Conectar();

	$sql = "select distinct Descripcion, Enlace, Id from sitios";

	$where = '';

	if ($where)
		$sql .= " where $where";

	$sql .= " order by Descripcion";

	$rs = mysql_query($sql);

	$titulos = array("Descripci&oacute;n","Enlace");

	SesionPone("SitioEnlace", PaginaActual());

	include('Inicio.inc.php');
?>

<center>

<p>
<a href="SitioActualiza.php">Nuevo Sitio...</a>
<p>

<?		
function MuestraRegistro($reg) {
	FilaInicio();
	DatoEnlaceGenera($reg["Descripcion"], "Sitio.php?Id=".$reg["Id"]);
	DatoEnlaceGenera($reg["Enlace"], $reg["Enlace"]);
	FilaFinal();
}
	
	TablaInicio($titulos,"90%");

	while ($reg=mysql_fetch_array($rs)) 
		MuestraRegistro($reg);
				
	TablaFinal();
	
?>

</center>

<?
	Desconectar();
	include('Final.inc.php');
?>
