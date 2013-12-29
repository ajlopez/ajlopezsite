<?
	include('Paginas.inc.php');
	include('Items.inc.php');
	include('Eventos.inc.php');
	include('Conexion.inc.php');
	include('Puntos.inc.php');

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
