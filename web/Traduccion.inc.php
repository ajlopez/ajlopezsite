<?php
if (__Traduccion_inc == 1)
	return;
define ('__Traduccion_inc', 1);

include_once($PaginaPrefijo.'Conexion.inc.php');

function TraduccionCarga($tabla,$campo='Descripcion')
{
	$vector = Array();

	Conectar();

	$rs = mysql_query("select id, $campo from $tabla order by id");

	while (list($Clave, $Dato) = mysql_fetch_row($rs))
		$vector[$Clave] = $Dato;

	mysql_free_result($rs);

	Desconectar();

	return $vector;
}

function TraduceArticuloClase($Id)
{
	if (!$Id)
		return '';
	Conectar();
	$rs = mysql_query("select descripcion from articulosclases where Id = $Id");
	if ($rs && mysql_num_rows($rs))
		list($Descripcion) = mysql_fetch_row($rs);
	mysql_free_result($rs);
	Desconectar();
	return $Descripcion;
}

function TraduceItemClase($Id)
{
	if (!$Id)
		return '';
	Conectar();
	$rs = mysql_query("select descripcion from itemsclases where Id = $Id");
	if ($rs && mysql_num_rows($rs))
		list($Descripcion) = mysql_fetch_row($rs);
	mysql_free_result($rs);
	Desconectar();
	return $Descripcion;
}

function TraduceIdioma($Id)
{
	global $Idiomas;

	if (!$Id)
		return '';

	if ($Idiomas[$Id])
		return $Idiomas[$Id];

	Conectar();
	$rs = mysql_query("select descripcion from idiomas where Id = $Id");
	if ($rs && mysql_num_rows($rs))
		list($Descripcion) = mysql_fetch_row($rs);
	mysql_free_result($rs);
	Desconectar();

	$Idiomas[$Id]=$Descripcion;

	return $Descripcion;
}

function TraduceSitio($Id)
{
	if (!$Id)
		return '';
	Conectar();
	$rs = mysql_query("select descripcion from sitios where Id = $Id");
	if ($rs && mysql_num_rows($rs))
		list($Descripcion) = mysql_fetch_row($rs);
	mysql_free_result($rs);
	Desconectar();
	return $Descripcion;
}

?>