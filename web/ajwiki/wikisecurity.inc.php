<?
	include_once('wikiconfiguration.inc.php');

function CanView() {
	global $WikiCfg;

	if ($WikiCfg['SystemPrefix']) {
		$canview = $WikiCfg['SystemPrefix'].'CanView';
		return $canview();
	}

	return true;
}

function CanViewAll() {
	global $WikiCfg;

	if ($WikiCfg['SystemPrefix']) {
		$canviewall = $WikiCfg['SystemPrefix'].'CanViewAll';
		return $canviewall();
	}

	return true;
}


function CanSearch() {
	global $WikiCfg;

	if (!CanView())
		return false;

	if ($WikiCfg['SystemPrefix']) {
		$cansearch = $WikiCfg['SystemPrefix'].'CanSearch';
		return $cansearch();
	}

	return true;
}

function CanEdit() {
	global $WikiCfg;

	if (!CanView())
		return false;

	if ($WikiCfg['SystemPrefix']) {
		$canedit = $WikiCfg['SystemPrefix'].'CanEdit';
		return $canedit();
	}

	return true;
}
?>