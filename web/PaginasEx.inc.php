<?php
if (__PaginasEx_inc == 1)
	return;
define ('__PaginasEx_inc', 1);

	include_once($PaginaPrefijo.'Conexion.inc.php');

function PaginaVisita($Id) {
	Conectar();
	mysql_query("update paginas set Visitas = Visitas + 1 where Id = $Id");
	Desconectar();
}

?>