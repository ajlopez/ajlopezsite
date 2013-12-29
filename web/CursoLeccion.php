<?
	include('Usuarios.inc.php');
	include('Conexion.inc.php');
	include('Paginas.inc.php');
	include('Cursos.inc.php');
	include('Lecciones.inc.php');
	include('Eventos.inc.php');

	Conectar();

	SesionPone('LeccionEnlace',PaginaActual());

	UsuarioControla();

	if (!$Id)
		PaginaSalir();

	EventoPagina();

	$LeccionesVisitadas = SesionToma('LeccionesVisitadas');

	if (!$LeccionesVisitadas)
		$LeccionesVisitadas = array();

	if (!$LeccionesVisitadas[$Id]) {
		$LeccionesVisitadas[$Id]=1;
		SesionPone('LeccionesVisitadas',$LeccionesVisitadas);
		EventoVisitaLeccion($Id);
		LeccionVisita($Id);
	}

	$rs = mysql_query("select * from lecciones where Id = $Id");
	$leccion = mysql_fetch_object($rs);
	mysql_free_result($rs);

	$rs = mysql_query("select descripcion from cursos where Id = $leccion->IdCurso");
	list($CursoDescripcion) = mysql_fetch_row($rs);
	mysql_free_result($rs);

	CursoUsuarioControla($leccion->IdCurso);

	$PaginaTitulo = $leccion->Descripcion;
	$PaginaTituloInvisible = 1;

	$file = fopen($leccion->Archivo,"r");

	include('Inicio.inc.php');
	include('Formato.inc.php');
?>

<center>
<h1><? echo $CursoDescripcion; ?></h1>
<p>
<a href="UsuarioCursos.php">Mis Cursos</a>
&nbsp;&nbsp;
<a href="CursoMuestra.php?Id=<? echo $leccion->IdCurso; ?>">Este Curso</a>
&nbsp;&nbsp;
<a href="CursoLecciones.php?Id=<? echo $leccion->IdCurso; ?>">Lecciones</a>
&nbsp;&nbsp;
<?
	if ($leccion->IdAnterior) {
?>
<a href="CursoLeccion.php?Id=<? echo $leccion->IdAnterior; ?>">Anterior</a>
&nbsp;&nbsp;
<?
	}
?>
<?
	if ($leccion->IdSiguiente) {
?>
<a href="CursoLeccion.php?Id=<? echo $leccion->IdSiguiente; ?>">Siguiente</a>
&nbsp;&nbsp;
<?
	}
?>
</p>
</center>

<?
	ProcesaArchivo($file);

	fclose($file);
?>

<p>
<center>
<p>
<a href="UsuarioCursos.php">Mis Cursos</a>
&nbsp;&nbsp;
<a href="CursoMuestra.php?Id=<? echo $leccion->IdCurso; ?>">Este Curso</a>
&nbsp;&nbsp;
<a href="CursoLecciones.php?Id=<? echo $leccion->IdCurso; ?>">Lecciones</a>
&nbsp;&nbsp;
<?
	if ($leccion->IdAnterior) {
?>
<a href="CursoLeccion.php?Id=<? echo $leccion->IdAnterior; ?>">Anterior</a>
&nbsp;&nbsp;
<?
	}
?>
<?
	if ($leccion->IdSiguiente) {
?>
<a href="CursoLeccion.php?Id=<? echo $leccion->IdSiguiente; ?>">Siguiente</a>
&nbsp;&nbsp;
<?
	}
?>
</p>
</center>


<?
	include('Final.inc.php');
	Desconectar();
?>

