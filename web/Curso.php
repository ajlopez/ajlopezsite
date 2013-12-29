<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');
	include('Utiles.inc.php');
	include('Cursos.inc.php');
	include('Usuarios.inc.php');

	AdministradorControla();

	Conectar();
	
	SesionPone('CursoEnlace',PaginaActual());

	if (!isset($Id))
		PaginaSale();

	$sql = "select Codigo, Descripcion, Detalle, IdCategoria,
		Objetivos, Requisitos, Modalidad, Plan, Material, Precio, Observaciones, ImportePrecio, ImporteMateriales, Inscripcion, Inicio, Duracion, Estado, ListaCorreo, Profesor, EmailProfesor
		 from cursos where Id = $Id";		 
	$res = mysql_query($sql);
	list($Codigo,$Descripcion, $Detalle, $IdCategoria,
		$Objetivos, $Requisitos, $Modalidad, $Plan, $Material, $Precio, $Observaciones, $ImportePrecio, $ImporteMateriales, $Inscripcion, $Inicio, $Duracion, $Estado, $ListaCorreo, $Profesor, $EmailProfesor)
		= mysql_fetch_row($res);
	mysql_free_result($res);
	$CatDescripcion = CursoCategoriaTraduce($IdCategoria);

	$PaginaTitulo = "Curso: $Descripcion";

	require('Inicio.inc.php');
?>

<center>

<p>

<p>
<a href="Cursos.php">Cursos</a>
&nbsp;
&nbsp;
<a href="CursoActualiza.php?Id=<? echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="CursoMuestra.php?Id=<? echo $Id; ?>">Muestra</a>
<?
	if ($Estado) {
?>
&nbsp;
&nbsp;
<a href="CursoCambiaEstado.php?Id=<? echo $Id; ?>&Estado=0">Habilita</a>
<?
	} else {
?>
&nbsp;
&nbsp;
<a href="CursoCambiaEstado.php?Id=<? echo $Id; ?>&Estado=1">Deshabilita</a>
<?
	}
?>
&nbsp;
&nbsp;
<a href="CursoElimina.php?Id=<? echo $Id; ?>">Elimina</a>
&nbsp;
&nbsp;
<a href="Lecciones.php?IdCurso=<? echo $Id; ?>">Lecciones</a>
</p>
<p>

<table cellspacing=1 cellpadding=2 class="Formulario">
<?
	CampoEstaticoGenera("Id",$Id);
	CampoEstaticoGenera("Descripci&oacute;n",$Descripcion);
	CampoEstaticoGenera("Categor&iacute;a", $CatDescripcion);
	CampoEstaticoGenera("Detalle",NormalizaHtml($Detalle));
	CampoEstaticoGenera("Objetivos",NormalizaHtml($Objetivos));
	CampoEstaticoGenera("Requisitos",NormalizaHtml($Requisitos));
	CampoEstaticoGenera("Modalidad",NormalizaHtml($Modalidad));
	CampoEstaticoGenera("Plan de Estudio",NormalizaHtml($Plan));
	CampoEstaticoGenera("Material Entregado",NormalizaHtml($Material));
	CampoEstaticoGenera("Precio",NormalizaHtml($Precio));
	CampoEstaticoGenera("Importe Precio", $ImportePrecio);
	CampoEstaticoGenera("Importe Materiales", $ImporteMateriales);
	CampoEstaticoGenera("Inscripción", NormalizaHtml($Inscripcion));
	CampoEstaticoGenera("Inicio", NormalizaHtml($Inicio));
	CampoEstaticoGenera("Duración", NormalizaHtml($Duracion));
	CampoEstaticoGenera("Lista de Correo", $ListaCorreo);
	CampoEstaticoGenera("Profesor", NormalizaHtml($Profesor));
	CampoEstaticoGenera("Email Profesor", $EmailProfesor);
	CampoEstaticoGenera("Observaciones",NormalizaHtml($Observaciones));
	CampoEstaticoGenera("Estado", CursoEstadoTraduce($Estado));
?>
</table>


</center>

<?
	Desconectar();
	require('Final.inc.php');
?>

