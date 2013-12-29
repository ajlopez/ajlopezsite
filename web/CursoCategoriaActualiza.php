<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Usuarios.inc.php');
	include('Paginas.inc.php');

	Conectar();
	
	if (isset($Id)) {
		$sql = "select * from cursoscategorias where Id = $Id"; 
		$rs = mysql_query($sql);
		$reg = mysql_fetch_object($rs);
		$Descripcion = $reg->Descripcion;
		$Detalle = $reg->Detalle;
		mysql_free_result($rs);
		$PaginaTitulo = "Actualiza Categor&iacute;a de Curso";
		$EsNuevo = 0;
	}	
	else {
		$PaginaTitulo = "Nueva Categor&iacute;a de Curso";
		$EsNuevo = 1;
	}

	require('Inicio.inc.php');
?>

<center>

<p>
<a href="CursosCategorias.php">Categor&iacute;as de Cursos</a>

<?
	if (!$EsNuevo) {
?>
&nbsp;
&nbsp;
<a href="CursoCategoria.php?Id=<? echo $Id; ?>">Categor&iacute;a</a>
&nbsp;
&nbsp;
<a href="CursoCategoriaElimina.php?Id=<? echo $Id; ?>">Elimina</a>
<?
	}
?>
</p>

<p>

<form action="CursoCategoriaGraba.php" method=post>

<table class="Formulario" width="80%">
<?
	if (!$EsNuevo)
		CampoEstaticoGenera("Id",$Id);
	CampoTextoGenera("Descripcion","Descripci&oacute;n",$Descripcion,50);
	CampoMemoGenera("Detalle","Detalle",$Detalle,10,50);

	CampoAceptarGenera();
?>
</table>

<?
	if (!$EsNuevo)
		IdGenera($Id);
?>
</form>

</center>

<?
	Desconectar();
	require('Final.inc.php');
?>

