<?
	include_once('wikipages.inc.php');
	include_once('wikitransform.inc.php');
	include_once('wikisecurity.inc.php');

	if (!CanViewAll()) {
		header('Location: index.php');
		exit;
	}

	$pages = WikiPage::AllPagesByTitle();

	$WikiPage->Title = 'P&aacute;ginas';

	include('wikiheader.inc.php');
?>
<div id='AjWikiContent'>
<table>
<tr>
<td>T&iacute;tulo</td>
<td>Fecha/Hora de Creaci&oacute;n</td>
<td>Fecha/Hora de Modificaci&oacute;n</td>
<td>Fecha/Hora de Ultimo Acceso</td>
</tr>
<?
	foreach ($pages as $page) {
?>
<tr>
<td><a href='index.php?page=<?= $page['Title'] ?>'><?= $page['Title'] ?></a></td>
<td><?= $page['DateTimeCreated'] ?></td>
<td><?= $page['DateTimeModified'] ?></td>
<td><?= $page['DateTimeAccessed'] ?></td>
</tr>
<?
	}
?>
</table>
</div>
<?
	include('wikifooter.inc.php');
?>
