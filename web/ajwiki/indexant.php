<?
	include_once('ajwiki.inc.php');
?>
<HEAD>
<TITLE>AjWiki - Principal</TITLE>
<LINK REL="stylesheet" TYPE="text/css" HREF="style.css"/>
</HEAD>
<?
	if (!$page)
		$page='Index';

$patterns = array( 
	'/(^|[^\w_]+)([A-Z]+[a-z\d]+[A-Z]+\w*)(\+?)($|[^\w_]+)/', // CamelBack
	'/(^|\W+)_([\w-]+(?:_[\w-]+)*)_(\+?)($|\W+)/'     // Underscore
);

function TransformMatch($matches)
{
	if ($matches[3])
		return $matches[1]."<a href='index.php?page=".$matches[2]."' target='_blank'>".$matches[2]."</a>".$matches[4];
	else
		return $matches[1]."<a href='index.php?page=".$matches[2]."'>".$matches[2]."</a>".$matches[4];
}

function TransformBlock($block)
{
	global $patterns;
	global $patternsext;

	foreach ($patterns as $pattern)
		$block = preg_replace_callback($pattern,'TransformMatch',$block);

	return $block;
}

function TransformLine($line)
{
	$blocks = preg_split('/\s/',$line);

	foreach ($blocks as $block)
		$result .= ' ' . TransformBlock($block);

	return $result;
}

function FormatHeaderLine($line)
{
	return "<div class='AjWikiPageTitle'>".$line."</div><br>";
}

function FormatLine($line)
{
	if ($line)
		return "<div class='AjwNormal'>".TransformLine($line)."</div>";
}
?>
<div id='AjWikiContent'>
<?
	echo FormatHeaderLine($page);

	$filename = GetFileName($page);

	if (file_exists($filename))
		$lines = file("pages/$page.ajwiki");
	else
		$lines[] = "(No existe página)";

	foreach ($lines as $line)
		echo FormatLine($line);
?>
</div>

<p>
<a href="index.php">Principal</a>
&nbsp;&nbsp;
<a href="edit.php?page=<?= $page ?>">Edita esta página</a>
