<?
if (__Errores_inc == 1)
	return;
define ('__Errores_inc', 1);

	include_once($PaginaPrefijo.'Log.inc.php');

function ErrorMuestra($mensaje,$enlace='') {
	global $PaginaPrefijo;

	header("Location: ".$PaginaPrefijo."Errores.php?Mensaje=".urlencode($mensaje)."&Enlace=".urlencode($enlace));
	exit();
}

function ErrorMuestraAnt($mensaje,$enlace='javascript:history.go(-1);') {
	$PaginaTitulo = 'Error';
	echo "ErrorMuestra<br>";
	include($PaginaPrefijo.'Inicio.inc.php');
?>
<table width="415" border="0" cellspacing="0" cellpadding="0" height="326">
  <tr bgcolor="#FFFFCC" valign="middle"> 
    <td height="67"> 
      <div align="right"><font face="Arial, Helvetica, sans-serif" size="2"><img src="images/errortri.gif" width="57" height="57"><b></b></font></div>
    </td>
    <td height="67"><font face="Arial, Helvetica, sans-serif" size="2"><b><font size="4" color="#CC0000">ERROR</font></b></font></td>
  </tr>
  <tr bgcolor="#FFFFCC"> 
    <td colspan="2" valign="top" align="center"> 
<h1 align=center><font color=red><? echo $mensaje; ?></font></h1>
	<br>
	<br>
<?
	if ($enlace) {
?>
<a href="<? echo $enlace; ?>">Continuar</a>
<?
	}
?>
    </td>
  </tr>
</table>
<?
	include($PaginaPrefijo.'Final.inc.php');
	exit();
}

function ErrorSql() {
	if (!mysql_errno())
		return;
	$msg = mysql_error() . ' (' . mysql_errno() . ')';
	ErrorMuestra($msg);
}

function ErrorSqlEx($line,$file,$query) {
//	floge($line,$file,$query);
	ErrorSql();
}

?>