<?php
    include_once('Settings.inc.php');

	include_once('Usuarios.inc.php');
	include_once('Paginas.inc.php');

	Conectar();

	AdministradorControla('');

	$PaginaTitulo = "Edita $archivo";

	include('Inicio.inc.php');
?>

<center>
<p>
<a href='ArchivosDirectorio.php?dir=<?php echo $dir; ?>&padre=<?php echo $padre; ?>'>Directorio</a>
&nbsp;&nbsp;
<a href='ArchivoVer.php?archivo=<?php echo $archivo; ?>&dir=<?php echo $dir; ?>&padre=<?php echo $padre; ?>'>Ver</a>
</p>

<form method="post" action="ArchivoGrabar.php">
Nombre del archivo
<input type="text" name="archivo" value="<?php echo $archivo; ?>">
<br>
<textarea name="contenido" cols="80" rows="30">
</textarea>
<br>
<input type="submit" value="grabar">
<input type="hidden" name="dir" value="<?php echo $dir; ?>">
<input type="hidden" name="padre" value="<?php echo $padre; ?>">
</form>

</center>

<?php
	Desconectar();
	include('Final.inc.php');
?>

