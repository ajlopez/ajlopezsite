<?
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Sesion.inc.php');
	include('Validaciones.inc.php');
	include('Usuarios.inc.php');

	AdministradorControla();

	if (!$Descripcion)
		$mensaje .= "Debe ingresar Descripci&oacute;n<br>";

	if ($mensaje)
		ErrorMuestra($mensaje);	

	Conectar();

	if (isset($Id))
		$sql = "Update cursos Set ";
	else
		$sql = "Insert cursos Set ";

	$IdCategoria += 0;
	$ImportePrecio += 0;
	$ImporteMateriales += 0;

	$sql = $sql .  "
		Codigo = '$Codigo',
		Descripcion = '$Descripcion', 
		Detalle = '$Detalle',
		IdCategoria = $IdCategoria,
		Objetivos = '$Objetivos',
		Requisitos = '$Requisitos',
		Modalidad = '$Modalidad',
		Plan = '$Plan',
		Material = '$Material',
		Precio = '$Precio',
		ImportePrecio = $ImportePrecio,
		ImporteMateriales = $ImporteMateriales,
		Inscripcion = '$Inscripcion',
		Inicio = '$Inicio',
		Duracion = '$Duracion',
		ListaCorreo = '$ListaCorreo',
		Profesor = '$Profesor',
		EmailProfesor = '$EmailProfesor',
		Observaciones = '$Observaciones'
		";

	if (isset($Id))
		$sql = $sql . " where Id = $Id";

	mysql_query($sql);
	$id = mysql_insert_id();

	$CursoEnlace = SesionToma("CursoEnlace");
	SesionSaca("CursoEnlace");

	if (!$CursoEnlace)
		$CursoEnlace = "CursosCategorias.php";

	header("Location: $CursoEnlace");
	exit;
?>