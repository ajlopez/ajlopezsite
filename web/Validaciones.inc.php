<?
if (__Validaciones_inc == 1)
	return;
define ('__Validaciones_inc', 1);

function FechaValida($anio,$mes,$dia) {
	if (!$anio || !$mes || !$dia)
		return false;

	if (!checkdate($mes,$dia,$anio))
		return false;

	return true;
}

function FechaBlanco($anio,$mes,$dia) {
	if (!$anio && !$mes && !$dia)
		return true;
	return false;
}

function FechaSqlArma($anio,$mes,$dia) {
	if (!FechaValida($anio,$mes,$dia))
		return '';

	$anio = substr('0000'+$anio,-4);
	$mes = substr('00'+$mes,-2);
	$dia = substr('00'+$dia,-2);

	return("$anio-$mes-$dia");
//	return(date('Y-m-d',mktime(0,0,0,$mes+0,$dia+0,$anio+0)));
}

function SexoValida($sexo) {
	if ($sexo != 1 && $sexo != 2)
		return false;

	return true;
}

function EmailValida($email) {
	if (!$email)
		return false;

	if (!strpos($email,'@'))
		return false;

	if (strpos($email,'@')<>strrpos($email,'@'))
		return false;

	return true;
}

?>