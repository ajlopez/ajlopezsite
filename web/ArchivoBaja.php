<?
	include('Usuarios.inc.php');
	include('Paginas.inc.php');

	AdministradorControla();

	if (!$archivo)
		PaginaSalir();

	header("Content-disposition: filename=$archivo");
	header("Content-type: application/octetstream");
	header("Pragma: no-cache");
	header("Expires: 0");
	
	$file = fopen($archivo,"r");

	fpassthru($file);
?>
