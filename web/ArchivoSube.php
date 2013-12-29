<?
	include('Usuarios.inc.php');

	$PaginaTitulo = 'Sube Archivo';

	AdministradorControla();

	include('Inicio.inc.php');
?>
<center>
<p>
<form action="ArchivoSubeGraba.php" METHOD=POST ENCTYPE="multipart/form-data">
	Enviar este archivo: <input type=FILE name="userfile"><br>
	Grabar con nombre: <input type=text size=40 name="filename"><br>
	<input type="submit" value="Enviar">
</form>
</p>
</center>
<?
	include('Final.inc.php');
?>
