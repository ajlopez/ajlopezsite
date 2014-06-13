<?
    include_once('Settings.inc.php');

	include_once('Sesion.inc.php');
	include_once('Conexion.inc.php');
	include_once('Usuarios.inc.php');
	include_once('Paginas.inc.php');

	if (!UsuarioIdentificado())
		PaginaRedireccionar('UsuarioPaginaNo.php');

	$PaginaTitulo = 'Mis Contenidos';

	include('Inicio.inc.php');
?>

<center>
<table border=0 cellspacing=0 cellpadding=25 width="100%">
<tr>
<td valign="top">
<h2 align="center">Mis Cursos</h2>
<p>
Ingrese a los <a href="UsuarioCursos.php">cursos en lo que est&aacute; inscripto</a> o consulte nuestra
<a href="CursosMuestra.php">gu&iacute;a de cursos</a>.
</td>
<td valign="top">
<h2 align="center">Mis Favoritos</h2>
<p>
Pr&oacute;ximamente, podr&aacute; seleccionar sus <a href="UsuarioFavoritos.php">sitios favoritos</a> dentro de <a href="<?php echo PaginaPrincipal(); ?>">todocontenidos</a>.
</td>
</tr>
<tr>
<td valign="top">
<h2 align="center">Mis Datos</h2>
<p>
Actualice <a href="Usuario.php?Id=<?php echo UsuarioId(); ?>">sus datos</a> y <a href="UsuarioPreferencias.php">preferencias</a>.
</td>
<td valign="top">
<h2 align="center">Mis Puntos</h2>
<p>
Puede acumular <a href="UsuarioPuntos.php">puntos</a>, y canjearlos por descuentos en la inscripci&oacute;n a nuestros cursos.
</td>
</tr>
</table>
<center>
<?php
	include('Final.inc.php');
?>
