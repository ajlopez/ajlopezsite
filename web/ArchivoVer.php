<?
	include('Usuarios.inc.php');
	include('Paginas.inc.php');

	Conectar();

	AdministradorControla('');

	if (!$archivo)
		PaginaRedireccionar(PaginaPrincipal());

	$PaginaTitulo = "Archivo $archivo";

	include('Inicio.inc.php');
?>

<center>
<p>
<a href='ArchivosDirectorio.php?dir=<? echo $dir; ?>&padre=<? echo $padre; ?>'>Directorio</a>
&nbsp;&nbsp;
<a href='ArchivoEditar.php?archivo=<? echo $archivo; ?>&dir=<? echo $dir; ?>&padre=<? echo $padre; ?>'>Editar</a>
</p>
</center>

<table>
<tr>
<td>
<?
	$fp=fopen($archivo,"r"); 
	echo "<xmp align=left>";
	fpassthru($fp);
	echo "</xmp>";
?>
</td>
</tr>
</table>


<?
	Desconectar();
	include('Final.inc.php');
?>

