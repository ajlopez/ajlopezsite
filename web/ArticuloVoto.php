<?
	include('Paginas.inc.php');
	include('Articulos.inc.php');
	include('Eventos.inc.php');
	include('Conexion.inc.php');
	include('Puntos.inc.php');

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
