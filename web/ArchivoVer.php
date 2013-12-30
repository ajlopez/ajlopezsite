<?php
    include_once('Settings.inc.php');

	include_once('Usuarios.inc.php');
	include_once('Paginas.inc.php');

	Conectar();

	AdministradorControla('');

	if (!$archivo)
		PaginaRedireccionar(PaginaPrincipal());

	$PaginaTitulo = "Archivo $archivo";

	include('Inicio.inc.php');
?>

<center>
<p>
<a href='ArchivosDirectorio.php?dir=<?php echo $dir; ?>&padre=<?php echo $padre; ?>'>Directorio</a>
&nbsp;&nbsp;
<a href='ArchivoEditar.php?archivo=<?php echo $archivo; ?>&dir=<?php echo $dir; ?>&padre=<?php echo $padre; ?>'>Editar</a>
</p>
</center>

<table>
<tr>
<td>
<?php
	$fp=fopen($archivo,"r"); 
	echo "<xmp align=left>";
	fpassthru($fp);
	echo "</xmp>";
?>
</td>
</tr>
</table>

<?php
	Desconectar();
	include('Final.inc.php');
?>

