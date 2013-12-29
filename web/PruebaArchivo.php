<?
	$PaginaTitulo = $archivo;

	$file = fopen($archivo,"r");

	include('Inicio.inc.php');
	include('Formato.inc.php');

	ProcesaArchivo($file);

	fclose($file);
?>

<?
	include('Final.inc.php');
?>

