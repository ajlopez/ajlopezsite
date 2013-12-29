<?
	$WikiCfg['CategoryId']=1;
	$WikiCfg['CategoryTitle']='AjWiki';

	$WikiCfg['SqlHost']='localhost';
	$WikiCfg['SqlBase']='ajwiki';
	$WikiCfg['SqlUser']='root';
	$WikiCfg['SqlPassword']='';
	$WikiCfg['SqlPrefix']='ajw_';

	$WikiCfg['SystemPrefix']='aj';

	if ($WikiCfg['SystemPrefix'] && file_exists($WikiCfg['SystemPrefix'].'configuration.inc.php'))
		include_once($WikiCfg['SystemPrefix'].'configuration.inc.php');
?>