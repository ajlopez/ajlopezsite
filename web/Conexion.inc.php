<?
if (__Conexion_inc == 1)
	return;
define ('__Conexion_inc', 1);

	include_once($PaginaPrefijo.'Configuracion.inc.php');

	$Conectado = 0;

function Conectar() {
	global $Conectado;
	global $MySqlHost;
	global $MySqlUser;
	global $MySqlPwd;
	global $MySqlBase;

	if (!$Conectado) {
		mysql_connect($MySqlHost, $MySqlUser, $MySqlPwd);
		if (mysql_errno())
			echo mysql_error();
	}
		
	mysql_select_db($MySqlBase);
	$Conectado++;
}

function Desconectar() {
	global $Conectado;

	if ($Conectado>1)
		$Conectado--;
	else {
		mysql_close();
		$Conectado=0;
	}
}
?>