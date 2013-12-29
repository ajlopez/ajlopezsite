<?
	include_once('wikipages.inc.php');

$regexURL = "((http|https|ftp|mailto):\/\/[\w\.\:\@\?\&\~\%\=\+\-\/\_\;]+)";
$regexURLText = "([\w\.\:\@\?\&\~\%\=\+\-\/\_\ \;\,\$]+)";
$wikiPage = 'wiki.php';

// Global variables

$wikibr = false;

// Transformations

$transformations = array(
//	'TransformTitle3' => '/^===(.*)\r/',
	'TransformTitle3' => '/^===(.*)/',
//	'TransformTitle2' => '/^==(.*)\r/',
	'TransformTitle2' => '/^==(.*)/',
//	'TransformTitle1' => '/^=(.*)\r/',
	'TransformTitle1' => '/^=(.*)/',
	'TransformExternalURL' => "/(?<![\"\[\>])($regexURL)(?!\"\<)\!/",
	'TransformURL' => "/(?<![\"'\[\>])$regexURL(?!'\"\<)/",
//	'TransformCamel' => '/(?<=\s)([A-Z]+[a-z\d]+[A-Z]+\w*)(!?)/',
	'TransformCamel' => '/(?<![\w])([A-Z]+[a-z\d]+[A-Z]+\w*)(!?)/',
	'TransformBraquet' => '/\[\[([^]]*)]]/'
	);

function TransformTitle1($matches) {
	global $wikibr;
	global $WikiPage;

	$wikibr=false;

	$WikiPage->Title = $matches[1];

	return '';
//	return "<h1>$matches[1]</h1>\n";
}

function TransformTitle2($matches) {
	global $wikibr;
	$wikibr=false;

	return "<h2>$matches[1]</h2>\n";
}

function TransformTitle3($matches) {
	global $wikibr;
	$wikibr=false;

	return "<h3>$matches[1]</h3>\n";
}

function TransformURL($matches) {
	return "<a href=\"$matches[0]\">$matches[0]</a>";
}

function TransformExternalURL($matches) {
	return "<a href='$matches[1]' target='_blank'>$matches[1]</a>";
}

function TransformCamel($matches) {
	return "<a href='$wikiPage?page=".$matches[1]."'>".$matches[1]."</a>";
}

function TransformBraquet($matches) {
	list($url,$text) = explode("|",$matches[1]);
	list($protocol,$resource) = explode(":",$url);

	switch ($protocol) {
		case 'http':
			if ($text)
				return "<a href='$url'>$text</a>";
			else
				return "<a href='$url'>$url</a>";
			break;
		default:
			if (!$text)
				$text = str_replace('_',' ',$url);
			if ($resource) {
				$category = new WikiCategory($protocol);
				$resource = str_replace(' ','_',$resource);
				return "<a href='$category->Url?page=$resource'>$text</a>";
			}
			$url = str_replace(' ','_',$url);
			return "<a href='?page=$url'>$text</a>";
			break;
	}
}

function TransformLine($text) {
	global $transformations;
	global $wikibr;

	$wikibr=true;

	foreach ($transformations as $function => $pattern)
		$text = preg_replace_callback($pattern,$function,$text);

	if ($wikibr)
		$text .= '<br>';

	return $text;
}

function TransformText($text) {
	global $transformations;

	$lines = explode("\n",$text);

	foreach ($lines as $line) {
		$tline = TransformLine($line);
		if ($tline)
			$ttext .= $tline;
	}

	return $ttext;
}
?>