<?php
    include_once('Settings.inc.php');

	include_once('Paginas.inc.php');
	include_once('Items.inc.php');
	include_once('Eventos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Puntos.inc.php');

	$Voto += 0;

	if (!$Id || !$Voto)
		PaginaSalir();

	Conectar();

	if (ItemVotado($Id))
		PaginaRedireccionar("ItemVeTope.php?Id=$Id&Votado=1");

	EventoVotoItem($Id);
	ItemVoto($Id,$Voto);

	if (UsuarioIdentificado())
		PuntosVoto();

	Desconectar();

	PaginaRedireccionar("ItemVeTope.php?Id=$Id&Votado=1");
?>
