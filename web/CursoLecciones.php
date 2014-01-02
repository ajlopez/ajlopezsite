<?php
    include_once('Settings.inc.php');

	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Paginas.inc.php');
	include_once('Sesion.inc.php');
	include_once('Utiles.inc.php');
	include_once('Cursos.inc.php');
	include_once('Usuarios.inc.php');
	include_once('Eventos.inc.php');

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

	include('Inicio.inc.php');

	$rsLecciones = mysql_query("select * from lecciones where IdCurso = $Id and Orden>0 order by Orden");
?>

<center>

<p>

<p>
<a href="UsuarioCursos.php">Mis Cursos</a>
&nbsp;&nbsp;
<a href="CursoMuestra.php?Id=<?php echo $leccion->IdCurso; ?>">Este Curso</a>
</p>

<p>
Estas son las lecciones del cursos. Semana a semana se agregarán más lecciones. Ante cualquier duda sobre el temario, o tema,
puede preguntar por email a <a href='mailto:webmaster@todocontenidos.com'>webmaster@todocontenidos.com</a>
</p>

<?php
	while ($leccion=mysql_fetch_object($rsLecciones)) {
?>
<a href='CursoLeccion.php?Id=<?php echo $leccion->Id; ?>'>
<?php echo $leccion->Descripcion; ?>
</a>
<br>
<?php
	}
?>


</center>

<?php
	Desconectar();
	require('Final.inc.php');
?>

