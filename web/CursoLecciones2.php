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
<a href="CursosMuestra.php?IdCategoria=<? echo $IdCategoria; ?>">Otros Cursos</a>
&nbsp;
&nbsp;
<a href="CursoInscripcion.php?Id=<? echo $Id; ?>">Inscripción a este Curso</a>
<?
	if (UsuarioIdentificado() && CursoUsuarioEsAlumno($Id,UsuarioId())) {
?>
&nbsp;
&nbsp;
<a href="CursoLecciones.php?Id=<? echo $Id; ?>">Ingresa al Curso</a>
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

<h2>En Argentina, respetamos UN PESO = UN DOLAR</h2>

<p>
Debido a la situaci&oacute;n por la que atraviesa Argentina, <a href="http://www.todocontenidos.com/">todocontenidos.com</a>
ha decidido mantener la paridad <b>UN PESO es UN DOLAR</b> para el pago de los cursos arancelados online, durante el mes de Febrero de
2002. Esperemos poder seguir manteniendo la medida en el tiempo. Este tipo de cambio es solamente para los usuarios
que residan en Argentina.
</p>
<p>
Agradecemos a todos los usuarios inscriptos, la confianza depositada en nosotros.

</p>

<p>

<?
function ParrafoGenera($titulo,$texto) {
	if (!$texto)
		return;
	echo "<h2 align=left>$titulo</h2>\n";
	echo "<p align=left>\n$texto\n</p>\n";
}

//	ParrafoGenera("Descripci&oacute;n",$Descripcion);
//	ParrafoGenera("Categor&iacute;a", $CatDescripcion);
	ParrafoGenera("Detalle del Curso",NormalizaHtml($Detalle));
	ParrafoGenera("Objetivos",NormalizaHtml($Objetivos));
	ParrafoGenera("Requisitos",NormalizaHtml($Requisitos));
	ParrafoGenera("Modalidad",NormalizaHtml($Modalidad));
	ParrafoGenera("Plan de Estudio",NormalizaHtml($Plan));
	ParrafoGenera("Material Entregado",NormalizaHtml($Material));
	ParrafoGenera("Precio",NormalizaHtml($Precio));
	ParrafoGenera("Inicio",NormalizaHtml($Inicio));
	ParrafoGenera("Duraci&oacute;n",NormalizaHtml($Duracion));
	ParrafoGenera("Observaciones",NormalizaHtml($Observaciones));
?>
</table>


</center>

<?
	Desconectar();
	require('Final.inc.php');
?>

