<?
	include_once('wikiconfiguration.inc.php');
	include_once('wikidata.inc.php');

class WikiPage {
	var $Id;
	var $Title;
	var $Content;
	var $DateTimeCreated;
	var $DateTimeModified;
	var $DateTimeAccessed;
	var $IdCategory;

	function WikiPage($id = '') {
		if ($id)
			if (is_string($id))
				$this->LoadByTitle($id);
			else
				$this->LoadById($id);
	}

	function LoadByTitle($title) {
		global $WikiCfg;

		$this->Title = $title;

		unset($this->Id);
		unset($this->Content);

		Connect();
		$rs = mysql_query("select Id, IdCategory, Title, Content, DateTimeCreated, DateTimeModified, DateTimeAccessed from ${WikiCfg[SqlPrefix]}pages where Title='$title' and IdCategory=${WikiCfg[CategoryId]}");
		if ($rs && mysql_num_rows($rs)) {
			$reg = mysql_fetch_array($rs);
			$this->Id = (integer) $reg['Id'];
			$this->IdCategory = (integer) $reg['IdCategory'];
			$this->Title = $reg['Title'];
			$this->Content = $reg['Content'];
			$this->DateTimeCreated = $reg['DateTimeCreated'];
			$this->DateTimeModified = $reg['DateTimeModified'];
			$this->DateTimeAccessed = $reg['DateTimeAccessed'];
		}
		mysql_free_result($rs);
		Disconnect();
	}

	function Accessed() {
		global $WikiCfg;

		Connect();
		mysql_query("update ${WikiCfg[SqlPrefix]}pages set DateTimeAccessed = Now() where Id = $this->Id");
		Disconnect();
	}

	function LoadById($id) {
		global $WikiCfg;

		$this->Id = $id;
		unset($this->Title);
		unset($this->Content);

		Connect();
		$rs = mysql_query("select Id, IdCategory, Title, Content, DateTimeCreated, DateTimeModified, DateTimeAccessed from ${WikiCfg[SqlPrefix]}pages where Id=$id and IdCategory=${WikiCfg[CategoryId]}");
		if ($rs && mysql_num_rows($rs)) {
			$reg = mysql_fetch_array($rs);
			$this->Id = (integer) $reg['Id'];
			$this->IdCategory = (integer) $reg['IdCategory'];
			$this->Title = $reg['Title'];
			$this->Content = $reg['Content'];
			$this->DateTimeCreated = $reg['DateTimeCreated'];
			$this->DateTimeModified = $reg['DateTimeModified'];
			$this->DateTimeAccessed = $reg['DateTimeAccessed'];
		}
		mysql_free_result($rs);
		
		Disconnect();
	}

	function SaveBackup() {
		global $WikiCfg;

		Connect();
		$sql = "insert ";
		$sql .= $WikiCfg['SqlPrefix'].'pages_backup';

		$sql .= " set IdCategory = $this->IdCategory, IdOriginal = $this->Id, Title = '$this->Title', Content = '$this->Content'";

		$sql .= ", DateTimeOriginal = '$this->DateTimeModified'";

		mysql_query($sql);

		Disconnect();
	}

	function Save() {
		global $WikiCfg;

		Connect();
		if ($this->Id) {
			$sql = "update ";
			$oldpage = new WikiPage($this->Id);
			if ($oldpage->Content == $this->Content)
				return;
			$oldpage->SaveBackup();
		}
		else {
			$sql = "insert ";
			$this->IdCategory = $WikiCfg['CategoryId'];
		}

		$sql .= $WikiCfg['SqlPrefix'].'pages';

		$sql .= " set IdCategory = $this->IdCategory, Title = '$this->Title', Content = '$this->Content'";

		if ($this->Id)
			$sql .= ", DateTimeModified = Now()";
		else
			$sql .= ", DateTimeCreated = Now(), DateTimeModified = Now()";

		if ($this->Id)
			$sql .= " where Id = $this->Id";
		mysql_query($sql);

		if (!$this->Id)
			$this->Id = mysql_insert_id();

		Disconnect();
	}

	function Exists() {
		return $this->Id <> 0;
	}

	function AllPagesByTitle() {
		global $WikiCfg;

		Connect();

		$pages = array();

		$rs = mysql_query("select Id, Title, DateTimeCreated, DateTimeModified, DateTimeAccessed from ${WikiCfg[SqlPrefix]}pages where IdCategory=${WikiCfg[CategoryId]} order by Title");

		while ($reg = mysql_fetch_array($rs))
			$pages[] = $reg;

		return $pages;

		Disconnect();
	}

	function SearchPages($keyword) {
		global $WikiCfg;

		Connect();

		$pages = array();

		$rs = mysql_query("select Id, Title, DateTimeCreated, DateTimeModified, DateTimeAccessed from ${WikiCfg[SqlPrefix]}pages where IdCategory=${WikiCfg[CategoryId]} and (Title like '%${keyword}%' or Content like '%${keyword}%') order by Title");

		while ($reg = mysql_fetch_array($rs))
			$pages[] = $reg;

		return $pages;

		Disconnect();
	}
}

class WikiPageBackup {
	var $Id;
	var $IdCategory;
	var $IdOriginal;
	var $Title;
	var $Content;
	var $DateTimeOriginal;

	function WikiPageBackup($id = '') {
		if ($id)
			if (is_string($id))
				$this->LoadByTitle($id);
			else
				$this->LoadById($id);
	}

	function LoadByTitle($title) {
		global $WikiCfg;

		$this->Title = $title;
		unset($this->Id);
		unset($this->Content);

		Connect();
		$rs = mysql_query("select Id, IdOriginal, Title, Content, DateTimeOriginal from ${WikiCfg[SqlPrefix]}pages_backup where Title='$title' and IdCategory=${WikiCfg[CategoryId]}");
		if ($rs && mysql_num_rows($rs)) {
			$reg = mysql_fetch_array($rs);
			$this->Id = (integer) $reg['Id'];
			$this->IdCategory = (integer) $reg['IdCategory'];
			$this->IdOriginal = (integer) $reg['IdOriginal'];
			$this->Title = $reg['Title'];
			$this->Content = $reg['Content'];
			$this->DateTimeOriginal = $reg['DateTimeOriginal'];
		}
		mysql_free_result($rs);
		Disconnect();
	}

	function LoadById($id) {
		global $WikiCfg;

		$this->Id = $id;
		unset($this->Title);
		unset($this->Content);

		Connect();
		$rs = mysql_query("select Id, IdCategory, IdOriginal, Title, Content, DateTimeOriginal from ${WikiCfg[SqlPrefix]}pages_backup where Id=$id and IdCategory=${WikiCfg[CategoryId]}");
		if ($rs && mysql_num_rows($rs)) {
			$reg = mysql_fetch_array($rs);
			$this->Id = (integer) $reg['Id'];
			$this->IdCategory = (integer) $reg['IdCategory'];
			$this->IdOriginal = (integer) $reg['IdOriginal'];
			$this->Title = $reg['Title'];
			$this->Content = $reg['Content'];
			$this->DateTimeOriginal = $reg['DateTimeOriginal'];
		}
		mysql_free_result($rs);
		
		Disconnect();
	}

	function VersionsByIdOriginal($id) {
		global $WikiCfg;

		Connect();

		$pages = array();

		$rs = mysql_query("select Id, IdOriginal, Title, DateTimeOriginal from ${WikiCfg[SqlPrefix]}pages_backup where IdOriginal = $id order by DateTimeOriginal desc");

		while ($reg = mysql_fetch_array($rs))
			$pages[] = $reg;

		return $pages;

		Disconnect();
	}

	function Restore() {
		global $WikiCfg;

		Connect();
		$sql = "update ";
		$sql .= $WikiCfg['SqlPrefix'].'pages';

		$sql .= " set Content = '$this->Content', DateTimeModified = '$this->DateTimeOriginal'";
		$sql .= " where Id = $this->IdOriginal";
		mysql_query($sql);
		mysql_query("delete from $WikiCfg[SqlPrefix]pages_backup where IdOriginal = $this->IdOriginal and Id >= $this->Id");

		Disconnect();
	}

	function Forget() {
		global $WikiCfg;

		Connect();
		mysql_query("delete from $WikiCfg[SqlPrefix]pages_backup where IdOriginal = $this->IdOriginal and Id <= $this->Id");
		Disconnect();
	}
}

class WikiCategory {
	var $Id;
	var $Title;
	var $Description;
	var $Url;

	function WikiCategory($id = '') {
		if ($id)
			if (is_string($id))
				$this->LoadByTitle($id);
			else
				$this->LoadById($id);
	}

	function LoadByTitle($title) {
		global $WikiCfg;

		$this->Title = $title;

		Connect();
		$rs = mysql_query("select Id, Title, Description, Url from ${WikiCfg[SqlPrefix]}categories where Title='$title'");
		if ($rs && mysql_num_rows($rs)) {
			$reg = mysql_fetch_array($rs);
			$this->Id = (integer) $reg['Id'];
			$this->Title = $reg['Title'];
			$this->Description = $reg['Description'];
			$this->Url = $reg['Url'];
		}
		mysql_free_result($rs);
		Disconnect();
	}

	function LoadById($id) {
		global $WikiCfg;

		$this->Id = $id;

		Connect();
		$rs = mysql_query("select Id, Title, Description, Url from ${WikiCfg[SqlPrefix]}pages_categories where Id=$id");
		if ($rs && mysql_num_rows($rs)) {
			$reg = mysql_fetch_array($rs);
			$this->Id = (integer) $reg['Id'];
			$this->Title = $reg['Title'];
			$this->Description = $reg['Description'];
			$this->Url = $reg['Url'];
		}
		mysql_free_result($rs);
		
		Disconnect();
	}
}

?>