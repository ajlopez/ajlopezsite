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

	Conectar();

	if (!isset($Id))
		PaginaSalir();

	SesionPone('CursoActual',$Id);

	$sql = "select Codigo, Descripcion, Detalle, IdCategoria,
		Objetivos, Requisitos, Modalidad, Plan, Material, Precio, Observaciones, Inscripcion, ImportePrecio, ImporteMateriales
		 from cursos where Id = $Id";		 
	$res = mysql_query($sql);
	list($Codigo,$Descripcion, $Detalle, $IdCategoria,
		$Objetivos, $Requisitos, $Modalidad, $Plan, $Material, $Precio, $Observaciones, $Inscripcion, $ImportePrecio, $ImporteMateriales)
		= mysql_fetch_row($res);
	mysql_free_result($res);
	$CatDescripcion = CursoCategoriaTraduce($IdCategoria);

	$PaginaTitulo = "Inscripci&oacute;n en el Curso<br>$Descripcion";

	include('Inicio.inc.php');
?>

<center>

<p>

<p>
<a href="CursosMuestra.php?IdCategoria=<?php echo $IdCategoria; ?>">Otros Cursos</a>
&nbsp;
&nbsp;
<a href="CursoMuestra.php?Id=<?php echo $Id; ?>">Detalle del Curso</a>
</p>

</center>

<p>

<?
function ParrafoGenera($titulo,$texto) {
	echo "<h2 align=left>$titulo</h2>\n";
	echo "<p align=left>\n$texto\n</p>\n";
}

//	ParrafoGenera("Inscripción",NormalizaHtml($Inscripcion));
?>

<h2>Inscripci&oacute;n</h2>

<p>
Para inscribirse a este curso, debe ser usuario registrado. Si lo es, ingrese <a href="UsuarioIdentifica.php">aqu&iacute;</a> su c&oacute;digo y contrase&ntilde;a.
Si no es usuario del sitio, puede <a href="UsuarioActualiza.php">registrarse aqu&iacute;</a>.
</p>

<?
	Desconectar();
	include('Final.inc.php');
?>

