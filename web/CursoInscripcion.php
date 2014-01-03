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

	if (!UsuarioIdentificado())
		PaginaRedireccionar("CursoPreinscripcion.php?Id=$Id");

	$IdUsuario = UsuarioId();

	$rsCurso = mysql_query("select Id from usuarioscursos where IdCurso = $Id and IdUsuario = $IdUsuario");
	if (mysql_num_rows($rsCurso)) {
		mysql_free_result($rsCurso);
		ErrorMuestra("Ya est&aacute; inscripto en el curso");
	}
	mysql_free_result($rsCurso);
	
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

	$puntos = UsuarioPuntosEx();

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


</center>

<p>

<?php
function ParrafoGenera($titulo,$texto) {
	echo "<h2 align=left>$titulo</h2>\n";
	echo "<p align=left>\n$texto\n</p>\n";
}

//	ParrafoGenera("Inscripción",NormalizaHtml($Inscripcion));
?>

<h2>Inscripci&oacute;n</h2>

<p>
<?php
	echo UsuarioSexoSufijo("Estimad");
	echo ' ';
	echo UsuarioNombreCompleto();
?>
: si desea inscribirse en este curso, por favor, confirme la operaci&oacute;n con el bot&oacute;n de m&aacute;s abajo. Si tiene alguna
duda sobre los requisitos, objetivos y temario del mismo, consulte el <a href="CursoMuestra.php?Id=<?php echo $Id; ?>">detalle del curso</a>.
</p>

<?php
	if ($ImportePrecio>0) {
?>

<p>
El precio del curso es <b>$ <?php echo $ImportePrecio; ?> usd (d&oacute;lares americanos)</b> o su equivalente en moneda local. Puede pagarlo
de las siguientes formas:
</p>
<?php
	if (UsuarioEsArgentino()) {
?>

<p>
<b>Transferencia Bancaria</b>
</p>
<p>
<b>Dep&oacute;sito Bancario</b> (sucursales del Banco Galicia)
</p>
<p>
<b>Giro Postal</b>
</p>
<p>
<b>Cheque</b>
</p>
<p>
<b>Transferencia Western Union</b>
</p>
<?php
	}
	else {
?>
<p>
<b>Transferencia Western Union</b>
</p>
<?php
	}
?>


<p>
En la pr&oacute;xima p&aacute;gina, al confirmar la inscripci&oacute;n al curso, obtendr&aacute; los datos para realizar
el pago.
</p>
<p>
Una vez efectuado el pago, ingrese como usuario al sitio, y, desde su <a href="UsuarioPagina.php">P&aacute;gina Personal</a>,
complete los datos del mismo.
</p>
<?php
	if ($puntos) {
		$maxpuntos = (integer) ($ImportePrecio * 1000 / 4);
?>
<p>Ud. tiene <b><?php echo $puntos; ?> puntos</b> a su favor. Puede aplicar hasta <b><?php echo $maxpuntos; ?> puntos</b>
(u$s 1 los 1000 puntos) como descuento al precio del curso (hasta 25% del precio).
<?php
	}
?>

<?php
	}
	else {
?>
<p>
El curso es completamente gratuito.
</p>

<?php
	}
?>

<center>
<form action="CursoConfirma.php" method="post">
<input type="hidden" name="Id" value="<?php echo $Id; ?>">
<?php
	if ($puntos) {
		$puntosaplica = $maxpuntos;
		if ($puntosaplica > $puntos)
			$puntosaplica = $puntos;
?>
<p>
Puntos a aplicar (hasta <?php echo $puntosaplica; ?>) &nbsp;&nbsp;&nbsp;<input type="text" name="PuntosAplica" value="<?php echo $puntosaplica; ?>" size=10>
</p>
<?php
	}
?>
<input type="Submit" value="Confirme la inscripci&oacute;n al curso">
</form>
</center>

</p>
<p>
</p>

<?php
	Desconectar();
	require('Final.inc.php');
?>

