<?
	$fp=fopen($archivo, "w"); 
	fwrite($fp, stripSlashes($contenido)); 
	fclose($fp);
	header("Location: ArchivosDirectorio.php?dir=$dir&padre=$padre");
?>
