<?php    include_once('Settings.inc.php');
	include_once('Usuarios.inc.php');
	AdministradorControla();
	if (copy($userfile,"$filename"))
		$PaginaTitulo = "Archivo $filename grabado";
	else
		$PaginaTitulo = "Error grabando archivo $filename";
	include('Inicio.inc.php');
?>
<center>
<p>
<a href='ArchivosDirectorio.php?dir=<?php echo $dir; ?>&padre=<?php echo $padre; ?>'>Directorio</a>
  
<a href='ArchivoVer.php?archivo=<?php echo $archivo; ?>&dir=<?php echo $dir; ?>&padre=<?php echo $padre; ?>'>Ver</a>
</p>
</center>
<?php
	include('Final.inc.php');
?>