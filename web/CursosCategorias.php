<?php
    include_once('Settings.inc.php');

	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Paginas.inc.php');
	include_once('Sesion.inc.php');

	$PaginaTitulo = "Categor&iacute;as de Cursos";

	Conectar();

	$sql = "select * from cursoscategorias order by Descripcion";
	$rs = mysql_query($sql);

	$titulos = array("Descripci&oacute;n");

	SesionPone("CursoCategoriaEnlace", PaginaActual());

	include_once('Inicio.inc.php');
?>

<center>

<p>
<a href="CursoCategoriaActualiza.php">Nueva Categoria...</a>
<p>

<?php
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

<?php
	Desconectar();
	include_once('Final.inc.php');
?>
