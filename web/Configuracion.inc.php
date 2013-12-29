<?php

if (__Configuracion_inc == 1) return;

define ('__Configuracion_inc', 1);

$MySqlHost = 'localhost';
$MySqlBase = 'ajlopez';
$MySqlUser = 'root';
$MySqlPwd = '';

$Host = $HTTP_SERVER_VARS["HTTP_HOST"];

$EsLocal = 1;

switch ($Host)
{

}

function EsLocal() {
	global $EsLocal;
	global $Host;

//	return $EsLocal;

	if (strstr($Host,"127.0.0.1") || strstr($Host,"localhost") || strstr($Host,"gandalf") || strstr($Host,"bombadil"))
		return true;

	return false;
}

function EsCobalt() {
	global $EsLocal;
	global $Host;

	if (strstr($Host,"207.153.232.30"))
		return true;

	if (strstr($Host,"latnetwork"))
		return true;

	if (strstr($Host,"209.152.174.128"))
		return true;

	if (strstr($Host,"ajlopez.net"))
		return true;

	return false;
}


if (EsLocal()) {
	$MySqlHost = 'localhost';
	$MySqlBase = 'ajlopez';
	$MySqlUser = 'root';
	$MySqlPwd = '';
}

/*
if (EsCobalt()) {
	$MySqlHost = 'localhost';
	$MySqlBase = 'ajlopez';
	$MySqlUser = 'ajlopez';
	$MySqlPwd = 'ajlopez234';
}
*/

if (EsCobalt()) {
	$MySqlHost = 'localhost';
	$MySqlBase = 'ajlopez_lopez';
	$MySqlUser = 'ajlopez_jlopez';
	$MySqlPwd = 'aj231lopez';
}

?>