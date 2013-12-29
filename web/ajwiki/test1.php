<?
function GetWikiPageList() {
	$dir=dir('pages/');

	while ($filename=$dir->read())
		if (preg_match("/\.ajwiki$/",$filename))
			$pages[] = substr($filename,0,strlen($filename)-7);

	return $pages;
}

$pages = GetWikiPageList();

foreach ($pages as $page)
	echo "<br><a href='test2.php?page=$page'>$page</a>";
?>