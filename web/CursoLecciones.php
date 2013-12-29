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

	if (!isset($Id))
		PaginaSale();

	CursoUsuarioControla($Id);
	CursoHabilitadoControla($Id);

	EventoPagina();
	
	SesionPone('CursoEnlace',PaginaActual());

	$sql = "select Codigo, Descripcion, Detalle, IdCategoria,
		Objetivos, Requisitos, Modalidad, Plan, Material, Precio, Observaciones, Duracion, Inicio, ListaCorreo
		 from cursos where Id = $Id";		 
	$res = mysql_query($sql);
	list($Codigo,$Descripcion, $Detalle, $IdCategoria,
		$Objetivos, $Requisitos, $Modalidad, $Plan, $Material, $Precio, $Observaciones, $Duracion, $Inicio, $ListaCorreo)
		= mysql_fetch_row($res);
	mysql_free_result($res);
	$CatDescripcion = CursoCategoriaTraduce($IdCategoria);

	$PaginaTitulo = "Primeras Lecciones del Curso<br>$Descripcion";

	require('Inicio.inc.php');

	$rsLecciones = mysql_query("select * from lecciones where IdCurso = $Id and Orden>0 order by Orden");
?>

<center>

<p>

<p>
<a href="UsuarioCursos.php">Mis Cursos</a>
&nbsp;&nbsp;
<a href="CursoMuestra.php?Id=<? echo $leccion->IdCurso; ?>">Este Curso</a>
</p>

<p>
Estas son las lecciones del cursos. Semana a semana se agregarán más lecciones. Ante cualquier duda sobre el temario, o tema,
puede preguntar por email a <a href='mailto:webmaster@todocontenidos.com'>webmaster@todocontenidos.com</a>
</p>

<?
	while ($leccion=mysql_fetch_object($rsLecciones)) {
?>
<a href='CursoLeccion.php?Id=<? echo $leccion->Id; ?>'>
<? echo $leccion->Descripcion; ?>
</a>
<br>
<?
	}
?>


</center>

<?
	Desconectar();
	require('Final.inc.php');
?>

