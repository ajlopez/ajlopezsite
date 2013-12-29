<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');

	$PaginaTitulo = "P&aacute;ginas";

	Conectar();

	$sql = "select distinct Titulo, Id, Visitas from paginas";

	$where = '';

	if ($Titulo) {
		if ($where)
			$where .= ' and ';
		$where .= "Titulo like '%$Titulo%'";
	}

	if ($Palabra) {
		if ($where)
			$where .= ' and ';
		$where .= "(Titulo like '%$Palabra%' or Resumen like '%$Palabra%' or Contenido like '%$Palabra%')";
	}

	if ($where)
		$sql .= " where $where";

	$sql .= " order by Titulo";

	$rs = mysql_query($sql);

	$titulos = array("T&iacute;tulo","Visitas");

	SesionPone("PaginaEnlace", PaginaActual());

	include('Inicio.inc.php');
?>

<center>

<p>
<a href="PaginaActualiza.php">Nueva P&aacute;gina...</a>
<p>

<?		
function MuestraRegistro($reg) {
	FilaInicio();
	DatoEnlaceGenera($reg["Titulo"], "Pagina.php?Id=".$reg["Id"]);
	DatoNumGenera($reg['Visitas']);
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
