<?php
    include_once('Settings.inc.php');

	include_once('Paginas.inc.php');
	include_once('Articulos.inc.php');
	include_once('Eventos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Puntos.inc.php');

	$Voto += 0;

	if (!$Id || !$Voto)
		PaginaSalir();

	Conectar();

	if (ArticuloVotado($Id))
		PaginaRedireccionar("ArticuloVeTope.php?Id=$Id&Votado=1");

	EventoVotoArticulo($Id);
	ArticuloVoto($Id,$Voto);

	if (UsuarioIdentificado())
		PuntosVoto();

	Desconectar();

	PaginaRedireccionar("ArticuloVeTope.php?Id=$Id&Votado=1");
?>
