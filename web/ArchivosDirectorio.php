<?
	include('Usuarios.inc.php');
	include('Paginas.inc.php');

	Conectar();

	AdministradorControla('');

	if (!$dir)
		$dir='.';

	$PaginaTitulo = "Directorio $dir";

	include('Inicio.inc.php');
?>

<center>

<p>

<a href="ArchivoNuevo.php?dir=<? echo $dir; ?>&padre=<? echo $padre; ?>">Nuevo Archivo</a>
&nbsp;&nbsp;
<a href="ArchivoSube.php?dir=<? echo $dir; ?>&padre=<? echo $padre; ?>">Subir Archivo</a>

<p>

<table>

<?
   $fd=opendir($dir);
   while ($archivo=readdir($fd)){
	if ($archivo == '.')
		continue;

	if ($archivo == '..') {
		if ($dir == '.')
			continue;
	}
	else if ($dir != '.')
		$archivo = $dir . '/' . $archivo;

	if(!is_file($archivo) && !is_dir($archivo))
	        continue;
?>
<tr>
<?
	if (is_dir($archivo)) {
		if ($archivo=='..')
			$archivocompleto=$padre;
		else if ($dir!='.')
			$archivocompleto=$dir.'/'.$archivo;
		else
			$archivocompleto=$archivo;
?>
   <td><a href="ArchivosDirectorio.php?dir=<? echo $archivocompleto; ?>&padre=<? echo $dir; ?>"><? echo $archivo; ?></a></td>
<?
	}
	else {
?>
   <td><a href="<? echo $archivo; ?>"><? echo $archivo; ?></a></td>
<?
	}
?>
   <td><? echo filesize($archivo); ?></td>
   <td><? echo filetype($archivo); ?></td>
   <td><a href="ArchivoVer.php?archivo=<? echo $archivo; ?>&dir=<? echo $dir; ?>&padre=<? echo $padre; ?>">Ver </a></td>
   <td><a href="ArchivoEditar.php?archivo=<? echo $archivo; ?>&dir=<? echo $dir; ?>&padre=<? echo $padre; ?>">Editar </a></td>
   <td><a href="ArchivoEliminar.php?archivo=<? echo $archivo; ?>&dir=<? echo $dir; ?>&padre=<? echo $padre; ?>">Eliminar </a></td>
<?
	if ($IdCategoria) {
?>
   <td><a href="ArchivoBusquedaProcesa.php?Archivo=<? echo $archivo; ?>&Graba=1&IdCategoria=<? echo $IdCategoria; ?>">Importar </a></td>
<?
	}
?>
</tr>
<?
  }
?>
</table>

</center>

<?
	Desconectar();
	include('Final.inc.php');
?>

