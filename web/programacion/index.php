<?php
	$PaginaPrefijo='../';

	$pagina = $_SERVER['PHP_SELF'];

	if (substr($pagina,-1)=='/')
		$pagina = substr($pagina,0,strlen($pagina)-1);

	if (substr($pagina,-10)=='/index.php')
		$pagina = substr($pagina,0,strlen($pagina)-10);

	$Alias = substr(strrchr($pagina,'/'),1);

	include('../Tema.php');
?>