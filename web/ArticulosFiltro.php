<?php
    include_once('Settings.inc.php');

	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Paginas.inc.php');
	include_once('Usuarios.inc.php');
	include_once('Sesion.inc.php');

	$PaginaTitulo = "Art&iacute;culos";

	AdministradorControla();

	Conectar();

	include('Inicio.inc.php');
?>
<center>

<p>
<form method=post action="Articulos.php">
<table cellspacing=1 cellpadding=2 class="Formulario">
<?php
	CampoTextoGenera("Palabra","Palabra Clave",$Palabra,40);
	CampoTextoGenera("Titulo","T&iacute;tulo",$Titulo,40);
	CampoTextoGenera("Categoria","Categor&iacute;a",$Categoria,60);
	CampoAceptarGenera();
?>
</table>
<input type="hidden" name="Filtro" value="1">
</form>
</p>
</center>

<?php
	include('Final.inc.php');

	Desconectar();
?>




