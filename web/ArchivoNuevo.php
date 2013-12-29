<?
	include('Usuarios.inc.php');
	include('Paginas.inc.php');

	Conectar();

	AdministradorControla('');

	$PaginaTitulo = "Edita $archivo";

	include('Inicio.inc.php');
?>

<center>
<p>
<a href='ArchivosDirectorio.php?dir=<? echo $dir; ?>&padre=<? echo $padre; ?>'>Directorio</a>
&nbsp;&nbsp;
<a href='ArchivoVer.php?archivo=<? echo $archivo; ?>&dir=<? echo $dir; ?>&padre=<? echo $padre; ?>'>Ver</a>
</p>

<form method="post" action="ArchivoGrabar.php">
Nombre del archivo
<input type="text" name="archivo" value="<? echo $archivo; ?>">
<br>
<textarea name="contenido" cols="80" rows="30">
</textarea>
<br>
<input type="submit" value="grabar">
<input type="hidden" name="dir" value="<? echo $dir; ?>">
<input type="hidden" name="padre" value="<? echo $padre; ?>">
</form>

</center>

<?
	Desconectar();
	include('Final.inc.php');
?>

