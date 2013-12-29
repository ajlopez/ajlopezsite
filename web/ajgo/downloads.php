<?
	$PaginaPrefijo='../';

	$pagina = $PHP_SELF;

	if (substr($pagina,-1)=='/')
		$pagina = substr($pagina,0,strlen($pagina)-1);

	if (substr($pagina,-10)=='/index.php')
		$pagina = substr($pagina,0,strlen($pagina)-10);

	$Alias = 'ajgodl';

	$PaginaMenu = 'menu.inc.php';

	include('../PaginaMuestra.php');
?>