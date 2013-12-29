<?
if (__Cursos_inc == 1)
	return;
define ('__Cursos_inc', 1);

	include('Usuarios.inc.php');

	define('CURSOS_ESTADO_NORMAL',0);
	define('CURSOS_ESTADO_DESHABILITADO',1);

	$CursosEstado = array(CURSOS_ESTADO_NORMAL => 'Normal',
		CURSOS_ESTADO_DESHABILITADO => 'Deshabilitado');

function CursoCategoriaTraduce($Id)
{
	if (!$Id)
		return '';

	Conectar();

	$rs = mysql_query("select Descripcion from cursoscategorias where Id=$Id");
	if ($rs && mysql_num_rows($rs)) {
		$reg = mysql_fetch_object($rs);
		mysql_free_result($rs);
		Desconectar();
		return $reg->Descripcion;
	}

	mysql_free_result($rs);

	Desconectar();

	return $Id;
}

function CursoTraduce($Id)
{
	if (!$Id)
		return '';

	Conectar();

	$rs = mysql_query("select Descripcion from cursos where Id=$Id");
	if ($rs && mysql_num_rows($rs)) {
		$reg = mysql_fetch_object($rs);
		mysql_free_result($rs);
		Desconectar();
		return $reg->Descripcion;
	}

	mysql_free_result($rs);

	Desconectar();

	return $Id;
}

function CursoEstadoTraduce($estado) {
	global $CursosEstado;

	if ($CursosEstado[$estado])
		return $CursosEstado[$estado];

	return $estado;
}

function CursoPoneEstado($Id,$Estado=CURSOS_ESTADO_NORMAL) {
	Conectar();

	mysql_query("update cursos set Estado = $Estado where Id = $Id");

	Desconectar();
}

function CursoUsuarioEsAlumno($IdCurso, $IdUsuario)
{
	Conectar();

	$IdUsuario = UsuarioId();

	$rs = mysql_query("select * from usuarioscursos where IdUsuario = $IdUsuario and IdCurso = $IdCurso");

	if (mysql_num_rows($rs)==0) {
		mysql_free_result($rs);
		Desconectar();
		return false;
	}

	$cursousuario = mysql_fetch_object($rs);

	mysql_free_result($rs);

	Desconectar();

	if ($cursousuario->Precio>0 && $cursousuario->Estado==0)
		return false;

	return true;
}

function CursoUsuarioEstaInscripto($IdCurso, $IdUsuario)
{
	Conectar();

	$IdUsuario = UsuarioId();

	$rs = mysql_query("select * from usuarioscursos where IdUsuario = $IdUsuario and IdCurso = $IdCurso");

	if (mysql_num_rows($rs)==0) {
		mysql_free_result($rs);
		Desconectar();
		return false;
	}

	$cursousuario = mysql_fetch_object($rs);

	mysql_free_result($rs);

	Desconectar();

	return true;
}

function CursoHabilitado($Id)
{
	Conectar();

	$rs = mysql_query("select Habilitado from cursos where Id = $Id");
	list($r) = mysql_fetch_row($rs);
	mysql_free_result($rs);

	return $r;
}

function CursoUsuarioControla($IdCurso) {
	if (EsAdministrador())
		return;

	$IdUsuario = UsuarioId();

	if (!CursoUsuarioEstaInscripto($IdCurso, $IdUsuario))
		PaginaRedireccionar("UsuarioCursos.php");
}

function CursoHabilitadoControla($IdCurso) {
	if (EsAdministrador())
		return;

	if (!CursoHabilitado($IdCurso))
		PaginaRedireccionar("UsuarioCursos.php");
}

?>