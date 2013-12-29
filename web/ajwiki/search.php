<?
	include_once('wikipages.inc.php');
	include_once('wikitransform.inc.php');
	include_once('wikisecurity.inc.php');

	if (!CanSearch()) {
		header('Location: index.php');
		exit;
	}

	if ($keyword)
		$pages = WikiPage::SearchPages($keyword);

	$WikiPage->Title = 'B&uacute;squeda';

	include('wikiheader.inc.php');
?>
<div id='AjWikiContent'>
<form>
<input type='text' name='keyword' value='<?= $keyword ?>'>
<input type='submit' value='Buscar'>
</form>
<?
	if ($pages) {
?>
<table>
<?
	foreach ($pages as $page) {
?>
<tr>
<td><a href='index.php?page=<?= $page['Title'] ?>'><?= $page['Title'] ?></a></td>
</tr>
<?
	}
?>
</table>
<?
	}
?>
</div>
<?
	include('wikifooter.inc.php');
?>
