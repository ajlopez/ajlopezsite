<?php
if (__Referencias_inc == 1)
	return;
define ('__Referencias_inc', 1);

	include_once('Usuarios.inc.php');
	include_once('Conexion.inc.php');

function ReferenciaVisita($Id) {
	Conectar();
	mysql_query("update items set Visitas = Visitas + 1 where Id = $Id");
	Desconectar();
}

?>