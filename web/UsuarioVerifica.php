<?php
    include_once('Settings.inc.php');

	include_once('Paginas.inc.php');
	include_once('Items.inc.php');
	include_once('Eventos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Puntos.inc.php');
	include_once('Usuarios.inc.php');

	AdministradorControla();

	if (!$Id)
		PaginaSalir();

	Conectar();

	$rsUsuario = mysql_query("select PuntosAnteriores, IdReferente from usuarios where Id = $Id");
	list($Anteriores,$IdReferente) = mysql_fetch_row($rsUsuario);
	mysql_free_result($rsUsuario);

	$Puntos = UsuarioPuntos($Id,$Anteriores);

	mysql_query("update usuarios set Puntos = $Puntos, Verificado=1 where Id = $Id");

	if ($IdReferente)
		PuntosReferidoGana($IdReferente,$Anteriores,$Puntos);

	PaginaRedireccionar("Usuario.php?Id=$Id");
?>
