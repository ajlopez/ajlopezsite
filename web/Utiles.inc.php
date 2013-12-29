<?
if (__Utiles_inc == 1)
	return;
define ('__Utiles_inc', 1);

function NormalizaImagen($imagen) {
	if (!$imagen)
		return $imagen;
	if (strstr($imagen,'/'))
		return $imagen;
	return 'images/' . $imagen;
}

function NormalizaHtml($html) {
	$txt = nl2br($html);
	$txt = str_replace("><br>",">",$txt);
	$txt = str_replace("><BR>",">",$txt);

	return $txt;
}

function EnlaceEmail($email) {
	if (empty($email))
		return $email;

	if (!strpos($email,"@"))
		return $email;

	return "<a href='mailto:$email'>$email</a>";
}

function NormalizaUrl($url) {
	if (!strpos($url,":/"))
		$url = "http://" . $url;
	return $url;
}

function EnlaceUrl($url, $texto='') {
	if (empty($url))
		return $texto;

	if (!strpos($url,":/"))
		$url = "http://" . $url;

	if (!$texto)
		$texto = $url;

	return "<a href='$url'>$texto</a>";
}

function EnlaceUrlNuevo($url,$texto='') {
	if (empty($url))
		return $texto;

	if (!strpos($url,":/"))
		$url = "http://" . $url;

	if (!$texto)
		$texto = $url;

	return "<a href='$url' target='_blank'>$texto</a>";
}

function TextoSiNo($sino) {
	if ($sino)
		return "Sí";
	else
		return "No";
}

function TextoSexo($sexo) {
	if ($sexo==2)
		return "Femenino";
	elseif ($sexo==1)
		return "Masculino";
	else
		return '';
}

function TextoEstado($estado) {
	if (!$estado)
		return "Normal";
	elseif ($estado==1)
		return "Pendiente";
	else
		return $estado;
}

function WhereAgrega($where, $condicion) {
	if ($where)
		return "$where and $condicion";
	else
		return $condicion;
}

?>