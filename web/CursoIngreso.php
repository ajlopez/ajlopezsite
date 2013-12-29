<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');
	include('Utiles.inc.php');
	include('Cursos.inc.php');
	include('Usuarios.inc.php');
	include('Eventos.inc.php');

	Conectar();

	UsuarioControla();
	CursoUsuarioControla($Id);

	EventoPagina();
	
	SesionPone('CursoEnlace',PaginaActual());

	if (!isset($Id))
		PaginaSale();

	$sql = "select Codigo, Descripcion, Detalle, IdCategoria,
		Objetivos, Requisitos, Modalidad, Plan, Material, Precio, Observaciones, Duracion, Inicio, ListaCorreo
		 from cursos where Id = $Id";		 
	$res = mysql_query($sql);
	list($Codigo,$Descripcion, $Detalle, $IdCategoria,
		$Objetivos, $Requisitos, $Modalidad, $Plan, $Material, $Precio, $Observaciones, $Duracion, $Inicio, $ListaCorreo)
		= mysql_fetch_row($res);
	mysql_free_result($res);
	$CatDescripcion = CursoCategoriaTraduce($IdCategoria);

	$PaginaTitulo = "Curso<br>$Descripcion";

	require('Inicio.inc.php');
?>

<center>

<p>

<p>
<a href="UsuarioCursos.php">Mis Cursos</a>
<?
	if (CursoHabilitado($Id) && CursoUsuarioEsAlumno($Id,UsuarioId())) {
?>
&nbsp;
&nbsp;
<a href='CursoLecciones.php?Id=<? echo $Id; ?>'>Lecciones</a>
<?
	}
?>
<?
	if (EsAdministrador()) {
?>
&nbsp;
&nbsp;
<a href="Curso.php?Id=<? echo $Id; ?>">Administra</a>
<?
	}
?>
</p>
<p>

<?
function ParrafoGenera($titulo,$texto) {
	if (!$texto)
		return;
	echo "<h2 align=left>$titulo</h2>\n";
	echo "<p align=left>\n$texto\n</p>\n";
}

	if (!$Inicio)
		$Inicio = "El curso no ha comenzado";


	ParrafoGenera("Inicio", $Inicio);

//	ParrafoGenera("Descripci&oacute;n",$Descripcion);
//	ParrafoGenera("Categor&iacute;a", $CatDescripcion);
	ParrafoGenera("Detalle del Curso",NormalizaHtml($Detalle));
	ParrafoGenera("Objetivos",NormalizaHtml($Objetivos));
	ParrafoGenera("Requisitos",NormalizaHtml($Requisitos));
	ParrafoGenera("Modalidad",NormalizaHtml($Modalidad));
	ParrafoGenera("Plan de Estudio",NormalizaHtml($Plan));
	ParrafoGenera("Material Entregado",NormalizaHtml($Material));
	ParrafoGenera("Precio",NormalizaHtml($Precio));
	ParrafoGenera("Duraci&oacute;n",NormalizaHtml($Duracion));
	ParrafoGenera("Observaciones",NormalizaHtml($Observaciones));
?>
</table>


</center>

<?
	Desconectar();
	require('Final.inc.php');
?>

