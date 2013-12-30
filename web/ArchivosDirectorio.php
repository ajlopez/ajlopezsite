<?php
    include_once('Settings.inc.php');

	include_once('Usuarios.inc.php');
	include_once('Paginas.inc.php');

	Conectar();

	AdministradorControla('');

	if (!$dir)
		$dir='.';

	$PaginaTitulo = "Directorio $dir";

	include('Inicio.inc.php');
?>

<center>

<p>

<a href="ArchivoNuevo.php?dir=<?php echo $dir; ?>&padre=<?php echo $padre; ?>">Nuevo Archivo</a>
&nbsp;&nbsp;
<a href="ArchivoSube.php?dir=<?php echo $dir; ?>&padre=<?php echo $padre; ?>">Subir Archivo</a>

<p>

<table>

<?php
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
<?php
	if (is_dir($archivo)) {
		if ($archivo=='..')
			$archivocompleto=$padre;
		else if ($dir!='.')
			$archivocompleto=$dir.'/'.$archivo;
		else
			$archivocompleto=$archivo;
?>
   <td><a href="ArchivosDirectorio.php?dir=<?php echo $archivocompleto; ?>&padre=<?php echo $dir; ?>"><?php echo $archivo; ?></a></td>
<?php
	}
	else {
?>
   <td><a href="<?php echo $archivo; ?>"><?php echo $archivo; ?></a></td>
<?php
	}
?>
   <td><?php echo filesize($archivo); ?></td>
   <td><?php echo filetype($archivo); ?></td>
   <td><a href="ArchivoVer.php?archivo=<?php echo $archivo; ?>&dir=<?php echo $dir; ?>&padre=<?php echo $padre; ?>">Ver </a></td>
   <td><a href="ArchivoEditar.php?archivo=<?php echo $archivo; ?>&dir=<?php echo $dir; ?>&padre=<?php echo $padre; ?>">Editar </a></td>
   <td><a href="ArchivoEliminar.php?archivo=<?php echo $archivo; ?>&dir=<?php echo $dir; ?>&padre=<?php echo $padre; ?>">Eliminar </a></td>
<?php
	if ($IdCategoria) {
?>
   <td><a href="ArchivoBusquedaProcesa.php?Archivo=<?php echo $archivo; ?>&Graba=1&IdCategoria=<?php echo $IdCategoria; ?>">Importar </a></td>
<?php
	}
?>
</tr>
<?php
  }
?>
</table>

</center>

<?php
	Desconectar();
	include('Final.inc.php');
?>

