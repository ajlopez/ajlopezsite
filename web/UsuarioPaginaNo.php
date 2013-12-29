<?
	include('Sesion.inc.php');
	include('Conexion.inc.php');
	include('Usuarios.inc.php');
	include('Paginas.inc.php');

	$PaginaTitulo = 'Mis Contenidos';

	include('Inicio.inc.php');
?>

<p>
<a href="UsuarioActualiza.php">Registr&aacute;ndose</a> como usuario, tendr&aacute; acceso a
<b>Mis Contenidos</b>, su p&aacute;gina de control, desde donde podr&aacute; ingresar a sus
cursos, revisar los puntos ganados, anotar sus favoritos, y colaborar con nuestro sitio, acumulando puntos.

<p>
Si Ud. ya est&aacute; registrado, ingrese su c&oacute;digo y contrase&ntilde;a. Si no lo est&aacute;, puede
<a href="UsuarioActualiza.php">registrarse gratuitamente</a> en l&iacute;nea.

<?
	include('Final.inc.php');
?>
