<?
	include_once('wikipages.inc.php');
	include_once('wikitransform.inc.php');
	include_once('wikisecurity.inc.php');

	if (!CanEdit()) {
		header('Location: index.php');
		exit;
	}

	if (!$id) {
		header('Location: index.php');
		exit();
	}

	$wikipage = new WikiPageBackup((integer) $id);

	$WikiPage->Title = 'Versión ' . $wikipage->Title . ' ' . $wikipage->DateTimeOriginal;

	$WikiMenus['Ver Original'] = "index.php?page=$wikipage->Title";
	$WikiMenus['Editar Original'] = "edit.php?page=$wikipage->Title";
	$WikiMenus['Restaurar como Original'] = "restore.php?id=$id";
	$WikiMenus['Olvidar'] = "forget.php?id=$id";
	$WikiMenus['Versiones'] = "versions.php?id=$wikipage->IdOriginal";

	include('wikiheader.inc.php');
?>
<div id='AjWikiContent'>
<?
	$text = TransformText($wikipage->Content);
	echo $text;
?>
</div>
<?
	include('wikifooter.inc.php');
?>