<?
	include_once('wikiconfiguration.inc.php');

	$Connected = 0;

function Connect() {
	global $Connected;
	global $WikiCfg;

	if (!$Connected) {
		mysql_pconnect($WikiCfg['SqlHost'], $WikiCfg['SqlUser'], $WikiCfg['SqlPassword']);
		if (mysql_errno())
			echo mysql_error();
	}
		
	mysql_select_db($WikiCfg['SqlBase']);
	$Connected++;
}

function Disconnect() {
	global $Connected;

	if ($Connected>1)
		$Connected--;
	else if ($Connected) {
		mysql_close();
		$Connected=0;
	}
}
?>