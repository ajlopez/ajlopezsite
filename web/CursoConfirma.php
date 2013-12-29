<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');
	include('Utiles.inc.php');
	include('Cursos.inc.php');
	include('Usuarios.inc.php');
	include('Puntos.inc.php');

	Conectar();

	if (!isset($Id))
		PaginaSalir();

	if (!UsuarioIdentificado())
		PaginaRedireccionar("CursoPreinscripcion.php?Id=$Id");
	
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

	$UsuarioId = UsuarioId();
	$PuntosAplica += 0;

	if ($PuntosAplica % 10)
		$PuntosAplica -= $PuntosAplica % 10;

	if ($ImportePrecio)
		$Estado = 0;
	else
		$Estado = 1;

	$Puntos = UsuarioPuntosEx();
	$MaximoPuntos = (integer) ($ImportePrecio * 1000 / 4);
	if ($Puntos<$MaximoPuntos)
		$MaximoPuntos = $Puntos;

	if ($PuntosAplica > $MaximoPuntos)
		ErrorMuestra("S&oacute;lo puede aplicar hasta $MaximoPuntos puntos");

	$PrecioFinal = $ImportePrecio - ($PuntosAplica/1000);

	mysql_query("insert usuarioscursos set IdUsuario = $UsuarioId, IdCurso = $Id, FechaHoraInscripcion = Now(), Estado=$Estado, PrecioOriginal = $ImportePrecio, Puntos = $PuntosAplica, Precio = $PrecioFinal");

	if ($PuntosAplica)
		PuntosCurso($PuntosAplica);

	require('Inicio.inc.php');
?>

<center>

<p>

<p>
<a href="CursosMuestra.php?IdCategoria=<? echo $IdCategoria; ?>">Otros Cursos</a>
&nbsp;
&nbsp;
<a href="CursoMuestra.php?Id=<? echo $Id; ?>">Detalle del Curso</a>
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

<?
function ParrafoGenera($titulo,$texto) {
	echo "<h2 align=left>$titulo</h2>\n";
	echo "<p align=left>\n$texto\n</p>\n";
}

//	ParrafoGenera("Inscripción",NormalizaHtml($Inscripcion));
?>

<h2>Inscripci&oacute;n Realizada</h2>

<p>
<?
	echo UsuarioSexoSufijo("Estimad");
	echo ' ';
	echo UsuarioNombreCompleto();
?>
: su inscripci&oacute;n ha sido realizada. Muchas gracias por inscribirse en este curso. Esperamos que le sea de utilidad.
Cualquier duda o comentario, no dude en <a href="Contacto.php">contactarnos</a>.
</p>

<?
	if ($ImportePrecio>0) {
?>

<p>
El precio del curso es <b>$ <? echo $PrecioFinal; ?> usd (d&oacute;lares americanos)</b> o su equivalente en moneda local. Puede pagarlo
de las siguientes formas:
</p>
<?
	if (UsuarioEsArgentino()) {
?>

<p>
<b>Transferencia Bancaria</b>
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
<b>Dep&oacute;sito Bancario</b>
<br>
En sucursal de Banco Galicia, en cuenta caja de ahorro en pesos
<br>
<b>4000937-7 325-2</b>
<br>
Titular <b>Angel J Lopez</b>
</p>

<p>
<b>Giro Postal</b>
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
<b>Cheque</b>
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
<b>Transferencia Western Union</b>
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
<b>Transferencia Western Union</b>
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
?>

<p>
Una vez efectuado el pago, ingrese como usuario al sitio, y, desde su <a href="UsuarioPagina.php">P&aacute;gina Personal</a>,
complete los datos del mismo.
</p>

<?
	}
	else {
?>
<p>
El curso es completamente gratuito.
</p>

<?
	}
?>

</p>
<p>
</p>

<?
	Desconectar();
	require('Final.inc.php');
?>

