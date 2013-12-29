<?
	include('Usuarios.inc.php');
	include('Paginas.inc.php');

	Conectar();

	AdministradorControla('');

	if (!$archivo)
		PaginaRedireccionar(PaginaPrincipal());

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
<textarea name="contenido" cols="80" rows="30">
<?
	$fp=fopen($archivo,"r");
	fpassthru($fp);
?>
</textarea>
<br>
<input type="submit" value="grabar">
<input type="hidden" name="archivo" value="<? echo $archivo; ?>">
<input type="hidden" name="dir" value="<? echo $dir; ?>">
<input type="hidden" name="padre" value="<? echo $padre; ?>">
</form>

</center>

<?
	Desconectar();
	include('Final.inc.php');
?>

