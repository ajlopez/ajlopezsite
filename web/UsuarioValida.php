<?
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Usuarios.inc.php');

	if (empty($Codigo))
		ErrorMuestra('Debe ingresar Código');

	if (empty($Contrasenia))
		ErrorMuestra('Debe ingresar Contraseña');

	Conectar();

	include('Sesion.inc.php');

	$sql = "Select * from usuarios where Codigo = '$Codigo'";
	$res = mysql_query($sql);

	if (!$res || mysql_num_rows($res)==0) {
		Desconectar();
		ErrorMuestra('Usuario inexistente');
	}

	$usuario = mysql_fetch_object($res);
	mysql_free_result($res);

	if ($usuario->Contrasenia != $Contrasenia) {
		Desconectar();
		ErrorMuestra('Contraseña incorrecta');
	}

	UsuarioIngreso($usuario);

	Desconectar();

	$UsuarioEnlace = SesionToma("UsuarioEnlace");
	SesionSaca("UsuarioEnlace");
	$CursoActual = SesionToma("CursoActual");

	if ($CursoActual && !$UsuarioEnlace) {
		$UsuarioEnlace = "CursoInscripcion.php?Id=$CursoActual";
		SesionSaca("CursoActual");
	}

	if (!$UsuarioEnlace)
		$UsuarioEnlace = "UsuarioPagina.php";

	header("Location: $UsuarioEnlace");
	exit;
?>