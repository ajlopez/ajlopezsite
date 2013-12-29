<HEAD>
<TITLE>AjWiki - Principal</TITLE>
<LINK REL="stylesheet" TYPE="text/css" HREF="style.css"/>
</HEAD>
<?

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

function TransformLine($line)
{
	global $patterns;
	global $patternsext;

	foreach ($patterns as $pattern)
//		$line = preg_replace($pattern,"$1<a href='test2.php?page=$2'>$2</a>$3",$line);
		$line = preg_replace_callback($pattern,'TransformMatch',$line);

	return $line;
}

function FormatHeaderLine($line)
{
	return "<div class='AjwHeading1'>".TransformLine($line)."</div>";
}

function FormatLine($line)
{
	if ($line)
		return "<div class='AjwNormal'>".TransformLine($line)."</div>";
}

	$lines = file("pages/$page.ajwiki");

	foreach ($lines as $line)
		if ($nlines++)
			echo FormatLine($line);
		else
			echo FormatHeaderLine($line);
?>