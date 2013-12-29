<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');
	include('Usuarios.inc.php');

	$PaginaTitulo = "Referencias";

	AdministradorControla('');

	Conectar();

	$sql = "select distinct Titulo, Id, Visitas, Prioridad from referencias";

	$where = '';

	if ($Titulo) {
		if ($where)
			$where .= ' and ';
		$where .= "Titulo like '%$Titulo%'";
	}

	if ($Palabra) {
		if ($where)
			$where .= ' and ';
		$where .= "(Titulo like '%$Palabra%' or Detalle like '%$Palabra%')";
	}

	if ($where)
		$sql .= " where $where";

	$sql .= " order by Titulo";

	$rs = mysql_query($sql);

	$titulos = array("T&iacute;tulo","Prioridad","Visitas");

	SesionPone("ReferenciaEnlace", PaginaActual());

	include('Inicio.inc.php');
?>

<center>

<p>
<a href="ReferenciaActualiza.php">Nueva Referencia...</a>
<p>

<?		
function MuestraRegistro($reg) {
	FilaInicio();
	DatoEnlaceGenera($reg["Titulo"], "Referencia.php?Id=".$reg["Id"]);
	DatoNumGenera($reg['Prioridad']);
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
