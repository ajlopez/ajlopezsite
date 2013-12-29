<?
	include('Usuarios.inc.php');

	AdministradorControla();

	$PaginaTitulo = "Ejecuta SQL";
	$EsAdm = 1;

	include('Inicio.inc.php');

	include('DBUtiles.inc.php');

	$query = stripSlashes($query) ;
?>

<form method="post" action="EjecutaSql.php">
<p>
Ingrese el comando SQL a ejecutar:<BR><BR>
<TEXTAREA NAME="query" COLS=50 ROWS=10><? echo $query; ?></TEXTAREA>
<BR><BR>
<INPUT TYPE=SUBMIT VALUE="Ejecutar">
</FORM>

<?

if (!empty($query)):
	include('Conexion.inc.php');
	Conectar();
	$result = @mysql_query($query);
?>

Resultado de la consulta <B><?php echo($query); ?></B><HR>

<?php
if ($result == 0):
   echo("<B>Error " . mysql_errno() . ": " . mysql_error() . "</B>");
elseif (@mysql_num_rows($result) == 0):
   echo("<B>Consulta ejecuta exitosamente!</B>");
else:
		 TablaMuestra($result);
endif;

	Desconectar();

endif;

	require('Final.inc.php');
?>
