<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');
	include('Usuarios.inc.php');
	include('Categorias.inc.php');

	$NoCache = 1;

	if (!$Filtro && !EsAdministrador())
		PaginaRedireccionar('CategoriasFiltro.php');

	if (!$Palabra && !$Titulo)
		$IdPadre = 0;

	$PaginaTitulo = "Categor&iacute;as";

	Conectar();

	AdministradorControla();

	$sql = "select * from categorias";
	$where = "";

	if (isset($IdPadre)) {
		if ($where)
			$where .= ' and ';
		$where .= "IdPadre = $IdPadre";
	}

	if ($Palabra) {
		if ($where)
			$where .= ' and ';
		$where .= "(Descripcion like '%$Palabra%' or Alias like '%$Palabra%' or Resumen like '%$Palabra%')";
	}

	if ($Titulo) {
		if ($where)
			$where .= ' and ';
		$where .= "Descripcion like '%$Titulo%'";
	}

	if ($where)
		$sql .= " where $where";

	$sql .= " order by Descripcion";

	$rs = mysql_query($sql);

	$titulos = array("Descripci&oacute;n", "Visitas");

	SesionPone("CategoriaEnlace", PaginaActual());

	include('Inicio.inc.php');
?>

<center>

<p>
<a href="CategoriaActualiza.php?IdPadre=<? echo $IdPadre; ?>">Nueva Categoria...</a>
<p>

<?		
function MuestraRegistro($reg) {
	FilaInicio();
	DatoGenera(CategoriasEnlaces($reg["Id"]));
/*
	if ($reg["Estado"])
		DatoEnlaceGenera("(".$reg["Descripcion"].")", "Categoria.php?Id=".$reg["Id"]);
	else
		DatoEnlaceGenera($reg["Descripcion"], "Categoria.php?Id=".$reg["Id"]);
*/
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
