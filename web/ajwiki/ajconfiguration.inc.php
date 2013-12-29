<?
//	$PaginaPrefijo='../ajlopeznet/';
	$PaginaMenu='ajmenu.inc.php';

	$WikiCfg['SqlHost']='localhost';
	$WikiCfg['SqlBase']='ajlopez_lopez';
	$WikiCfg['SqlUser']='ajlopez_jlopez';
	$WikiCfg['SqlPassword']='aj231lopez';
	$WikiCfg['SqlPrefix']='ajw_';

	$PaginaPrefijo='../';
	$WikiCfg['PageHeader']='../Inicio.inc.php';

	include_once($PaginaPrefijo.'Usuarios.inc.php');

function ajCanView() {
	return true;
}

function ajCanEdit() {
	return EsAdministrador();
}

function ajCanSearch() {
	return EsAdministrador();
}

function ajCanViewAll() {
	return EsAdministrador();
}
?>