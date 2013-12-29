<?php
	if (__Sesion_inc == 1)
		return;
	define ('__Sesion_inc', 1);

	include_once($PaginaPrefijo.'Conexion.inc.php');
	include_once($PaginaPrefijo.'Azar.inc.php');
	include_once($PaginaPrefijo.'Errores.inc.php');

	$SesionTiempo = 86400;

function SesionDepura() {
	global $SesionTiempo;

	$tiempo = time() - $SesionTiempo;
	mysql_query("delete from sesion where Tiempo < $tiempo");
}

function SesionDestruye() {
	global $CkSesionId;
	
	if (!$CkSesionId)
		return;

	setcookie('CkSesionId');

	Conectar();
	mysql_query("delete from sesion where Codigo = '$CkSesionId'");
	Desconectar();
}

function SesionCrea() {
	global $SesionId;
	global $Sesion;

	$SesionId = RandName(16);
	$Sesion = array();
	$Texto = addSlashes(serialize($Sesion));
	setcookie('CkSesionId', $SesionId, 0, "/");
	Conectar();
	mysql_query("insert sesion set
		Codigo = '$SesionId',
		Texto = '$Texto',
		Tiempo = unix_timestamp()
		");
	Desconectar();
}

function SesionLee() {
	global $CkSesionId;
	global $SesionId;
	global $Sesion;

	Conectar();

	SesionDepura();

	if ($CkSesionId) {
		$SesionId=$CkSesionId;

		$rs = mysql_query("select id, codigo, texto from sesion where Codigo = '$SesionId'");

		if ($rs && mysql_num_rows($rs)) {
			list($Id,$Codigo,$Texto) = mysql_fetch_row($rs);
			$Sesion = unserialize(stripSlashes($Texto));
			mysql_query("update sesion set Tiempo = unix_timestamp() where Codigo = '$SesionId'");
		}
		else
			SesionCrea();
	}
	else
		SesionCrea();

	Desconectar();
}

function SesionGraba() {
	global $Sesion;
	global $SesionId;

	Conectar();
	
	$Texto = addSlashes(serialize($Sesion));
	$query = "update sesion set Texto = '$Texto', Tiempo = unix_timestamp() where Codigo = '$SesionId'";
	$res = mysql_query($query);
	if (!$res)
		ErrorSqlEx(__LINE__, __FILE__, $query);

	Desconectar();
}

function SesionToma($nombre) {
	global $Sesion;

	if (is_array($Sesion))
		return($Sesion[$nombre]);

	return '';
}

function SesionPone($nombre,$valor,$graba=1) {
	global $Sesion;

	$Sesion[$nombre]=$valor;

	if ($graba)
		SesionGraba();
}

function SesionSaca($nombre,$graba=1) {
	global $Sesion;

	unset($Sesion[$nombre]);

	if ($graba)
		SesionGraba();
}

function SesionMuestra() {
	global $Sesion;
	global $SesionId;

	reset($Sesion);

	echo "SesionId: $SesionId<br>\n";

	while (list($codigo,$valor) = each($Sesion))
		echo "$codigo: $valor<br>\n";
}

	SesionLee();
?>