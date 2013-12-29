<?
	include('Usuarios.inc.php');

	AdministradorControla();

	if (copy($userfile,"$filename"))
		$PaginaTitulo = "Archivo $filename grabado";
	else
		$PaginaTitulo = "Error grabando archivo $filename";

	include('Inicio.inc.php');
?>
<center>
<p>
<a href='ArchivosDirectorio.php?dir=<? echo $dir; ?>&padre=<? echo $padre; ?>'>Directorio</a>
  
<a href='ArchivoVer.php?archivo=<? echo $archivo; ?>&dir=<? echo $dir; ?>&padre=<? echo $padre; ?>'>Ver</a>
</p>
</center>
<?
	include('Final.inc.php');
?>