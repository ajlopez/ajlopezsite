<?php
    include_once('Settings.inc.php');

	include_once('Usuarios.inc.php');
	include_once('Paginas.inc.php');

	AdministradorControla();

	if (!$archivo)
		PaginaSalir();

	header("Content-disposition: filename=$archivo");
	header("Content-type: application/octetstream");
	header("Pragma: no-cache");
	header("Expires: 0");
	
	$file = fopen($archivo,"r");

	while ($linea=fgets($file,10000))
		echo str_replace("\n","\r\n",$linea);

	fclose($file);
?>
