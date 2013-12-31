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

	include('Inicio.inc.php');
?>

<center>

<p>

<p>
<a href="Cursos.php">Cursos</a>
&nbsp;
&nbsp;
<a href="CursoActualiza.php?Id=<?php echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="CursoMuestra.php?Id=<?php echo $Id; ?>">Muestra</a>
<?php
	if ($Estado) {
?>
&nbsp;
&nbsp;
<a href="CursoCambiaEstado.php?Id=<?php echo $Id; ?>&Estado=0">Habilita</a>
<?php
	} else {
?>
&nbsp;
&nbsp;
<a href="CursoCambiaEstado.php?Id=<?php echo $Id; ?>&Estado=1">Deshabilita</a>
<?php
	}
?>
&nbsp;
&nbsp;
<a href="CursoElimina.php?Id=<?php echo $Id; ?>">Elimina</a>
&nbsp;
&nbsp;
<a href="Lecciones.php?IdCurso=<?php echo $Id; ?>">Lecciones</a>
</p>
<p>

<table cellspacing=1 cellpadding=2 class="Formulario">
<?php
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

<?php
	Desconectar();
	include('Final.inc.php');
?>

