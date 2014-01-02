<?php
    include_once('Settings.inc.php');
    
	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Usuarios.inc.php');
	include_once('Paginas.inc.php');

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

	include('Inicio.inc.php');
?>

<center>

<p>
<a href="CursosCategorias.php">Categor&iacute;as de Cursos</a>

<?php
	if (!$EsNuevo) {
?>
&nbsp;
&nbsp;
<a href="CursoCategoria.php?Id=<?php echo $Id; ?>">Categor&iacute;a</a>
&nbsp;
&nbsp;
<a href="CursoCategoriaElimina.php?Id=<?php echo $Id; ?>">Elimina</a>
<?php
	}
?>
</p>

<p>

<form action="CursoCategoriaGraba.php" method=post>

<table class="Formulario" width="80%">
<?php
	if (!$EsNuevo)
		CampoEstaticoGenera("Id",$Id);
	CampoTextoGenera("Descripcion","Descripci&oacute;n",$Descripcion,50);
	CampoMemoGenera("Detalle","Detalle",$Detalle,10,50);

	CampoAceptarGenera();
?>
</table>

<?php
	if (!$EsNuevo)
		IdGenera($Id);
?>
</form>

</center>

<?php
	Desconectar();
	require('Final.inc.php');
?>

