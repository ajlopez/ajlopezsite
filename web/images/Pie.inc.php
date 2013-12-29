<?
	include($PaginaPrefijo.'Paginas.inc.php');
	include($PaginaPrefijo.'Usuarios.inc.php');
?>
<p>&nbsp;</p>


<p align="center" class="Pie">
<?
function GeneraOpcionPie($texto,$enlace) {
	global $PaginaPrefijo;
?>
<a href="<? echo $PaginaPrefijo.$enlace; ?>"><? echo $texto; ?></a>
&nbsp;&nbsp;
<?
}

	GeneraOpcionPie("Principal", PaginaPrincipal());
	GeneraOpcionPie("Temas", "Temas.php");
	GeneraOpcionPie("Proyectos", "Proyectos.php");
//	GeneraOpcionPie("Productos", "Productos.php");
//	GeneraOpcionPie("Servicios", "Servicios.php");

/*
	if (!UsuarioIdentificado()) {
		GeneraOpcionPie("Ingrese", "UsuarioIdentifica.php");
		GeneraOpcionPie("Registrarse", "UsuarioActualiza.php");
		GeneraOpcionPie("Mis Contenidos", "UsuarioPaginaNo.php");
	}
*/

	if (UsuarioIdentificado()) {
		GeneraOpcionPie("Mi P&aacute;gina", "UsuarioPagina.php");
		if (EsAdministrador())
			GeneraOpcionPie("Administraci&oacute;n", "Administrador.php");
		GeneraOpcionPie("Salir", "UsuarioSalir.php");
	}
	echo "<br>";
	GeneraOpcionPie("Cont&aacute;ctenos", "Contacto.php");
?>

</p>
<br>
<br>

