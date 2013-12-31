<?php
    include_once('Settings.inc.php');
    
	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Paginas.inc.php');
	include_once('Sesion.inc.php');
	include_once('Usuarios.inc.php');
	include_once('Categorias.inc.php');

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
<a href="CategoriaActualiza.php?IdPadre=<?php echo $IdPadre; ?>">Nueva Categoria...</a>
<p>

<?php
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

<?php
	Desconectar();
	include('Final.inc.php');
?>
