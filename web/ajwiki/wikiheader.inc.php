<?
	if ($WikiCfg['SystemPrefix'] && file_exists($WikiCfg['SystemPrefix'].'header.inc.php'))
		include_once($WikiCfg['SystemPrefix'].'header.inc.php');
	else {
?>
<HEAD>
<TITLE><?= $WikiPage->Title ?> - AjWiki</TITLE>
</HEAD>
<body>
<?
	}
?>
<LINK REL="stylesheet" TYPE="text/css" HREF="style.css"/>
<?
	if (isset($WikiPage->Title)) {
?>
<br>
<div class='AjWikiPageTitle'><?= $WikiPage->Title ?></div>
<br>
<?
	}
?>
<div id="AjWikiControls">
<?
	if (!$WikiMainMenus) {
		$WikiMainMenus['Principal'] = 'index.php';
		if (CanViewAll())
			$WikiMainMenus['P&aacute;ginas'] = "allpages.php";
		if (CanSearch())
			$WikiMainMenus['Buscar'] = "search.php";
	}

	foreach ($WikiMainMenus as $text => $link) {
?>
<a href="<?= $link ?>"><?= $text ?></a>
<?
	}

if ($WikiMenus) {
	foreach ($WikiMenus as $text => $link) {
?>
<a href="<?= $link ?>"><?= $text ?></a>
<?
	}
?>
</div>
<?
}
?>
