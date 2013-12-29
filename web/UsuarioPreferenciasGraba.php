<?
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Sesion.inc.php');
	include('Usuarios.inc.php');
	include('Validaciones.inc.php');
	include('Puntos.inc.php');

	if (!UsuarioIdentificado())
		PaginaSalir();

	if (!isset($IdUsuario))
		$IdUsuario = UsuarioId();

	if ($IdUsuario!=UsuarioId() and !EsAdministrador())
		PaginaSalir();

	$Id = $Id+0;
	$Novedades = $Novedades+0;
	$Html = $Html+0;
	$Internet = $Internet+0;
	$Negocios = $Negocios+0;
	$Empleo = $Empleo+0;
	$Educacion = $Educacion+0;
	$Finanzas = $Finanzas+0;
	$Computacion = $Computacion+0;
	$Ciencia = $Ciencia+0;
	$Tecnologia = $Tecnologia+0;
	$Deportes = $Deportes+0;
	$Viajes = $Viajes+0;
	$Compras = $Compras+0;
	$Juegos = $Juegos+0;
	$Entretenimiento = $Entretenimiento+0;
	$Salud = $Salud+0;
	$Familia = $Familia+0;

	if ($Id)
		$sql = "Update preferencias set ";
	else
		$sql = "Insert preferencias set IdUsuario = $IdUsuario, ";

	$sql .= "
		Novedades = $Novedades,
		Html = $Html,
		Internet = $Internet,
		Negocios = $Negocios,
		Empleo = $Empleo,
		Educacion = $Educacion,
		Finanzas = $Finanzas,
		Computacion = $Computacion,
		Ciencia = $Ciencia,
		Tecnologia = $Tecnologia,
		Deportes = $Deportes,
		Viajes = $Viajes,
		Compras = $Compras,
		Juegos = $Juegos,
		Entretenimiento = $Entretenimiento,
		Salud = $Salud,
		Familia = $Familia";

	if ($Id)
		$sql .= " where Id = $Id and IdUsuario = $IdUsuario";
	
	Conectar();

	mysql_query($sql);

//	echo "Curso Actual " . SesionToma("CursoActual") . "<br>";
//	echo "Usuario Enlace " . SesionToma("UsuarioEnlace") . "<br>";

	$UsuarioEnlace = SesionToma("UsuarioEnlace");
	SesionSaca("UsuarioEnlace");
	$CursoActual = SesionToma("CursoActual");

	if ($CursoActual && !$UsuarioEnlace) {
		$UsuarioEnlace = "CursoInscripcion.php?Id=$CursoActual";
		SesionSaca("CursoActual");
	}

	if ($UsuarioEnlace)
		$PreferenciasEnlace = $UsuarioEnlace;
	else {
		$PreferenciasEnlace = SesionToma("PreferenciasEnlace");
		SesionSaca("PreferenciasEnlace");
	}

	if (!$PreferenciasEnlace)
		if (EsAdministrador())
			$PreferenciasEnlace = "Usuarios.php";
		else
			$PreferenciasEnlace = "UsuarioPagina.php";
	
	Desconectar();

	header("Location: $PreferenciasEnlace");
	exit;
?>