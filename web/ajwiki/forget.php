<?
	include_once('wikipages.inc.php');
	$wikipage = new WikiPageBackup((integer) $id);
	$wikipage->Forget();
	header("Location: index.php?page=$wikipage->Title");
?>