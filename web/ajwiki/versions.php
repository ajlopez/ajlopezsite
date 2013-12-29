<?
	include_once('wikipages.inc.php');
	include_once('wikitransform.inc.php');
	include_once('wikisecurity.inc.php');

	if (!CanEdit()) {
		header('Location: index.php');
		exit;
	}

	$wikipage = new WikiPage((integer) $id);
	$pages = WikiPageBackup::VersionsByIdOriginal($id);

	$WikiPage->Title = 'Versiones '.$wikipage->Title;

	$WikiMenus['Ver Original'] = "index.php?page=$wikipage->Title";
	$WikiMenus['Editar Original'] = "edit.php?page=$wikipage->Title";

	include('wikiheader.inc.php');
?>
<div id='AjWikiContent'>
<table>
<?
	foreach ($pages as $page) {
?>
<tr>
<td><a href='version.php?id=<?= $page['Id'] ?>'><?= $page['Title'] ?> <?= $page['DateTimeOriginal'] ?></a></td>
</tr>
<?
	}
?>
</table>
</div>
<?
	include('wikifooter.inc.php');
?>