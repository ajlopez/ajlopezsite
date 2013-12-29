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
<a target='_top' href="<? echo $PaginaPrefijo.$enlace; ?>"><? echo $texto; ?></a>
&nbsp;&nbsp;
<?
}

	GeneraOpcionPie("Main", 'en/'.PaginaPrincipal());
	GeneraOpcionPie("Topics", "en/Topics.php");
	GeneraOpcionPie("Projects", "en/Projects.php");

	if (UsuarioIdentificado()) {
		GeneraOpcionPie("My Page", "en/UserPage.php");
		if (EsAdministrador())
			GeneraOpcionPie("Administration", "en/Administrator.php");
		GeneraOpcionPie("Logout", "en/Logout.php");
	}
	echo "<br>";
	GeneraOpcionPie("Cont&aacute;ct", "Contact.php");
?>

</p>
<br>
<br>

