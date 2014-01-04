<?php
    include_once('Settings.inc.php');
    
	$PaginaTitulo = "Error";
	if (!$Enlace)
		$Enlace='javascript:history.go(-1);';
	include('Inicio.inc.php');
?>

<center>

<h1><font color=red><? echo stripSlashes($Mensaje); ?></font></h1>
	<br>
	<br>
<?php
	if ($Enlace) {
?>
<a href="<? echo $Enlace; ?>">Continuar</a>
<?php
	}
?>

</center>

<?php
	include('Final.inc.php');
?>