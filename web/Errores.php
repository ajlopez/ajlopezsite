<?
	$PaginaTitulo = "Error";
	if (!$Enlace)
		$Enlace='javascript:history.go(-1);';
	include('Inicio.inc.php');
?>

<center>

<h1><font color=red><? echo stripSlashes($Mensaje); ?></font></h1>
	<br>
	<br>
<?
	if ($Enlace) {
?>
<a href="<? echo $Enlace; ?>">Continuar</a>
<?
	}
?>

</center>

<?
	include('Final.inc.php');
?>