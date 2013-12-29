<?
	include_once('wikipages.inc.php');
	$wikipage = new WikiPage($page);
	$wikipage->Content = $content;
	$wikipage->Save();
	header("Location: index.php?page=$wikipage->Title");
?>