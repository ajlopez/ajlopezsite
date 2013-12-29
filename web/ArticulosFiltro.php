<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Paginas.inc.php');
	include('Usuarios.inc.php');
	include('Sesion.inc.php');

	$PaginaTitulo = "Art&iacute;culos";

	AdministradorControla();

	Conectar();

	require('Inicio.inc.php');
?>
<center>

<p>
<form method=post action="Articulos.php">
<table cellspacing=1 cellpadding=2 class="Formulario">
<?
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

<?
	require('Final.inc.php');

	Desconectar();
?>




