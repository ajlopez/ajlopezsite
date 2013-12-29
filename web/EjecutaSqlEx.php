<?
	include('Usuarios.inc.php');
	include('Paginas.inc.php');

	AdministradorControla();

	if (!$Consulta)
		PaginaSalir();

	$Consulta=stripSlashes($Consulta);

	$PaginaTitulo = "Ejecuta SQL";
	if ($Titulo)
		$PaginaTitulo = $Titulo;

	$EsAdm = 1;

	include('Inicio.inc.php');

	include('DBUtiles.inc.php');
?>

<?
	include('Conexion.inc.php');
	Conectar();
	$result = @mysql_query($Consulta);
?>

<p>
<a href="EjecutaSql.php?query=<? echo urlencode($Consulta); ?>">Ejecuta esta consulta</a>
&nbsp;
&nbsp;
<a href="EjecutaSql.php">Ejecuta SQL</a>
</p>

<p>

Resultado de la consulta <B><?php echo($Consulta); ?></B><HR>

<?php
if ($result == 0):
   echo("<B>Error " . mysql_errno() . ": " . mysql_error() . "</B>");
elseif (@mysql_num_rows($result) == 0):
   echo("<B>Consulta ejecuta exitosamente!</B>");
else:
		 TablaMuestra($result);
endif;

	Desconectar();

	require('Final.inc.php');
?>
