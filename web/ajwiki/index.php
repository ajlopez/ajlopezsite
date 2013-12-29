<?
	include_once('wikipages.inc.php');
	include_once('wikitransform.inc.php');
	include_once('wikisecurity.inc.php');

	if (!$page)
		$page='Index';

	$wikipage = new WikiPage($page);
	$wikipage->Accessed();

	$WikiPage->Title = $wikipage->Title;

	if (CanEdit()) {
		$WikiMenus['Editar P&aacute;gina'] = "edit.php?page=$page";
		if ($wikipage->Id)
			$WikiMenus['Versiones'] = "versions.php?id=$wikipage->Id";
	}

	if (!CanView())
		$pagetext = "(Privada)";
	else if ($wikipage->Exists())
		$pagetext = TransformText($wikipage->Content);
	else
		$pagetext = "(No existe página)";

	include('wikiheader.inc.php');
?>
<div id='AjWikiContent'>
<?
	echo $pagetext;
?>
</div>
<?
	include('wikifooter.inc.php');
?>
