<?
	include_once('wikipages.inc.php');
	include_once('wikisecurity.inc.php');

	if (!CanEdit()) {
		header('Location: index.php');
		exit;
	}

	$wikipage = new WikiPage($page);

	$WikiPage->Title = 'Edita ' . $wikipage->Title;

	$WikiMenus['Ver P&aacute;gina'] = "index.php?page=$page";
	$WikiMenus['Versiones'] = "versions.php?id=$wikipage->Id";

	include('wikiheader.inc.php');
?>
<div id='AjWikiContent'>
<form action='save.php' method='post'>
<textarea cols=60 rows=20 name='content'>
<? echo $wikipage->Content ?>
</textarea>
<input type='hidden' value='<?= $page ?>' name='page'>
<br>
<input type='submit' value='Aceptar'>
</form>
</div>
<?
	include('wikifooter.inc.php');
?>
