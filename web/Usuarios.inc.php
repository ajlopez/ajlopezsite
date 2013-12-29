<?php
if (__Usuarios_inc == 1)
	return;
define ('__Usuarios_inc', 1);

include_once($PaginaPrefijo.'Paginas.inc.php');
include_once($PaginaPrefijo.'Sesion.inc.php');
include_once($PaginaPrefijo.'Eventos.inc.php');
include_once($PaginaPrefijo.'Puntos.inc.php');

function UsuarioControla($enlace='') {
	global $PHP_SELF;
	global $HTTP_SERVER_VARS;

	$UsuarioId = SesionToma("UsuarioId");

	if (empty($UsuarioId)) {
		if (empty($enlace)) {
			$enlace = $PHP_SELF;
			if ($HTTP_SERVER_VARS["QUERY_STRING"])
				$enlace .= "?" . $HTTP_SERVER_VARS["QUERY_STRING"];
		}
		SesionPone("UsuarioEnlace", $enlace);
		header("Location: UsuarioIdentifica.php");
		exit;
	}
}

function UsuarioIdentificado() {
	if (SesionToma("UsuarioId"))
		return(true);
	return(false);	
}	

function UsuarioVerificado() {
	if (!UsuarioIdentificado())
		return false;
	if (SesionToma("UsuarioVerificado"))
		return true;
	return false;
}

function UsuarioId() {
	return(SesionToma("UsuarioId"));
}

function UsuarioCodigo() {
	return(SesionToma("UsuarioCodigo"));
}

function UsuarioContrasenia() {
	return(SesionToma("UsuarioContrasenia"));
}

function UsuarioNombre() {
	return(SesionToma("UsuarioNombre"));
}

function UsuarioApellido() {
	return(SesionToma("UsuarioApellido"));
}

function UsuarioSexo() {
	return(SesionToma("UsuarioSexo"));
}

function UsuarioIdPais() {
	return(SesionToma("UsuarioIdPais"));
}

function UsuarioEmail() {
	return(SesionToma("UsuarioEmail"));
}

function UsuarioEsArgentino() {
	if (UsuarioIdPais()==1)
		return true;
	return false;
}

function UsuarioNombreCompleto() {
	$Nombre = UsuarioNombre();
	$Apellido = UsuarioApellido();

	if (!$Nombre && !$Apellido)
		return UsuarioCodigo();

	return "$Nombre $Apellido";
}

function UsuarioSexoSufijo($palabra='') {
	if (UsuarioSexo()==2)
		return $palabra . 'a';
	else
		return $palabra . 'o';
}

function EsAdministrador() {
	return(SesionToma("UsuarioEsAdministrador"));
}

function EsUsuario() {
	if (!EsAdministrador())
		return true;
	return false;
}

function UsuarioRol() {
	if (EsAdministrador())
		return 'Administrador del Sistema';
	if (UsuarioIdentificado() && EsUsuario())
		return 'Usuario';
}

function AdministradorControla($enlace='') {
	UsuarioControla($enlace);

	if (!EsAdministrador())
		PaginaRedireccionar(PaginaPrincipal());
}

function UsuarioPuntos($id,$anteriores) {
	Conectar();
	$rs = mysql_query("select sum(Puntos) as TotalPuntos from puntos where IdUsuario = $id");
	if ($rs && mysql_num_rows($rs))
		list($puntos) = mysql_fetch_row($rs);
	else
		$puntos = 0;
	mysql_free_result($rs);
	Desconectar();
	return $puntos+$anteriores;
}

function UsuarioPuntosEx($id=0) {
	if (!$id)
		$id=UsuarioId();
	if (!$id)
		return 0;
	Conectar();
	$rs = mysql_query("select PuntosAnteriores from usuarios where Id = $id");
	list($anteriores) = mysql_fetch_row($rs);
	mysql_free_result($rs);
	$puntos = UsuarioPuntos($id,$anteriores);
	Desconectar();
	return $puntos;
}

function UsuarioIngreso($usuario) {
	Conectar();
	mysql_query("update usuarios set Ingresos = Ingresos + 1, FechaHoraUltimoIngreso = Now() where Id = " . $usuario->Id);
	SesionPone("UsuarioId", $usuario->Id);
	SesionPone("UsuarioCodigo", $usuario->Codigo);
	SesionPone("UsuarioNombre", $usuario->Nombre);
	SesionPone("UsuarioApellido", $usuario->Apellido);
	SesionPone("UsuarioEsAdministrador", $usuario->EsAdministrador);
	SesionPone("UsuarioSexo", $usuario->Sexo);
	SesionPone("UsuarioIdPais", $usuario->IdPais);
	SesionPone("UsuarioEmail", $usuario->Email);
	SesionPone("UsuarioVerificado", $usuario->Verificado);
	SesionPone("UsuarioPuntos", UsuarioPuntos($usuario->Id,$usuario->PuntosAnteriores));
	EventoIngreso();
	$fechaant = $usuario->FechaHoraUltimoIngreso;
	$rs = mysql_query("select FechaHoraUltimoIngreso from usuarios where Id = " . $usuario->Id);
	if ($rs)
		list($fechaact) = mysql_fetch_row($rs);
	mysql_free_result($rs);
	if (substr($fechaant,0,10) != substr($fechaact,0,10))
		PuntosIngreso();
	Desconectar();
}

function UsuarioTraduce($Id) {
	global $UsuariosTabla;

	if (!$Id)
		return '';

	if ($UsuariosTabla[$Id])
		return $UsuariosTabla[$Id];

	Conectar();

	$rs = mysql_query("select Codigo from usuarios where Id = $Id");

	if ($rs && mysql_num_rows($rs))
		list($Codigo) = mysql_fetch_row($rs);
	else
		$Codigo = $Id;

	mysql_free_result($rs);

	$UsuariosTabla[$Id] = $Codigo;

	Desconectar();

	return $Codigo;
}

?>