<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');

	$PaginaTitulo = "Categor&iacute;as de Cursos";

	Conectar();

	$sql = "select * from cursoscategorias order by Descripcion";
	$rs = mysql_query($sql);

	$titulos = array("Descripci&oacute;n");

	SesionPone("CursoCategoriaEnlace", PaginaActual());

	include('Inicio.inc.php');
?>

<center>

<p>
<a href="CursoCategoriaActualiza.php">Nueva Categoria...</a>
<p>

<?		
function MuestraRegistro($reg) {
	FilaInicio();
	DatoEnlaceGenera($reg["Descripcion"], "CursoCategoria.php?Id=".$reg["Id"]);
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
