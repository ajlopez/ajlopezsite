<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Usuarios.inc.php');
	include('Paginas.inc.php');

	AdministradorControla();

	Conectar();
	
	if (isset($Id)) {
		$sql = "select * from cursos where Id = $Id"; 
		$rs = mysql_query($sql);
		$reg = mysql_fetch_object($rs);
		$Codigo = $reg->Codigo;
		$Descripcion = $reg->Descripcion;
		$Detalle = $reg->Detalle;
		$IdCategoria = $reg->IdCategoria;
		$Objetivos = $reg->Objetivos;
		$Requisitos = $reg->Requisitos;
		$Modalidad = $reg->Modalidad;
		$Plan = $reg->Plan;
		$Material = $reg->Material;
		$Precio = $reg->Precio;
		$Observaciones = $reg->Observaciones;
		$ImportePrecio = $reg->ImportePrecio;
		$ImporteMateriales = $reg->ImporteMateriales;
		$Inscripcion = $reg->Inscripcion;
		$Inicio = $reg->Inicio;
		$Duracion = $reg->Duracion;
		$ListaCorreo = $reg->ListaCorreo;
		$Profesor = $reg->Profesor;
		$EmailProfesor = $reg->EmailProfesor;
		$EsNuevo = 0;
		$PaginaTitulo = "Actualiza Curso";
		mysql_free_result($rs);
	}	
	else {
		$PaginaTitulo = "Nuevo Curso";
		$EsNuevo = 1;
	}

	$rsCategorias = mysql_query("select id, descripcion from cursoscategorias order by Descripcion");

	require('Inicio.inc.php');
?>

<center>

<p>
<a href="Cursos.php">Cursos</a>

<?
	if (!$EsNuevo) {
?>
&nbsp;
&nbsp;
<a href="Curso.php?Id=<? echo $Id; ?>">Curso</a>
&nbsp;
&nbsp;
<a href="CursoMuestra.php?Id=<? echo $Id; ?>">Muestra</a>
&nbsp;
&nbsp;
<a href="CursoElimina.php?Id=<? echo $Id; ?>">Elimina</a>
<?
	}
?>
</p>

<p>

<form action="CursoGraba.php" method=post>

<table cellspacing=1 cellpadding=2 class="Formulario">
<?
	if (!$EsNuevo)
		CampoEstaticoGenera("Id",$Id);
	CampoTextoGenera("Codigo","C&oacute;digo",$Codigo,16);
	CampoTextoGenera("Descripcion","Descripci&oacute;n",$Descripcion,50);
	CampoComboRsGenera("IdCategoria","Categor&iacute;a",$rsCategorias,$IdCategoria);
	CampoMemoGenera("Detalle","Detalle",$Detalle,10,50);
	CampoMemoGenera("Objetivos","Objetivos",$Objetivos,10,50);
	CampoMemoGenera("Requisitos","Requisitos Previos",$Requisitos,10,50);
	CampoMemoGenera("Modalidad","Modalidad de Estudio",$Modalidad,10,50);
	CampoMemoGenera("Plan","Plan de Estudio",$Plan,30,50);
	CampoMemoGenera("Material","Material a Entregar",$Material,10,50);
	CampoMemoGenera("Precio","Precio del Curso",$Precio,3,50);
	CampoTextoGenera("ImportePrecio", "Importe Precio", $ImportePrecio,10);
	CampoTextoGenera("ImporteMateriales", "Importe Materiales", $ImporteMateriales, 10);
	CampoMemoGenera("Inscripcion", "Inscripción", $Inscripcion, 10, 50);
	CampoMemoGenera("Inicio", "Inicio", $Inicio, 10, 50);
	CampoMemoGenera("Duracion", "Duración", $Duracion, 10, 50);
	CampoTextoGenera("ListaCorreo", "Lista de Correo", $ListaCorreo, 20);
	CampoMemoGenera("Profesor", "Profesor", $Profesor, 3, 50);
	CampoTextoGenera("EmailProfesor", "Email del Profesor", $EmailProfesor, 50);
	CampoMemoGenera("Observaciones","Observaciones",$Observaciones,10,50);

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
	mysql_free_result($rsCategorias);
	Desconectar();
	require('Final.inc.php');
?>

