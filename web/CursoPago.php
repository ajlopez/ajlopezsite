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
		PaginaSalir();

	$IdUsuario = UsuarioId();
	
	$sql = "select Codigo, Descripcion, Detalle, ImportePrecio, ImporteMateriales
		 from cursos where Id = $Id";		 
	$res = mysql_query($sql);
	list($Codigo,$Descripcion, $Detalle, $ImportePrecio, $ImporteMateriales)
		= mysql_fetch_row($res);
	mysql_free_result($res);

	$sql = "select Precio from usuarioscursos where IdCurso = $Id and IdUsuario = $IdUsuario";
	$res = mysql_query($sql);
	list($PrecioCurso) = mysql_fetch_row($res);
	mysql_free_result($res);

	$CatDescripcion = CursoCategoriaTraduce($IdCategoria);

	$PaginaTitulo = "Pago del Curso<br>$Descripcion";

	$UsuarioId = UsuarioId();

	include('Inicio.inc.php');
?>

<center>

<p>

<p>
<a href="UsuarioCursos.php">Mis Cursos</a>
&nbsp;
&nbsp;
<a href="CursosMuestra.php">Gu&iacute;a de Cursos</a>
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

<h2>Datos de su Pago</h2>

<p>
<?php
	echo UsuarioSexoSufijo("Estimad");
	echo ' ';
	echo UsuarioNombreCompleto();
?>
: puede ingresar los datos de su pago.
</p>

<?php
	if ($ImportePrecio>0) {
?>

<p>
El precio de su curso es <b>u$s <?php echo $PrecioCurso; ?> (d&oacute;lares americanos)</b> o su equivalente en moneda local. Elija su
forma de pago:
</p>
<?php
	if (UsuarioEsArgentino()) {
?>

<p>
<a href="CursoPagoTransferencia.php?Id=<?php echo $Id; ?>">Transferencia Bancaria</a>
<br>
Enviar al CBU (Banco Galicia)
<br>
<b>0070325130004000937723</b>
<br>
Titular <b>Angel J Lopez</b>
<br>
CUIT <b>20-16044509-3</b>
<br>
Tipo de cuenta <b>Caja de Ahorro en Pesos</b>
</p>

<p>
<a href="CursoPagoDeposito.php?Id=<?php echo $Id; ?>">Dep&oacute;sito Bancario</a>
<br>
En sucursal de Banco Galicia, en cuenta caja de ahorro en pesos
<br>
<b>4000937-7 325-2</b>
<br>
Titular <b>Angel J Lopez</b>
</p>

<p>
<a href="CursoPagoGiroPostal.php?Id=<?php echo $Id; ?>">Giro Postal</a>
<br>
A nombre de 
<br>
<b>Carolina Lucia Hauscarriaga</b>
<br>
Enviar a
<br>
<b>
Casilla de Correo 97
<br>
(1878) Quilmes
<br>
Argentina
</b>
</p>

<p>
<a href="CursoPagoCheque.php?Id=<?php echo $Id; ?>">Cheque</a>
<br>
A nombre de 
<br>
<b>Angel J. Lopez</b>
<br>
Enviar a
<br>
<b>
Casilla de Correo 97
<br>
(1878) Quilmes
<br>
Argentina
</b>
</p>

<p>
<a href="CursoPagoWestern.php?Id=<?php echo $Id; ?>">Western Union</a>
<br>
Enviar a
<br>
Nombre <b>Carolina Lucia</b>
<br>
Apellido <b>Hauscarriaga</b>
<br>
Ciudad <b>Buenos Aires</b>
<br>
Pais <b>Argentina</b>
<br>
Recuerde obtener su Money Transfer Control Number
</p>

<?
	}
	else {
?>
<p>
<a href="CursoPagoWestern.php?Id=<?php echo $Id; ?>">Western Union</a>
<br>
Enviar a
<br>
Nombre <b>Carolina Lucia</b>
<br>
Apellido <b>Hauscarriaga</b>
<br>
Ciudad <b>Buenos Aires</b>
<br>
Pais <b>Argentina</b>
<br>
Recuerde ingresar su Money Transfer Control Number
</p>
<?php
	}
?>

<p>
Una vez hayamos confirmado los datos del pago, quedar&aacute; habilitado para ingresar al curso.
</p>

<?php
	}
	else {
?>
<p>
El curso es completamente gratuito. Puede <a href="CursoIngreso.php?Id=<?php echo $Id; ?>">ingresar</a> al mismo.
</p>

<?php
	}
?>

</p>
<p>
</p>

<?php
	Desconectar();
	include('Final.inc.php');
?>

