<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');
	include('Utiles.inc.php');
	include('Cursos.inc.php');
	include('Usuarios.inc.php');

	Conectar();

	if (!isset($Id))
		PaginaSalir();

	if (!UsuarioIdentificado())
		PaginaSalir();
	
	$sql = "select Codigo, Descripcion, Detalle, ImportePrecio, ImporteMateriales
		 from cursos where Id = $Id";		 
	$res = mysql_query($sql);
	list($Codigo,$Descripcion, $Detalle, $ImportePrecio, $ImporteMateriales)
		= mysql_fetch_row($res);
	mysql_free_result($res);
	$CatDescripcion = CursoCategoriaTraduce($IdCategoria);

	$PaginaTitulo = "Pago por Transferencia Bancaria";

	$UsuarioId = UsuarioId();

	require('Inicio.inc.php');
?>

<center>

<p>

<p>
<a href="UsuarioCursos.php">Mis Cursos</a>
&nbsp;
&nbsp;
<a href="CursosMuestra.php">Gu&iacute;a de Cursos</a>
&nbsp;
&nbsp;
<a href="CursoMuestra.php?Id=<? echo $Id; ?>">Detalle del Curso</a>
</p>
<p>
Ingreso los datos de su pago por Transferencia Bancaria. Ante cualquier duda, no dude en <a href="Contacto.php">contactarnos</a>
</p>
<p>
Los campos marcados con <font color=red>*</font> son obligatorios
</p>
<p>
<form action="CursoPagoTransferenciaGraba.php" method="post">
<table cellspacing=1 cellpadding=2 class="Formulario">
<?
	$Fecha = date('Y-m-d');
	$Apellido = UsuarioApellido();
	$Nombre = UsuarioNombre();
	CampoEstaticoGenera("Curso<br>(si paga varios cursos, ind&iacute;quelo en Observaciones)",$Descripcion);
	CampoTextoGenera("Comprobante","CBU o cuenta del Remitente", $Comprobante, 12);
	CampoTextoGenera("Apellido","Apellido del Remitente",$Apellido,50);
	CampoTextoGenera("Nombre","Nombre del Remitente", $Nombre,50);
	CampoTextoGenera("Importe","Importe girado", $Importe, 10, true);
	CampoTextoGenera("Divisa", "Divisa empleada", $Divisa, 10, true);
	CampoFechaGenera("Fecha","Fecha de la Transferencia",$Fecha, true);
	CampoMemoGenera("Observaciones","Observaciones",$Observaciones,5,40);
	CampoAceptarGenera();
?>
</table>
<input type="hidden" name="IdCurso" value="<? echo $Id; ?>">
</form>

</center>

<?
	Desconectar();
	require('Final.inc.php');
?>

