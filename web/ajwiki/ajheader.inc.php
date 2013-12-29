<?
	if (isset($WikiPage->Title)) {
		$PaginaTitulo = $WikiPage->Title;
		unset($WikiPage->Title);
	}

	include_once($PaginaPrefijo.'Inicio.inc.php');
?>