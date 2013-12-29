<?
	include_once('ajwiki.inc.php');
	include_once('wikitransform.inc.php');

	if (!$page)
		$page='Index';
?>
<HEAD>
<TITLE>AjWiki - Principal</TITLE>
<LINK REL="stylesheet" TYPE="text/css" HREF="style.css"/>
</HEAD>
<body>
<div id="AjWikiControls">
<a href="index.php">Principal</a>
&nbsp;
<a href="edit.php?page=<?= $page ?>">Edita</a>
</div>

<?
function FormatHeaderLine($line)
{
	return "<br /><div class='AjWikiPageTitle'>".$line."</div><br />";
}

function FormatLine($line)
{
	if ($line)
		return "<div class='AjwNormal'>".TransformLine($line)."</div>";
}

	echo FormatHeaderLine($page);
?>
<div id='AjWikiContent'>
<?
	$filename = GetFileName($page);

	if (file_exists($filename)) {
		$content = file_get_contents($filename);
		$text = TransformText($content);
	}
	else
		$text = "(No existe página)";

	echo $text;
?>
</div>
</body>
</html>
