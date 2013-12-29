<?
	include_once('wikipages.inc.php');
	$wikipage = new WikiPageBackup((integer) $id);
	$wikipage->Restore();
	header("Location: index.php?page=$wikipage->Title");
?>