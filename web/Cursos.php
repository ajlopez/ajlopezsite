<?php
    include_once('Settings.inc.php');

	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Paginas.inc.php');
	include_once('Sesion.inc.php');
	include_once('Eventos.inc.php');
	include_once('Cursos.inc.php');

	$PaginaTitulo = "Cursos";

	Conectar();

	EventoPagina();

	$sql = "select * from cursos order by Codigo";
	$rs = mysql_query($sql);

	$titulos = array("C&oacute;digo","Descripci&oacute;n","Precio","Estado", "Alumnos");

	SesionPone("CursoEnlace", PaginaActual());

	include('Inicio.inc.php');
?>

<center>

<p>
<a href="CursoActualiza.php">Nuevo Curso...</a>
<p>

<?php		
function MuestraRegistro($reg) {
	FilaInicio();
	DatoEnlaceGenera($reg["Codigo"], "Curso.php?Id=".$reg["Id"]);
	DatoGenera($reg["Descripcion"]);
	DatoNumGenera($reg["ImportePrecio"]);
	DatoGenera(CursoEstadoTraduce($reg["Estado"]));

	$rsAlumnos = mysql_query("select count(*) from usuarioscursos where IdCurso = $reg[Id]");

	if ($rsAlumnos && mysql_num_rows($rsAlumnos))
		list($nAlumnos) = mysql_fetch_row($rsAlumnos);
	else
		$nAlumnos = '';

	mysql_free_result($rsAlumnos);

	DatoNumGenera($nAlumnos);

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
