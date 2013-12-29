<?
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Sesion.inc.php');
	include('Usuarios.inc.php');
	include('Validaciones.inc.php');
	include('Puntos.inc.php');

	if (!isset($Id) && !$Codigo)
		$mensaje .= "Debe ingresar Código<br>";

	if (!$Contrasenia)
		$mensaje .= "Debe ingresar Contraseña<br>";
	elseif ($Contrasenia != $Contrasenia2)
		$mensaje .= "No coinciden las Contraseñas ingresadas<br>";

	if (!FechaValida($FechaNacimientoAnio,$FechaNacimientoMes,$FechaNacimientoDia))
		$mensaje .= "Fecha de Nacimiento inválida<br>";
	else
		$FechaNacimiento = FechaSqlArma($FechaNacimientoAnio,$FechaNacimientoMes,$FechaNacimientoDia);

	if (!SexoValida($IdSexo))
		$mensaje .= "Debe ingresar Sexo<br>";

	if (!$Email)
		$mensaje .= "Debe ingresar Email<br>";

	if (!$IdPais)
		$mensaje .= "Debe ingresar Pais<br>";

	Conectar();

	$IdBus = $Id + 0;

	$rsUsuarios = mysql_query("select Codigo from usuarios where Codigo = '$Codigo' and Id <> $IdBus");
	if (mysql_num_rows($rsUsuarios))
		$mensaje .= "Código '$Codigo' ya existente";
	mysql_free_result($rsUsuarios);

	if ($mensaje) {
		Desconectar();
		ErrorMuestra($mensaje);
	}

	if (isset($Id))
		$sql = "Update usuarios Set FechaHoraModificacion = Now(),";
	else
		$sql = "Insert usuarios Set Codigo = '$Codigo', FechaHoraAlta = Now(), FechaHoraModificacion = Now(), FechaHoraUltimoIngreso = Now(), ";

	$EsAdministrador += 0;
	$IdPais += 0;
	$IdSexo += 0;

	$sql = $sql .  "
		Contrasenia = '$Contrasenia', 
		Nombre = '$Nombre',
		Apellido = '$Apellido',
		Email = '$Email',
		IdPais = $IdPais,
		Provincia = '$Provincia',
		Ciudad = '$Ciudad',
		CodigoPostal = '$CodigoPostal',
		FechaNacimiento = '$FechaNacimiento',
		IdSexo = $IdSexo";

	if (EsAdministrador()) 
		$sql .= ", EsAdministrador = $EsAdministrador";


	if (EsAdministrador() || !$Id)
		$sql .= ", NosConoce = '$NosConoce', Comentarios = '$Comentarios'";

	if (!isset($Id) && !EsAdministrador())
		$EsRegistracion=1;

	if ($EsRegistracion) {
		$IdReferente = SesionToma('ReferenteId');
		$IdAfiliado = SesionToma('AfiliadoId');

		if ($IdAfiliado)
			$IdReferente = $IdAfiliado;

		$IdReferente += 0;

		if ($IdReferente)
			$sql .= ", IdReferente = $IdReferente";
	}

	if (isset($Id))
		$sql = $sql . " where Id = $Id";


	mysql_query($sql);
	$Id = mysql_insert_id();

	if ($EsRegistracion) {
		$sql = "Select * from usuarios where Id = $Id";
		$res = mysql_query($sql);
		$usuario = mysql_fetch_object($res);
		mysql_free_result($res);

		UsuarioIngreso($usuario);
		EventoRegistracion();
		PuntosInscripcion();

		header("Location: UsuarioPreferenciasActualiza.php");
		exit;
	}

	$UsuarioEnlace = SesionToma("UsuarioEnlace");
	SesionSaca("UsuarioEnlace");
	$CursoActual = SesionToma("CursoActual");

	if ($CursoActual && !$UsuarioEnlace) {
		$UsuarioEnlace = "CursoInscripcion.php?Id=$CursoActual";
		SesionSaca("CursoActual");
	}

	if (!$UsuarioEnlace)
		if (EsAdministrador())
			$UsuarioEnlace = "Usuarios.php";
		else
			$UsuarioEnlace = PaginaPrincipal();

	header("Location: $UsuarioEnlace");
	exit;
?>